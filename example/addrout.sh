#!/bin/bash
#json besorgen
/usr/bin/wget http://fff-jupiter.fff.community/myv6/f3nsub/api.php?abfrage=aktiv -O /root/getrout/routes.json
#json zerlegen
/bin/cat /root/getrout/routes.json | /usr/bin/jq '.[].ip' | sed 's/"//g' > /root/getrout/routes
if [ -z $(/usr/bin/diff /root/getrout/routes /root/getrout/akt) ]
then
        echo "Do nothing"
else
        #zuerst aktuelle File überschreiben mit neuen Werten
        /bin/cp /root/getrout/routes /root/getrout/akt
        #alten kram aufräumen
        /sbin/ifdown dummy0
        /bin/ip link del dummy0
        /bin/rm /etc/network/interfaces.d/dummy0
        #Interface neu anlegen
        echo "auto dummy0
        iface dummy0 inet manual
        pre-up /sbin/ip link add dummy0 type dummy
        pre-up ifconfig dummy0 up
        up /sbin/ip link set dummy0 address 52:54:00:7e:27:af" > /etc/network/interfaces.d/dummy0
        while read LINE
        do
                echo "post-up ip -6 route replace default from $LINE dev \$IFACE table fff proto static" >> /etc/network/interfaces.d/dummy0
        done < /root/getrout/routes
        while read LINE
        do
                echo "post-down ip -6 route del default from $LINE dev \$IFACE table fff proto static" >> /etc/network/interfaces.d/dummy0
        done < /root/getrout/routes
        #Interface starten
        /sbin/ifup dummy0
fi
