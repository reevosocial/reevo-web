<?php
$guid = elgg_extract('guid', $vars);
if (group_tools_blogadmin_access($guid) == 0) {
  register_error(elgg_echo('group_tools:group:blogadmin:error'));
  forward(REFERER);
}
?>
