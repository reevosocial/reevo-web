<?php
/**
 * Message on members only, closed membership group profile pages when user
 * cannot access group content.
 *
 * @package ElggGroups
 */

?>
<div class="message is-danger">
    <div class="message-body">
        <p>
			<?php
			echo elgg_echo('groups:closedgroup:membersonly');
			if (elgg_is_logged_in()) {
				echo ' ' . elgg_echo('groups:closedgroup:request');
			}
			?>
        </p>
    </div>
</div>