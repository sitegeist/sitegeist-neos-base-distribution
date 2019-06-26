-include ./DomainScripts/project.env.makefile

host-add::
	@/bin/bash -c "./DomainScripts/add.sh"

host-remove::
	@/bin/bash -c "./DomainScripts/remove.sh"

multidomain-add::
	@/bin/bash -c "./DomainScripts/multidomain.sh"