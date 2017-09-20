
<?php
/**
 * Edit / add a recext
 *
 * @package Bookmarks
 */

$url = elgg_extract('url', $vars, '');

?>
<div>
	<label><?php echo elgg_echo('reevo_custom:fbevent:url'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'url', 'value' => $url, 'maxlength' => '72')); ?>
</div>

<div class="elgg-foot">
<?php

echo elgg_view('input/submit', array('value' => elgg_echo("import")));

?>
</div>
<?php
$url = elgg_get_site_url();
$img = elgg_view('output/img', array(
	'src' => 'mod/recext/graphics/recextlet.gif',
	'alt' => $title,
));

$tags = elgg_echo("reevo_custom:fbevent:tags");
$link = elgg_echo("reevo_custom:fbevent:button");
$recextlet = "<a target='_blank' id='recext-bookmarklet' href=\"javascript: var t=prompt('{$tags}',''); var u=window.location.hostname; var u2=u.replace('www.',''); var f=u2.charAt(0).toUpperCase() + u2.slice(1); if (document.querySelector('meta[property=\'og:image\']')) {var img=document.querySelector('meta[property=\'og:image\']').content} else {var img=''};; var h='',s,g,c,i;if(window.getSelection){s=window.getSelection();if(s.rangeCount){c=document.createElement('div');for(i=0;i<s.rangeCount;++i){c.appendChild(s.getRangeAt(i).cloneContents());}h=c.innerHTML}}else if((s=document.selection)&&s.type=='Text'){h=s.createRange().htmlText;};window.open('{$url }/events/event/new?fbevent='+encodeURIComponent(location.href)+'&tags='+encodeURIComponent(t))\">{$link}</a>";

?>
<p><?php echo elgg_echo("reevo_custom:fbevent:description"); ?></p>
<p><?php echo $recextlet; ?></p>
<p><?php echo elgg_echo("reevo_custom:fbevent:descriptionie"); ?></p>
<p><?php echo elgg_echo("reevo_custom:fbevent:description:conclusion"); ?></p>
