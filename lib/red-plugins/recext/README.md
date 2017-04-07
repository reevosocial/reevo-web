## Recursos Externos

Este plugin está derivado de "bookmarks". Permite cargar los famosos RE de Reevo.

### Funcionalidades implementadas

* Campos adicionales
* Campos se muestran como valores Opengraph
* La imagen destacada se almacena localmente y la misma se elimina si se borra el RE
* Se incorporan metadatos a la imagen almacenada
* Verifica que un RE no exista previamente (comprueba la URL al grabar uno nuevo)

### Funcionalidades planeadas

* Migrar todos los RE al nuevo sistema
* Crear una vista
* Grabar una copia del RE de forma local para asegurar su conservación
* Hacer funcionar el bookmarklet


### Bugs

* La primera vez que se intenta crear un RE, la verificación de duplicados falla. Parece que un array vacio o nulo es el problema (linea 82 de save.php)
