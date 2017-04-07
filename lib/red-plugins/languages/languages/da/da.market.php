<?php
/**
 * Elgg Market Plugin
 * @package market
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author slyhne
 * @copyright slyhne 2010-2011
 * @link www.zurf.dk/elgg
 * @version 1.8
 */

$danish = array(
	
	// Menu items and titles	
	'market' => "Marked indlæg",
	'market:posts' => "Marked Indlæg",
	'market:title' => "Markedet",
	'market:user:title' => "%s's indlæg på Markedet",
	'market:user' => "%s's Marked",
	'market:user:friends' => "%s's venners Marked",
	'market:user:friends:title' => "%s's venners indlæg på Markedet",
	'market:mine' => "Mit Marked",
	'market:mine:title' => "Mine indlæg på Markedet",
	'market:posttitle' => "%s's Markeds emne: %s",
	'market:friends' => "Venners Marked",
	'market:friends:title' => "Mine venners indlæg på Markedet",
	'market:everyone:title' => "Alt på Markedet",
	'market:everyone' => "Alle Markeds Indlæg",
	'market:read' => "Vis indlæg",
	'market:add' => "Opret ny annonce",
	'market:add:title' => "Opret nyt indlæg på Markedet",
	'market:edit' => "Rediger annonce",
	'market:imagelimitation' => "Skal være JPG, GIF eller PNG.",
	'market:text' => "Lav en kort beskrivelse af dit emne",
	'market:uploadimages' => "Vil du gerne uploade et billede til dit emne?",
	'market:image' => "Emne image",
	'market:imagelater' => "",
	'market:strapline' => "Oprettet",
	'item:object:market' => 'Markeds indlæg',
	'market:none:found' => 'Ingen Markeds indlæg fundet',
	'market:pmbuttontext' => "Send privat besked",
	'market:price' => "Pris",
	'market:price:help' => "(i %s)",
	'market:text:help' => "(Ingen HTML og max. 250 karakter)",
	'market:title:help' => "(1-3 ord)",
	'market:tags' => "Tags",
	'market:tags:help' => "(Separer med kommaer)",
	'market:access:help' => "(Hvem skal kunne se dette Markeds indlæg?)",
	'market:replies' => "Svar",
	'market:created:gallery' => "Oprettet af %s <br>den %s",
	'market:created:listing' => "Oprettet af %s den %s",
	'market:showbig' => "Vis det store billede",
	'market:type' => "Type",
	'market:charleft' => "karakter tilbage",
	'market:accept:terms' => "Jeg har læst og accepterer %s.",
	'market:terms' => "betingelser",
	'market:terms:title' => "Betingelserne",
	'market:terms' => "<li class='elgg-divide-bottom'>The Market is for buying or selling used itemts among members.</li>
			<li class='elgg-divide-bottom'>No more than %s Marked posts are allowed pr. user at the same time.</li>
			<li class='elgg-divide-bottom'>Only one Marked post is allowed pr. item.</li>

			<li class='elgg-divide-bottom'>A Marked post may only contain one item, unless it's part of a matching set.</li>
			<li class='elgg-divide-bottom'>The Marked is for used/home made items only.</li>
			<li class='elgg-divide-bottom'>The Marked post must be deleted when it's no longer relevant.</li>
			<li class='elgg-divide-bottom'>Commercial advertising is limited to those who have signed a promotional agreement with us.</li>
			<li class='elgg-divide-bottom'>We reserve the right to delete any Marked posts violating our terms of use.</li>
			<li class='elgg-divide-bottom'>Terms are subject to change over time.</li>
			",

	// market widget
	'market:widget' => "My Marked",
	'market:widget:description' => "Showcase your posts on The Marked",
	'market:widget:viewall' => "View all my posts on The Marked",
	'market:num_display' => "Number of posts to display",
	'market:icon_size' => "Icon size",
	'market:small' => "small",
	'market:tiny' => "tiny",
		
	// market river
	'river:create:object:market' => '%s posted a new ad in the Marked %s',
	'river:update:object:market' => '%s updated the ad %s in the Market',
	'river:comment:object:market' => '%s commented on the Market ad %s',

	// Status messages
	'market:posted' => "Your Market post was successfully posted.",
	'market:deleted' => "Your Market post was successfully deleted.",
	'market:uploaded' => "Your image was succesfully added.",

	// Error messages	
	'market:save:failure' => "Your Market post could not be saved. Please try again.",
	'market:blank' => "Sorry; you need to fill in both the title and body before you can make a post.",
	'market:tobig' => "Sorry; your file is bigger then 1MB, please upload a smaller file.",
	'market:notjpg' => "Please make sure the picture inculed is a .jpg, .png or .gif file.",
	'market:notuploaded' => "Sorry; your file doesn't apear to be uploaded.",
	'market:notfound' => "Sorry; we could not find the specified Market post.",
	'market:notdeleted' => "Sorry; we could not delete this Market post.",
	'market:tomany' => "Error: Too many Market posts",
	'market:tomany:text' => "You have reached the maximum number of Market posts pr. user. Please delete some first!",
	'market:accept:terms:error' => "You must accept the terms of use!",

	// Settings
	'market:settings:status' => "Status",
	'market:settings:desc' => "Description",
	'market:max:posts' => "Max. number of market posts pr. user",
	'market:unlimited' => "Unlimited",
	'market:currency' => "Currency ($, €, DKK or something)",
	'market:allowhtml' => "Allow HTML in market posts",
	'market:numchars' => "Max. number of characters in market post (only valid without HTML)",
	'market:pmbutton' => "Enable private message button",
	'market:adminonly' => "Only admin can create market posts",
	'market:comments' => "Allow comments",
	'market:custom' => "Custom field",

	// market categories
	'market:categories' => 'Market categories',
	'market:categories:choose' => 'Choose type',
	'market:categories:settings' => 'Market Categories:',	
	'market:categories:explanation' => 'Set some predefined categories for posting to the market.<br>Categories could be "clothes, footwear or buy,sell etc...", seperate each category with commas - remember not to use special characters in categories and put them in your language files as market:<i>categoryname</i>',	
	'market:categories:save:success' => 'Site market categories were successfully saved.',
	'market:categories:settings:categories' => 'Market Categories',
	'market:all' => "All",
	'market:category' => "Category",
	'market:category:title' => "Category: %s",

	// Categories
	'market:buy' => "Buying",
	'market:sell' => "Selling",
	'market:swap' => "Swap",
	'market:free' => "Free",

	// Custom select
	'market:custom:select' => "Item condition",
	'market:custom:text' => "Condition",
	'market:custom:activate' => "Enable Custom Select:",
	'market:custom:settings' => "Custom Select Choices",
	'market:custom:choices' => "Set some predefined choices for the custom select dropdown box.<br>Choices could be \"market:new,market:used...etc\", seperate each choice with commas - remember to put them in your language files",

	// Custom choises
	 'market:na' => "No information",
	 'market:new' => "New",
	 'market:unused' => "Unused",
	 'market:used' => "Used",
	 'market:good' => "Good",
	 'market:fair' => "Fair",
	 'market:poor' => "Poor",
);
					
add_translation("da",$danish);
