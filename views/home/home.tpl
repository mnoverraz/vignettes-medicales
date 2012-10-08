<?php
if(xContext::$auth->is_role('Instructor') || xContext::$auth->is_role('Administrator')){
	$granted = true;
	$tableCols = 5;
}else{
	$granted = false;
	$tableCols = 4;
}
?>

<h1><?php echo _("Liste des vignettes médicales"); ?></h1>
<table>
	<thead>
		<tr>
			<th><?php echo _("Module"); ?></th>
			<th><?php echo _("Titre"); ?></th>
			<th><?php echo _("Auteur"); ?></th>
			<th><?php echo _("Faire d'ici le"); ?></th>
			<?php
				if($granted) echo '<th>'._("Option").'</th>';
			?>
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
						
						$isOwner = xController::load('vignette')->isOwner($q['questionnary_id'], xContext::$auth->info('id'));
						$isAdmin = xContext::$auth->is_role('Administrator');
						if($isAdmin || $isOwner){
							printf('<td><button type="submit" class="btn btn-primary" onclick="document.location.href=\'%s\'">%s</button> <button type="submit" class="btn btn-danger" onclick="document.location.href=\'%s\'">%s</button></td>',
								xUtil::url('stats/loading/'.$q['questionnary_id']),
								_("Statistiques"),
								xUtil::url('vignette/delete/'.$q['questionnary_id']),
								_("Supprimer")
							);
						}
					echo '</tr>';
				}
			
		
		?>
	</tbody>
</table>
<?php
echo '<h1>$d</h1>';
xUtil::pre($d);
echo '<h1>xAuth</h1>';
xUtil::pre(xContext::$auth->is_role('Instructor,sdfdsf'));
echo '<h1>SESSION</h1>';
xUtil::pre($_SESSION);
?>