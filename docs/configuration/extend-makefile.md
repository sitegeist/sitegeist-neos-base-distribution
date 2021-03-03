# Override and extend Makefile commands

You can extend the existing Makefile commands, or/and add own commands for your local use with additional Makefiles.

* [Local Config files](#local-config-files)
* [Prepend code to existing make commands](#prepend-code-to-existing-make-commands)
* [Append code to existing make commands](#append-code-to-existing-make-commands)
* [Add own make commands](#add-own-make-commands)

## Local Config files

The default overriding files for prepending and appending code to an existing Makefile command are:

__local:__
_./Custom/before.makefile_
_./Custom/after.makefile_

__global:__
_~/.neos/before.makefile_
_~/.neos/after.makefile_

If you want to use another path you can configure this path in your __Build/config.makefile__ file:

```makefile
export DIR_CONFIG_GLOBAL=$(HOME)/.neos
export DIR_CONFIG_LOCAL=./Custom
```

E.g. for usage with an global makefile to add commands to all your projects with this setup.

**Note:** Use the **_command::_** Syntax. Don't use **_command:_**

## Prepend code to existing make commands

Original command within _Makefile_:

```makefile
help::
    @echo ""
    @echo "Command           | Shorthand | Description"
    @echo ""
```

Extensing with a prepending echo command in your _./Custom/before.makefile_ file:

```makefile
help::
    @echo "This is a prepending echo :)"
```

Result:

```bash
$ make help

This is a prepending echo :)

Command           | Shorthand | Description

```

## Append code to existing make commands

Original command within _Makefile_:

```makefile
help::
    @echo ""
    @echo "Command           | Shorthand | Description"
    @echo ""
```

Extending with a appending echo command in your _./Custom/after.makefile_ file:

```makefile
help::
    @echo "This is a appending echo :)"
```

Result:

```bash
$ make help

Command           | Shorthand | Description

This is a appending echo :)
```

## Add own make commands

To add own commands, you can just create a new command in one of both files.

```makefile
mycommand::
    @echo "This is my additional command."
```
