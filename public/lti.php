<?php
session_start();
include_once('../lib/ims-blti/blti.php');
include_once('../lib/ims-blti/OAuth.php');
include_once('../lib/ims-blti/blti_util.php');

@$lti = new BLTI("lti", true);

if($lti->valid == 1)
	header('Location: http://localhost:8888/vignette/public/');
else
	header('Location: http://moodle2.unil.ch');