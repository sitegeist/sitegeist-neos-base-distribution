# php
export CONF_PHP_PHPINI=./Build/Docker/Config/php/php.ini

# nginx
export PORT_NGINX=8081
export CONF_NGINX_VHOST=./Build/Docker/Config/nginx/vhost.conf

# mariadb
export PORT_MARIADB=33061
export CONF_MARIADB_MYCNF=./Build/Docker/Config/mariadb/my.cnf
export CRED_MYSQL_ROOT_PASSWORD=toor
export CRED_MYSQL_DATABASE=app
export CRED_MYSQL_USER=toor
export CRED_MYSQL_PASSWORD=toor

# elasticsearch
export PORT_ELASTICSEARCH=9200

# ssh
export CONF_SSH=./Docker/Config/ssh/config

# local environment
export DIR_CONFIG_GLOBAL=$(HOME)/.neos
export DIR_CONFIG_LOCAL=./Custom

config::
	@echo ".env config"
	@echo "______________________________________________"
	@echo ""
	@echo "Versions"
	@echo "--------"
	@echo "Php-fpm: $(VERSION_PHP)"
	@echo "MariaDB: $(VERSION_MARIADB)"
	@echo ""
	@echo "Ports"
	@echo "-----"
	@echo "Nginx port: $(PORT_NGINX)"
	@echo "MariaDB port: $(PORT_MARIADB)"
	@echo "Elasticsearch port: $(PORT_ELASTICSEARCH)"
	@echo ""
	@echo "Configuration files"
	@echo "-------------------"
	@echo "Php php.ini: $(CONF_PHP_PHPINI)"
	@echo "MariaDB my.cnf: $(CONF_MARIADB_MYCNF)"
	@echo "Node .yarnrc: $(CONF_NODE_YARNRC)"
	@echo "Nginx vhost: $(CONF_NGINX_VHOST)"
	@echo "SSH config: $(CONF_SSH)"
	@echo ""
	@echo "Credentials"
	@echo "-----------"
	@echo "MySQL database: $(CRED_MYSQL_DATABASE)"
	@echo "MySQL user: $(CRED_MYSQL_USER)"
	@echo "MySQL password: $(CRED_MYSQL_PASSWORD)"
	@echo "MySQL root-password: $(CRED_MYSQL_ROOT_PASSWORD)"
	@echo ""
	@echo ""
	@echo "docker config"
	@echo "______________________________________________"
	@docker-compose config
