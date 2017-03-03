<?php
$conf['site_footer'] = '<p><b>Reevo - Red de Educación Alternativa</b> | <em> Version: '; $conf['site_footer'] .= shell_exec("cd /srv/reevo-web/ && git log -1 --pretty=format:'%h (%ci)' --abbrev-commit"); $conf['site_footer'] .= '</em></p>';
echo $conf['site_footer'];

// elgg_require_js("aalborg_theme_reevo/clipboard-load");

?>
