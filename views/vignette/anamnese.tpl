<?php
$questionnary = $d['questionnary']['questionnary'];


echo xView::load('vignette/identical/header', $questionnary);

printf('<h1>%s</h1>', $questionnary['questionnary-traduct_title']);
printf('<p>%s</p>', $questionnary['questionnary-traduct_description']);
printf('<button type="submit" class="btn btn-primary" onclick="document.location.href=\'%s\' ">%s</button>',
	xUtil::url('vignette/questionnary/'),
	_('Choix du bilan initial')
);

printf('<h1>$d</h1>');
xUtil::pre($d);
?>