<?php
	printf('<p class="vignetteHeader">%s - %s : %s %s / %s : %s</p>',
		$d['questionnary-traduct_theme'],
		_('Auteur'),
		$d['user_firstname'],
		$d['user_lastname'],
		_('Date'),
		date('d.m.Y',strtotime($d['creation_date']))
		
	);
?>