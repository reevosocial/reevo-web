# CRM Load States

Una simple libreria de JS que permite cargar países y provincias/estados de forma dinámica, usando los códigos de CiviCRM

## Cómo usarlo

Se necesiten al menos dos elementos ```select``` (uno para listar países y el otro para las provincias/estados). Luego se le pasa el ```id``` de cada uno a la función ```IniciaCRMLoadStates```:

```
  IniciaCRMLoadStates(<id del selectbox de pais>,<id del selectbox de estad>,<codigo de pais elegido por defecto>);
```

Bloque de ejemplo:

```
<script type="text/javascript" src="/js/crm-loadstates/loadstates.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
  IniciaCRMLoadStates('pais','estado','1010'); //1010 es Argentina
});
</script>
```

Dentro de la carpeta ```/json``` hay un archivo por cada país que lista sus respectivas provincias. Ahi mismo hay un script de php que genera esos archivos usando el API de CiviCRM.

## Implementado en:

* reevo-donation-membership-form: http://git.reevo.org/civicrm/reevo-donation-membership-form/
