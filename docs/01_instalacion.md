---
title: Instalacion
---

Explicamos como desplegar una implementación de las herramientas de Reevo paso a paso.

## Obtener el código

Se descarga la última versión via GIT y luego obtenemos los submodulos:

```
git clone https://git.reevo.org/reevo/reevo-web/ /srv/reevo-web
rv git pull && rv git submodule update --init --recursive
```

## Confgiurar nginx

Hacemos que nginx lea los archivos de configuración agregando la siguiente línea en ```/etc/nginx/nginx.conf```:

```
  include /srv/reevo-web/etc/nginx/*.conf;
```

Luego vamos en ```/srv/reevo-web/etc/nginx``` encontramos todos los archivos de configuracion de nginx, los cuales hay que renombrar para habilitar. Por ejemplo:

```
mv admin.conf.sample admin.conf
```

Lo primero que hacemos es mover


## Configurar acceso a base de datos

El acceso a las bases de datos se hacen con un usuario único que se define en el archivo ```/srv/reevo-web/etc/global_config.php```. Usamos como base el archivo de ejemplo:

```
mv global_config.php.sample global_config.php
```

Y luego editamos el archivo ajustando las siguientes variables:

```
$REEVO_URL 		= "example.org";
$REEVO_DB_USER	= "user";
$REEVO_DB_PASS	= "password";
```
También debemos ingresar esa información en ```/srv/reevo-web/bin```

```
rv mv database_auth.sh.sample database_auth.sh
```

## Importar base de datos desde el servidor principal

En caso de que quisieramos usar los scripts de sincronizacion que tenemos en ```/srv/reevo-web/bin/sync``` hay que hacer lo siguiente:

1. generar una clave RSA para el usuario local reevo: ```ssh-keygen``` y la incluimos en las authorized_keys del usuario reevo del servidor pincipal
2. crear una carpeta para almacenar temporalmente las bases de datos importadas: ```mkdir /home/reevo/tmp```
