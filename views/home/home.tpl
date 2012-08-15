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
	<tfoot>
		<tr>
			<td colspan="4"><?php echo _("Cliquez sur un titre pour effectuer la vignette."); ?></td>
		</tr>
	</tfoot>
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
								date('d.m.Y',strtotime($q['limit_date']))
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
xUtil::pre(xContext::dump());
?>