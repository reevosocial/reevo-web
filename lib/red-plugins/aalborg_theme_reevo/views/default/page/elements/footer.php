<?php
$conf['site_footer'] = '<p><b>Reevo - Red de Educación Alternativa</b> | <em> Version: '; $conf['site_footer'] .= shell_exec("cd /srv/reevo-web/ && git describe"); $conf['site_footer'] .= '</em></p>';
echo $conf['site_footer'];

?>
