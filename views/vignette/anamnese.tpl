<?php
$questionnary = $d['questionnary']['questionnary'];


echo xView::load('vignette/identical/header', $questionnary);

printf('<h1>%s</h1>', $questionnary['questionnary-traduct_title']);
printf('<div>%s</div>', $questionnary['questionnary-traduct_description']);
printf('<button type="submit" class="btn btn-primary nextStage" onclick="document.location.href=\'%s\' ">%s</button>',
	xUtil::url('vignette/questionnary/'),
	_('Choix du bilan initial')
);
?>