/*
 * @override mod/groups/views/default/discussion/css.php
 */

.replies {
	margin-left: 30px;
}

.elgg-group-module .groups-latest-reply {
	float: none;
}

.elgg-item-object-topicreply {
  border-left: 1px solid #ccc;
}

.elgg-item-object-topicreply:before,
.elgg-item-object-topicreply:after {
  content: "";
  position: absolute;
  height: 10px;
  border-bottom: 1px solid white;
  border-top: 1px solid white;
  top: 0;
  width: 600px;
}
.elgg-item-object-topicreply:before {
  right: 100%;
  margin-right: 15px;
}
.elgg-item-object-topicreply:after {
  left: 100%;
  margin-left: 15px;
}
