<?php
$questionnary = $d['questionnary']['questionnary'];


echo xView::load('vignette/identical/header', $questionnary);
printf('<h1>%s - %s</h1>',
	$questionnary['questionnary-traduct_title'],
	_("Feedback")
);
printf('<p>%s</p>', $questionnary['questionnary-traduct_conclusion']);

printf('<button type="button" onclick="document.location.href=\'feedbackHTML\'" class="btn btn-primary nextStage">%s</button>',
_("Passer à l'étape suivante")
);

?>