<?php

elgg_load_library('elggman');

$sender = get_input('sender');
$user = get_input('user');
$secret = get_input('secret');
$data = get_input('data');

elggman_incoming_mail($sender, $user, $data, $secret);
