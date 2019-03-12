# contact-manager-laravel 
This is a contact manager containing admin and user roles. Image upload is performed via laravel. Migrations and seeders are also in place.

# Ubuntu Server Setup

Client Machine
--------------
Download GIT SCM https://git-scm.com/

Create a git repository on github.com

Initialize a git repository on your client machine (One time only per project)
    git init
    
Link it to your project(One time only per project)
	git remote add origin https://github.com/veliyat/zeolearn-laravel-taskmanager.git
    
Add and commit files
    git add .
    git commit -m "abcd"

Commit the code of your project to github.com
    git push orgin master

Ubuntu Server
-------------
    update the apt repo (sudo apt update)
    install nginx (sudo apt install nginx) EngineX Server
    install mysql (sudo apt install mysql-server)
    secure mysql (sudo mysql_secure_installation)
    GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' IDENTIFIED BY 'password';
    
    Install PHP 7.1
	    sudo apt-get install software-properties-common
	    sudo add-apt-repository ppa:ondrej/php	
	    sudo apt-get update
	    sudo apt-get install php7.1
	    sudo apt-get install php7.1-fpm php7.1-mysql php7.1-mbstring php7.1-cli php7.1-common php7.1-json php7.1-opcache php7.1-mcrypt php7.1-zip
	    sudo apt-get install php7.1-xml php7.1-gd
	    sudo apt-get install php7.1-intl (optional)
	    sudo apt-get install php7.1-xsl (optional)

    config php installation
	    /etc/php/7.1/fpm/php.ini (cgi.fix_pathinfo=0)

    restart php fpm
	    sudo systemctl restart php7.1-fpm
    
    config nginx installation
	    /etc/nginx/sites-available/default
	
    Change the root to /var/www/app/public;
	add index.php to the list of files served by default
	change server_name from _ to IP.
	pass php scripts to fast cgi server
		uncomment location, include and fastcgi_pass
	deny access to htaccess files (uncomment the location .ht section)
    Test the config of nginx (sudo nginx -t)

    Reload nginx server (sudo systemctl reload nginx)

Laravel Project Upload
---------------------------------------------------------------
    Upload laravel project to web root (/var/www)
	    create a new directory in www called app
	    change the nginx default config to point to public folder (Nginx Config)
	    change the fallback url to /index.php?$query_string (Nginx Config)
	    Restart nginx server (sudo service nginx restart)
    
    Make a swap file (only for less memory)
	    sudo fallocate -l 1G /swapfile
	    sudo mkswap /swapfile
	    sudo swapon /swapfile

    Install Composer
	    curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

    Git Installation
	    Git is installed by default
	    make a dir /var/repo
	    cd /var/repo
	    mkdir site.git

    Git Init
	    cd site.git
	    git init --bare
    
    Create the post-receive hook
	    cd hooks
	create post-receive file
		#!/bin/bash
		git --work-tree=/var/www/laravel --git-dir=/var/repo/site.git checkout -f
	
    Change permissions (sudo chmod +x post-receive)

Client Machine
--------------
	cd into your project folder
	add the new remote origin to production server
		git remote add production ssh://root@45.77.109.61/var/repo/site.git
	push the code to production server (git push production master)

Ubuntu Server
-------------
	cd into yoru laravel app folder
	composer install --no-dev	
	sudo chown -R www-data:www-data /var/www/app
	sudo chmod -R 775 /var/www/app/storage
	sudo chmod -R 775 /var/www/app/bootstrap/cache
	create .env file
	php artisan key:generate
	php artisan config:cache

	if you are using storage in public
		php artisan storage:link
