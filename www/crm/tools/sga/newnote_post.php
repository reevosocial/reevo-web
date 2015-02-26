

<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="es-ES">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="es-ES">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nueva nota cargada</title>

<link rel="stylesheet" href="css/style.css" type="text/css" media="print, projection, screen" />

<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>

</head>
<body>

<?php
// To create a note
require_once "/srv/reevo/crm.reevo.org/civicrm/civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

require('/srv/reevo/blog.reevo.org/wp-blog-header.php');
// Get WP current user id
$user_ID = get_current_user_id(); 
// Get the CRM id of the WP user
$result = civicrm_api3('uf_match', 'get', array('uf_id' => $user_ID,));
$key = array_keys($result['values']);
$current_user = $result['values'][$key[0]]['contact_id'];



$contact = civicrm_api('Note','Create',array('entity_id' => $_POST['contact'], 'note' => $_POST['body'], 'subject' => $_POST['subject'], 'contact_id' => $current_user, 'version' =>3, 'json' => '1'));

$id_nota = $contact['id'];

echo "<b>La nota se ha cargado con éxito</b><br>";
echo '<a href="JavaScript:window.close()">[Cerrar]</a> | <a target="_blank" href="/wp-admin/admin.php?page=CiviCRM&q=civicrm/contact/view/note&action=delete&reset=1&cid='.$_POST['contact'].'&selectedChild=note&id='.$id_nota.'">[Eliminar nota]</a>';


?>
