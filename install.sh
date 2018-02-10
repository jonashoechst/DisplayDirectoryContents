#!/usr/bin/sh

echo "### Updating sources"
opkg update


echo
echo "### Installing webserver..."
opkg install php7-fastcgi nginx
cat > /etc/nginx/nginx.conf <<EOF
user                nobody nogroup;
worker_processes    1;

events {
    worker_connections  1024;
}

http {
    include             mime.types;
    sendfile            on;
    keepalive_timeout   65;

    server {
        listen  80;
        root    /mnt/;
        index   /.index.php;
	
        location ~ \.php$ {
            include         fastcgi_params;
            fastcgi_param   SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
            fastcgi_pass    127.0.0.1:1026;
        }
    }
}
EOF
/etc/init.d/nginx enable
/etc/init.d/php7-fastcgi enable


echo 
echo "### Installing USB Drive support..."
opkg install block-mount kmod-usb-storage


echo
echo "### Setting HotPlug Drive mount..."
cat > /etc/config/fstab <<EOF
config 'global'
	option	anon_swap	'0'
	option	anon_mount	'0'
	option	auto_swap	'1'
	option	auto_mount	'1'
	option	delay_root	'5'
	option	check_fs	'0'

config 'global' 'automount'
	option 'from_fstab'	'1'
	option 'anon_mount' '1'
EOF
reload_config
/etc/init.d/fstab enable


echo "### Installing files..."
cp -r mnt/ /mnt/
chmod 755 /mnt/.index.php


echo "### Done!"