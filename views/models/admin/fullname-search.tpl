<?php
printf("WHERE concat(firstname, ' ' , lastname) LIKE '%%%s%%';",
	$d['model']->params['search']
);
?>