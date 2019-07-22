-include ./DomainScripts/project.env.makefile

host-add::
	@/bin/bash -c "./DomainScripts/add.sh"

host-remove::
	@/bin/bash -c "./DomainScripts/remove.sh"

multidomain-add::
	@/bin/bash -c "./DomainScripts/multidomain.sh"

elasticsearch-add::
	@/bin/bash -c "./DomainScripts/elasticsearch-add.sh"

elasticsearch-remove::
	@/bin/bash -c "./DomainScripts/elasticsearch-remove.sh"

mailhog-add::
	@/bin/bash -c "./DomainScripts/mailhog-add.sh"

mailhog-remove::
	@/bin/bash -c "./DomainScripts/mailhog-remove.sh"
