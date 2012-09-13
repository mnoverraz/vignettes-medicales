<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<form id="questionnary" name="questionnary" method="post" class="form-horizontal">
<legend><?php echo _('Paramètres du questionnaire');?></legend>
<?php

echo '<div class="control-group">';
printf('<label class="control-label">%s</label>',
			_('Langues'),
			ucfirst($l['common_abbr'])
);
echo '<div class="controls">';

$i=0;
foreach($d['availableLanguages'] as $l){
	printf('<label class="checkbox inline"><input id="lang%s" name="lang[]" value="%s" type="checkbox" %s />%s</label>',
				$l['common_abbr'],
				$l['id'],
				$d['formValues']['languages'][$i],
				ucfirst($l['common_abbr'])
	);
	
	
	
	$i++;
}
echo '</div></div>';
?>

<?php

$i=0;
if(isset($d['formValues']['modules']))
	$nbrModules=$d['formValues']['modules'];
else
	$nbrModules = array(1);
foreach($nbrModules as $m){
?>
<div id="containerModule-<?php echo $i+1 ?>" class="control-group clonedElt" maxElt="<?php echo count($d['modules']) ?>">
	<label for="module-<?php echo $i+1 ?>" class="control-label">
		<?php
		echo _("form.module"); 
		?>
	</label>
	<div class="controls">
		<select id="module-<?php echo $i+1 ?>" name="module-<?php echo $i+1 ?>">
			<?php
			$j=0;
			foreach($d['modules'] as $module){
				printf('<option value="%s" %s>%s</option>',
						$module['id'],
						$d['formValues']['modules'][$i][$j],
						$module['module']
				);
				$j++;
			}
			?>
		</select>
	</div>
</div>
<?php
$i++;
}
?>
<div class="addElement control-group">
	<div class="controls">
		<button class="btnAdd btn btn-success" type="button">Ajouter module</button>
		<button class="btnDel btn btn-danger" type="button" disabled="disabled">Supprimer module</button>
	</div>
</div>
<hr />
<button class="btn btn-primary" type="submit">Etape 2</button>

</form>
<h1>$d</h1>
<?php
xUtil::pre($d);
?>