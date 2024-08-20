#!/bin/bash
sudo apt update -y
sudo apt install -y php libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip php-bcmath php-tokenizer php-json php-pear php-mysql php-curl mariadb-server composer nmap sshpass openssh-server
sudo systemctl start mysql
sudo mysql_secure_installation

sudo systecmtl enable ssh
sudo systecmtl enable mysql

curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install nodejs -y

echo "Append this with sudo visudo. TODO security violation but works... For now."
echo "username      ALL=(ALL) NOPASSWD: ALL"
