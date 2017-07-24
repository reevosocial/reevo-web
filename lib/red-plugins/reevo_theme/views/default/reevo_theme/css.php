<?php
/**
 * CSS Aalborg theme
 *
 * @package AalborgTheme
 * @subpackage UI
 */
?>
/* <style> /**/

/* ***************************************
REEVO Customizations
*****************************************/

body {
	background-image: url('/mod/reevo_theme/graphics/background.jpg');
}
/*Topbar*/

.elgg-page-topbar {
	border:none;
}

.elgg-menu-topbar > li {
	height: 32px;
}

.elgg-menu-topbar > li > a.elgg-topbar-avatar {
	width: auto !important;
	height: 18px;
	padding-top: 7px;
	display: inline-flex;
}

.elgg-page-topbar .elgg-avatar > a > img {
	display: inline;
}

.elgg-page-topbar .profile-text {
	display: inline-block;
	vertical-align: middle;
	line-height: normal;
	padding-left: 4pt;
}

.elgg-page-topbar  #login-dropdown {
	position: relative;
	float: right;

}
.elgg-page-topbar  #login-dropdown a {
	padding: 6px 10px 6px;
}

.elgg-page-topbar .elgg-menu-item-logout {
	border-top: 1px solid #ddd;
}

/*Navbar*/
.elgg-page-navbar .elgg-search-header {
	float: right;
	width: 21.212121%;
	margin-bottom: 0px;
}

.elgg-page-navbar .elgg-search-header input {
	box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.1);
	margin: 9px 0 0 0;
}

#topbar-menu-text {
	float: left;
	display: block;
}

#topbar-menu-text li {
	font-size: 9pt;
	padding: 5px 10px;
	height: 32px;
  box-sizing: border-box;
	display: inline-block;
}

#topbar-menu-text li a {
	color: #ccc;
}

#topbar-menu-text li:hover {
	color: #fff;
	background-color: #19191A;
	text-decoration: none;
}

#topbar-menu-text li:hover a, #topbar-menu-text li a:hover {
	color: #fff;
	background-color: #19191A;
	text-decoration: none;
}

.elgg-avatar-topbar img {
	border: 1px solid #ccc;
}

.elgg-menu-item-messages {
	display: none;
}


/* ***************************************
	MISC
*****************************************/
#dashboard-info {
	border: 1px solid #DCDCDC;
	margin: 0 10px 15px;
}
.elgg-sidebar input[type=text],
.elgg-sidebar input[type=password] {
	box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.1);
}
.elgg-module .elgg-list-river {
	border-top: none;
}
.elgg-module .elgg-list {
	margin-top: 0;
}
/* ***************************************
	TOPBAR MENU DROPDOWN
*****************************************/
.elgg-topbar-dropdown {
	padding-bottom: 8px; /* forces button to reach bottom of topbar */
}
.elgg-menu-topbar > li > .elgg-topbar-dropdown:hover {
	color: #EEE;
	cursor: default;
}
.elgg-menu-topbar-alt ul {
	position: absolute;
	display: none;
	background-color: #FFF;
	border: 1px solid #DEDEDE;
	text-align: left;
	top: 32px;
	margin-left: -100px;
	width: 180px;

	border-radius: 0 0 3px 3px;
	box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.25);
}
.elgg-menu-topbar-alt li ul > li > a {
	text-decoration: none;
	padding: 10px 20px;
	background-color: #FFF;
	color: #444;
}
.elgg-menu-topbar-alt li ul > li > a:hover {
	background-color: #F0F0F0;
	color: #444;
}
.elgg-menu-topbar-alt > li:hover > ul {
	display: block;
}
.elgg-menu-item-account > a:after {
	content: "\bb";
	margin-left: 6px;
}


#elgg-widget-content-1707 .elgg-item {
	padding: 0 10px;
}

.elgg-widget-content .elgg-gallery-users .elgg-item {
	padding: 0px;
}

.elgg-module-widget.widget_manager_disable_widget_content_style > .elgg-head {
	border: none;
}

.event-manager-event-when .elgg-body {
	padding-left: 15px;
}

.event-manager-event-banner img {
	max-height: 100%;
}

.event-manager-event-banner-bg-blur {
	background-blend-mode: color-dodge;
  background-color: #999;
  background-position-y: center;
  background-size: cover;
}


