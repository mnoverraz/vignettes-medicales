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
			
				foreach($d['model'] as $q){
					if($q['limit_date'] == ''){
						$q['limit_date'] = _("noLimitDate");
					}
					echo '<tr>';
						printf('<td>%s - %s</td><td><a href="%s">%s</a></td><td><a href="mailto:%s">%s %s</a></td><td>%s</td>',
								$q['module'],
								$q['theme'],
								xUtil::url('vignette/loading/'.$q['questionnary_id']),
								$q['title'],
								$q['email'],
								$q['firstname'],
								$q['lastname'],
								/*date('d.m.Y',strtotime(*/$q['limit_date']//))
						);
					echo '</tr>';
				}
			
		
		?>
	</tbody>
</table>
<?php
/*echo '<h1>$d</h1>';
xUtil::pre($d);
echo '<h1>SESSION</h1>';
xUtil::pre($_SESSION);*/
?>