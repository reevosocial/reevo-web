<?php

$guid = (int) get_input('guid');
$entity = get_entity($guid);

$metadata = get_input('metadata');

$entity->$metadata = true;

$url = $entity->getURL();
$desc = substr(urlencode(strip_tags($entity->description)), 0, 1500);

forward('http://fb.reevo.org/api/?url='.$url.'&desc='.$desc);
