#!/bin/bash
#need jq https://stedolan.github.io/jq/
#json besorgen
wget http://fff-jupiter.fff.community/myv6/f3nsub/api.php?abfrage=aktiv -O /root/getrout/routes.json
#json zerlegen
cat /root/getrout/routes.json | jq '.[].ip' | sed 's/"//g' > /root/getrout/routes
#alten kram aufräumen
ifdown dummy0
ip link del dummy0
rm /etc/network/interfaces.d/dummy0
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
ifup dummy0
