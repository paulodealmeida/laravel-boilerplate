#!/bin/sh
PROJECT=boilerplate_app
URL=www.boilerplate_app.local
PASTA="$PWD"

# TODO criar variaveis de configuração do banco

aguardar(){
	clear
	echo ${1} " "
	sleep 1
	clear
	echo ${1} " ."
	sleep 1
	clear
	echo ${1} " .."
	sleep 1
	clear
	echo ${1} " ..."
	sleep 1
}

instalar(){
	if [ -d "vendor" ]; then
		echo "Aplicação já foi instalada!"
	else
		#aguardar "Iniciando instalação"
		composer install
		echo ""
		touch .env
		echo "APP_ENV=local" >> .env
                echo "APP_KEY=" >> .env
                echo "APP_DEBUG=true" >> .env
                echo "APP_LOG_LEVEL=debug" >> .env
                echo "APP_URL=http://localhost" >> .env
                echo "API_URL=localhost/api" >> .env
                echo "" >> .env
				echo "DB_CONNECTION=mysql" >> .env
				echo "DB_HOST=127.0.0.1" >> .env
				echo "DB_PORT=3306" >> .env
				echo "DB_DATABASE=database" >> .env
				echo "DB_USERNAME=root" >> .env
				echo "DB_PASSWORD=" >> .env
                echo "" >> .env
                echo "BROADCAST_DRIVER=log" >> .env
                echo "CACHE_DRIVER=file" >> .env
                echo "SESSION_DRIVER=file" >> .env
                echo "QUEUE_DRIVER=sync" >> .env
                echo "" >> .env
                echo "MAIL_DRIVER=smtp" >> .env
                echo "MAIL_HOST=mailtrap.io" >> .env
                echo "MAIL_PORT=2525" >> .env
                echo "MAIL_USERNAME=null" >> .env
                echo "MAIL_PASSWORD=null" >> .env
                echo "MAIL_ENCRYPTION=null" >> .env
                echo "" >> .env
                echo "PUSHER_KEY=" >> .env
                echo "PUSHER_SECRET=" >> .env
                echo "PUSHER_APP_ID=" >> .env
                echo "" >> .env
		
		php artisan key:generate

		if [ -f "/etc/apache2/sites-available/${PROJECT}.conf" ]; then
			sudo rm /etc/apache2/sites-available/${PROJECT}.conf
		fi
		touch /etc/apache2/sites-available/${PROJECT}.conf
		echo "###########################################" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "########## ${URL} ##############" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "###########################################" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        ServerAdmin webmaster@localhost" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        <Directory \"${PASTA}/public\">" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "                AllowOverride All" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "                php_value post_max_size 150M" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "                php_value upload_max_filesize 150M" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        </Directory>" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        DocumentRoot \"${PASTA}/public\"" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        ServerAlias ${URL}" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        ErrorLog \"${PASTA}/storage/logs/error.log\"" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "        CustomLog \"${PASTA}/storage/logs/access.log\" common" >> /etc/apache2/sites-available/${PROJECT}.conf
		echo "</VirtualHost>" >> /etc/apache2/sites-available/${PROJECT}.conf

		sudo echo "127.0.0.1	${URL}" >> /etc/hosts
		
		a2ensite ${PROJECT}
		service apache2 restart

		echo "Informe seu usuário (Usuário da máquina)"
		read user
		chown ${user}.${user} ${PASTA} -Rf
	fi
}

desinstalar(){
	if [ -d "vendor" ]; then
		aguardar "Iniciando desinstalação"

		a2dissite ${PROJECT}
		rm /etc/apache2/sites-available/${PROJECT}.conf
		service apache2 restart

		rm vendor -Rf
		rm .env		
	else
		echo "Aplicação ainda não foi instalada!"
	fi
}

case "$1" in
	"install") clear; instalar ;;
	"uninstall") clear; desinstalar ;;
	*) echo "Use os parametros install ou uninstall"
esac 
