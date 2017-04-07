.elgg-icon-recext {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/recext/graphics/recext.gif);
}

#recext-bookmarklet {
	border: 0 rgba(0,0,0,0);
	background-color: #E6E6E6;
	text-decoration: none;
	border-radius: 2px;
	box-shadow: 0 0 0 1px rgba(0,0,0,.15) inset,0 0 6px rgba(0,0,0,.2) inset;
	padding: 5px 10px;
	color: black;
	cursor: move;
}
#recext-bookmarklet:hover {
	color: black;
}

.list-recext li a {
	width: 50%;
	float: left;
	box-sizing: border-box;
	border: 5px solid white;
	position: relative;
	min-height: 200px;
	 background-size: cover;
}

.list-recext li a header  {
  position: absolute;
  bottom: 0px;
  left: 0px;
  background: rgba(0, 0, 0, 0.75);
  padding: 4px 8px;
  color: white;
  margin: 0;
  font-size: 10pt;
}

.list-recext li a header h3 {
	color: white
}

.list-recext li a{
	-webkit-filter: grayscale(0%);
	filter: grayscale(0%);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
}
.list-recext li a:hover {
	-webkit-filter: grayscale(100%);
	filter: grayscale(100%);
}

.recext-single-image {
	display: block;
	float: right;
	width: 50%;
	box-sizing: border-box;
	border: solid 1px #CCC;
	-moz-box-shadow: 1px 1px 5px #999;
	-webkit-box-shadow: 1px 1px 5px #999;
	box-shadow: 1px 1px 5px #999;
}

.recext-single-desc {
	display: block;
	float: left;
	width: 50%;
	padding-right: 2em;
	box-sizing: border-box;

}

.recext-single-link {
	color: #0054A7;
	font-size: 1.2em;
	font-weight: bold;
	display: block;
	width: 50%;
	float: left;
	padding-right: 2em;
	box-sizing: border-box;
}

.elgg-river-item-recext .elgg-river-message {
	width: 75%;
	display: block;
	float: left;
	box-sizing: border-box;
}

.elgg-river-item-recext .elgg-river-attachments {
	width: 25%;
	display: block;
	float: right;
	border: none;
	box-sizing: border-box;
}


.elgg-river-item-recext .elgg-river-attachments img {
	width: 100%;
	border: solid 1px #CCC;
	-moz-box-shadow: 1px 1px 5px #999;
	-webkit-box-shadow: 1px 1px 5px #999;
	box-shadow: 1px 1px 5px #999;

}
