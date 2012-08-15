<table>
	<caption><?php echo _("Liste des vignettes médicales"); ?></caption>
	<thead>
		<tr>
			<th><?php echo _("Module"); ?></th>
			<th><?php echo _("Titre"); ?></th>
			<th><?php echo _("Auteur"); ?></th>
			<th><?php echo _("Faire d'ici le"); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			
				foreach($d as $q){
					echo '<tr>';
						printf('<td>%s - %s</td><td>%s</td><td><a href="mailto:%s">%s %s</a></td><td>%s</td>',
								$q['module'],
								$q['theme'],
								$q['title'],
								$q['email'],
								$q['firstname'],
								$q['lastname'],
								date('d m y',$q['limit_date'])
						);
					echo '</tr>';
				}
			
		
		?>
		<tr>
			<td>...</td>
			<td>...</td>
			<td>...</td>
			<td>...</td>
		</tr>
		<tr>
			<td>...</td>
			<td>...</td>
			<td>...</td>
			<td>...</td>
		</tr>
		<tr>
			<td>...</td>
			<td>...</td>
			<td>...</td>
			<td>...</td>
		</tr>
		<tr>
			<td>...</td>
			<td>...</td>
			<td>...</td>
			<td>...</td>
		</tr>
		<tr>
			<td>...</td>
			<td>...</td>
			<td>...</td>
			<td>...</td>
		</tr>
	</tbody>
</table>



<?php
echo '<h1>$d</h1>';
xUtil::pre($d);
echo '<h1>xContext</h1>';
xUtil::pre(xContext::dump());
?>