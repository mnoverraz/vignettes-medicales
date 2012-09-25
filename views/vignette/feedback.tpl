<?php
$questionnary = $d['questionnary'];


echo xView::load('vignette/identical/header', $questionnary);
printf('<p>%s - %s</p>',
	$questionnary['questionnary-traduct_title'],
	_("Feedback")
);
printf('<p>%s</p>', $questionnary['questionnary-traduct_conclusion']);

printf('<button type="button" onclick="document.location.href=\'feedbackHTML\'" class="btn btn-primary">%s</button>',
_("Passer à l'étape suivante")
);

printf('$d');
xUtil::pre(xAuth::info());

?>