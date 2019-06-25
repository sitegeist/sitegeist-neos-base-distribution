-include ./DomainScripts/project.env.makefile

host-add::
	@/bin/bash -c "./DomainScripts/add.sh"

host-remove::
	@/bin/bash -c "./DomainScripts/remove.sh"

domain-add::
	@/bin/bash -c "./DomainScripts/add.sh"
	@docker-compose exec --user $(HOST_USER) php-fpm ssh-agent /bin/bash -c "./flow domain:add bahnreisende $(PROJECT_HOSTNAME)"

domain-remove::
	@/bin/bash -c "./DomainScripts/remove.sh"
	@docker-compose exec --user $(HOST_USER) php-fpm ssh-agent /bin/bash -c "./flow domain:delete $(PROJECT_HOSTNAME)"