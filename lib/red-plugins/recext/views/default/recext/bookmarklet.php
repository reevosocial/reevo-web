<?php
/**
 * Bookmarklet
 *
 * @package Bookmarks
 */

$page_owner = elgg_get_page_owner_entity();

if ($page_owner instanceof ElggGroup) {
	$title = elgg_echo("recext:this:group", array($page_owner->name));
} else {
	$title = elgg_echo("recext:this");
}


if (!$name && ($user = elgg_get_logged_in_user_entity())) {
	$name = $user->username;
}

$guid = elgg_get_logged_in_user_guid();

$url = elgg_get_site_url();
$img = elgg_view('output/img', array(
	'src' => 'mod/recext/graphics/recextlet.gif',
	'alt' => $title,
));

$tags = elgg_echo("recext:recextlet:tags");
$link = elgg_echo("recext:recextlet:button");
$recextlet = "<a target='_blank' id='recext-bookmarklet' href=\"javascript: var t=prompt('{$tags}',''); var u=window.location.hostname; var u2=u.replace('www.',''); var f=u2.charAt(0).toUpperCase() + u2.slice(1); if (document.querySelector('meta[property=\'og:image\']')) {var img=document.querySelector('meta[property=\'og:image\']').content} else {var img=''};; var h='',s,g,c,i;if(window.getSelection){s=window.getSelection();if(s.rangeCount){c=document.createElement('div');for(i=0;i<s.rangeCount;++i){c.appendChild(s.getRangeAt(i).cloneContents());}h=c.innerHTML}}else if((s=document.selection)&&s.type=='Text'){h=s.createRange().htmlText;};window.open('{$url }recext/add/{$guid}?address='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title)+'&description='+encodeURIComponent(h)+'&image='+encodeURIComponent(img)+'&source='+encodeURIComponent(f)+'&tags='+encodeURIComponent(t))\">{$link}</a>";

?>
<p><?php echo elgg_echo("recext:recextlet:description"); ?></p>
<p><?php echo $recextlet; ?></p>
<p><?php echo elgg_echo("recext:recextlet:descriptionie"); ?></p>
<p><?php echo elgg_echo("recext:recextlet:description:conclusion"); ?></p>