/* ***************************************
	RESPONSIVE
*****************************************/
html {
	font-size: 100%;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.elgg-button-nav {
	display: none;
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	color: #FFF;
	float: left;
	padding: 14px 18px;
}
.elgg-button-nav:hover {
	color: #FFF;
	text-decoration: none;
	background-color: #60B8F7;
}
.elgg-button-nav .icon-bar {
	background-color: #F5F5F5;
	border-radius: 1px 1px 1px 1px;
	box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
	display: block;
	height: 2px;
	width: 22px;
}
.elgg-button-nav .icon-bar + .icon-bar {
	margin-top: 3px;
}
@media (max-width: 1030px) {
	.elgg-menu-topbar-default > li:first-child a {
		margin-left: 0;
	}
	.elgg-menu-topbar-alt > li > a.elgg-topbar-dropdown {
		margin-right: 0;
	}
	.elgg-page-footer {
		padding: 0 20px;
	}
}
@media (max-width: 820px) {
	.elgg-page-default {
		min-width: 0;
	}
	.elgg-page-body {
		padding: 0;
	}
	.elgg-main {
        padding: 12px 20px 10px;

		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
    }
    .elgg-layout-one-sidebar .elgg-main,
	.elgg-layout-two-sidebar .elgg-main {
        width: 100%;
    }
	.elgg-sidebar {
		border-left: none;
		border-top: 1px solid #DCDCDC;
		border-bottom: 1px solid #DCDCDC;
		background-color: #FAFAFA;
		width: 100%;
		float: left;
		padding: 27px 20px 20px;
		box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05) inset;

		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.elgg-sidebar-alt {
		display: none;
	}
	.elgg-page-default .elgg-page-footer > .elgg-inner {
		border-top: none;
	}
	.elgg-menu-footer {
		float: none;
		text-align: center;
	}
	.elgg-menu-page,
	.elgg-sidebar .elgg-menu-owner-block,
	.elgg-menu-groups-my-status {
		border-bottom: 1px solid #DCDCDC;
	}
	.elgg-menu-page a,
	.elgg-sidebar .elgg-menu-owner-block li a,
	.elgg-menu-groups-my-status li a {
		border-color: #DCDCDC;
		border-style: solid;
		border-width: 1px 1px 0 1px;
		margin: 0;
		padding: 10px;
		background-color: #FFFFFF;
	}
	.elgg-menu-page a:hover,
	.elgg-sidebar .elgg-menu-owner-block li a:hover,
	.elgg-menu-groups-my-status li a:hover,
	.elgg-menu-page li.elgg-state-selected > a,
	.elgg-sidebar .elgg-menu-owner-block li.elgg-state-selected > a,
	.elgg-menu-groups-my-status li.elgg-state-selected > a {
		color: #444;
		background-color: #F0F0F0;
		text-decoration: none;
	}
	.elgg-river-item input[type=text] {
		width: 100%;
	}
	.elgg-river-item input[type=submit] {
		margin: 5px 0 0 0;
	}
	/***** CUSTOM INDEX ******/
	.elgg-col-1of2 {
		float: none;
		width: 100%;
	}
	.prl {
		padding-right: 0;
	}
	/***** WIDGETS ******/
	.elgg-col-1of3,
	.elgg-col-2of3,
	#elgg-widget-col-1,
	#elgg-widget-col-2,
	#elgg-widget-col-3 {
		float: none;
		min-height: 0 !important;
		width: 100%;
	}
	.elgg-module-widget {
		margin: 0 0 15px;
	}
	.custom-index-col1 > .elgg-inner,
	.custom-index-col2 > .elgg-inner {
		padding: 0;
	}
	#dashboard-info {
		margin: 0 0 15px;
	}
}

@media (min-width: 1280px) {
	.body-index #elgg-widget-col-1	.elgg-river-item-recext .elgg-river-attachments {
		max-width: 150px;
	}
}

@media (min-width: 767px) {
	.elgg-nav-collapse {
		display: block !important;
	}

}
@media (max-width: 766px) {
	.body-index #elgg-widget-col-1, .body-index #elgg-widget-col-2 {
		width: 100%;
	}

	.elgg-page-header > .elgg-inner h1 {
		padding-top: 10px;
	}
	.elgg-heading-site, .elgg-heading-site:hover {
		font-size: 1.6em;
	}
	.elgg-button-nav {
		cursor: pointer;
		display: block;
	}
	.elgg-nav-collapse {
		clear: both;
		display: none;
		width: 100%;
	}
	#login-dropdown a {
		padding: 10px 18px;
	}
	.elgg-menu-site {
		float: none;
	}
	.elgg-menu-site > li > ul {
		position: static;
		display: block;
		left: 0;
		margin-left: 0;
		border: none;
		box-shadow: none;
		background: none;
	}
	.elgg-more,
	.elgg-menu-site-more li,
	.elgg-menu-site > li > ul {
		width: auto;
	}
	.elgg-menu-site ul li {
		float: none;
		margin: 0;
	}
	.elgg-more > a {
		border-bottom: 1px solid #294E6B;
	}
	.elgg-menu-site > li {
		border-top: 1px solid #294E6B;
		clear: both;
		float: none;
		margin: 0;
	}
	.elgg-menu-site > li:first-child {
		border-top: none;
	}
	.elgg-menu-site > li > a {
		padding: 10px 18px;
	}
	.elgg-menu-site-more > li > a {
		color: #FFF;
		background: none;
		padding: 10px 18px 10px 30px;
	}
	.elgg-menu-site-more > li:last-child > a,
	.elgg-menu-site-more > li:last-child > a:hover {
		border-radius: 0;
	}
	.elgg-menu-site-more > li.elgg-state-selected > a,
	.elgg-menu-site-more > li > a:hover {
		background-color: #60B8F7;
		color: #FFF;
	}

	.elgg-page-navbar .elgg-search-header {
		float: right;
		width: 50%;
		margin-bottom: 0px;
	}
	.elgg-page-navbar .elgg-search-header input {
		margin: 5px 0 0 0;
	}

}
@media (max-width: 600px) {
	.groups-profile-fields {
		float: left;
		padding-left: 0;
	}
	#profile-owner-block {
		border-right: none;
		width: auto;
	}
	#profile-details {
		display: block;
		float: left;
	}
	#groups-tools > li {
		width: 100%;
		margin-bottom: 20px;
	}
	#groups-tools > li:nth-child(odd) {
		margin-right: 0;
	}
	#groups-tools > li:last-child {
		margin-bottom: 0;
	}
	.elgg-menu-entity, .elgg-menu-annotation {
		margin-left: 0;
	}
	.elgg-menu-entity > li, .elgg-menu-annotation > li {
		margin-left: 0;
		margin-right: 15px;
	}
	.elgg-subtext {
		float: left;
		margin-right: 15px;
	}
}


@media (max-width: 500px) {

	.list-recext li a {
		width: 100% !important;
	}

	.recext-single-image {
		display: block;
		float: right;
		width: 100% !important;
		padding-left: 0em !important;
		box-sizing: border-box;
	}

	.recext-single-desc, .recext-single-link {
		display: block;
		float: left;
		width: 100% !important;
	}


}
