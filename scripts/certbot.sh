sudo amazon-linux-extras enable epel
sudo yum install -y epel-release
sudo yum install -y certbot python2-certbot-nginx
sudo certbot certonly --debug --email info@jarcapital.com --agree-tos --domains "${DOMAIN_1}" --domains "${DOMAIN_2}" --keep-until-expiring --nginx

if [[ $(crontab -l | egrep -v "^(#|$)" | grep -q 'certbot renew'; echo $?) == 1 ]]
then
    set -f
    echo "$(crontab -l ; echo '0 1 * * * certbot renew')" | crontab -
    set +f
fi
