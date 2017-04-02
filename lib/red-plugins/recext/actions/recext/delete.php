<?php
/**
 * Delete a recext
 *
 * @package Bookmarks
 */
$root = getcwd();
$guid = get_input('guid');
$recext = get_entity($guid);

if (elgg_instanceof($recext, 'object', 'recext') && $recext->canEdit()) {
	$container = $recext->getContainerEntity();
	if ($recext->delete()) {
		if (file_exists("$root/recext-store/$guid")) {
			foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator("$root/recext-store/$guid", FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
					$path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
				}
			rmdir("$root/recext-store/$guid");
		}
			system_message(elgg_echo("recext:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("recext/group/$container->guid/all");
		} else {
			forward("recext/owner/$container->username");
		}
	}
}

register_error(elgg_echo("recext:delete:failed"));
forward(REFERER);
