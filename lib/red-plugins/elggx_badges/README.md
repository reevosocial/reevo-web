Elggx Bagdes plugin for Elgg 1.10 - 1.12
========================================

Latest Version: 1.10.15  
Released: 2015-10-10  
Contact: iionly@gmx.de  
License: GNU General Public License version 2  
Copyright: (c) iionly (for Elgg 1.8 and newer), Billy Gunn


Description
-----------

This plugin allows users to be awarded a badge based on a configurable number of userpoints. Alternatively, the badges can also be assigned manually.

To use the automatic assign feature depending on userpoints your need the Elggx Userpoints plugin, too.

The badge will show below the profile picture on the user's profile pages. There's also the option to display the badges as overlay of the avatars. If you intend to use the overlay option, it requires the badge images to be of size 16x16 pixels or they won't get displayed completely! Larger images wouldn't work especially for the smaller versions of the avatars. The avatars would either be completely covered or the badge might even be larger than the avatar itself. The badge overlay is displayed in the upper-left corner of the avatar (lower-right seemed a bad idea due to the hover menu link and also because Elgg 1.8 (and later) doesn't increase the size of smaller profile images anymore like in previous versions).


Installation
------------

1. In case you have an earlier version of the Elggx Badges plugin installed it's best to remove the folder completely before copying the new version to the server,
2. Copy the elggx_badges folder into the mod directory of your Elgg installation,
3. Enable the plugin in the admin section of your site,
4. Configure then the plugin settings (section "Configure" - "Settings" - "Elggx Badges"). At last upload some Badges and enter the Badges details (section "Administer" - "Utilities" - "Elggx Badges").
