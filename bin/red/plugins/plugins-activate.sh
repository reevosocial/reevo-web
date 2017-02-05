#!/bin/bash
# Este script instala los plugins empaquetados con Reevo. Resulta útil luego de implementar una nueva versión de Elgg.

cd /srv/reevo-web/www/red/mod

echo "Disponibilizando los plugins alojados en /lib/red-plugins ..."
for i in `ls -lah | grep ">" |cut -d " " -f 13`; do rm  $i; done
echo ""

for i in `ls  -d ../../../lib/red-plugins/*/`;
  do
    ln -s $i
    PLUGIN=`echo $i | cut -d "/" -f6`
    #echo "Se instaló el plugin: $PLUGIN"
  done

echo "Activando plugins indicados en plugins.list"
echo ""

cd /srv/reevo-web/bin/red/plugins

source ../../database_auth.sh

PLUGINS=`cat plugins.list  | grep -v '#' | grep -v -e '^$' | awk -vORS=, '{ print $1 }'  | sed 's/,$/\n/' | sed 's/,,/,/g' | sed 's/,*$//g'`

# desactiva todos los plugins
../../../www/red/vendor/bin/elgg-cli plugins:deactivate --all

echo ""
echo "------------------"
echo ""

# activa todos los listados en plugins.list en el orden sugerido
# y activa plugins de desarrollo en funcion si estamos en entornos de desarrollo
if [ $VERSION == "ALFA" ] || [ $VERSION == "BETA" ]
then
  ../../../www/red/vendor/bin/elgg-cli plugins:activate "$PLUGINS,developers"
else
  ../../../www/red/vendor/bin/elgg-cli plugins:activate "$PLUGINS"
fi

#limpia caches
echo ""
echo "Limpio el cache..."
../../../www/red/vendor/bin/elgg-cli site:flush_cache
