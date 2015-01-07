# Reevo - Plataforma Web
## Rama DEV -  Versión 15.01.02

La Plataforma Web busca ingegrar diversas herramientas libres. Este repositorio incluye una estructura comun para la gestión del código de las diversas herramientas.

## Herramientas incluidas

* blog: Wordpress 4.0 [OUTDATED]
	* CiviCRM: 4.4.6 [OUTDATED]
* equipo: Redmine 4.5 [OUTDATED]
* red: Elgg 1.9.7
* wiki: MediaWiki 1.20.0 [OUTDATED]
* admin
	* phpMyAdmin: 4.3.3


## Estructura de directorios

```
.
├── bin
│   └── sync
├── etc
│   ├── init.d
│   ├── nginx
│   ├── php-fpm
├── files
├── lib
│   ├── blog-plugins
│   ├── equipo-plugins
│   ├── red-plugins
│   ├── theme
│   └── wiki-plugins
├── log
├── run
├── tmp
└── www
    ├── admin
    ├── blog
    ├── equipo
    ├── red
    └── wiki
```


## ToDo

* Unificar la gestion de idiomas
** Wordpress: https://downloads.wordpress.org/translation/core/4.0/es_ES.zip
** CiviCRM: http://sourceforge.net/projects/civicrm/files/civicrm-stable/4.4.6/civicrm-4.4.6-l10n.tar.gz/download
** Elgg: https://www.transifex.com/projects/p/elgg-core/language/es/

## Licencias

Todo:

* Especificar las licencias de cada pieza.
* Incluir la licencia AGPL en todo el codigo propio
