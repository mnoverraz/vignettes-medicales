<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<div id="stylized" class="myform">
<form id="questionnary" name="questionnary" method="post">
<h1><?php echo _("Création du questionnaire") ?></h1>
<p><?php echo _("Créer votre formulaire") ?></p>

<fieldset>
<legend><?php echo _('Langues des questionnaires');?></legend>
<p>Attention: si vous</p>
<?php
$i=0;
foreach($d['availableLanguages'] as $l){
	printf('<label for="lang%s">%s<span class="small">%s</span></label>',$l['common_abbr'],ucfirst($l['common_abbr']),_('form.help.langue'));
	printf('<input id="lang%s" name="lang[]" value="%s" type="checkbox" %s />',
				$l['common_abbr'],
				$l['id'],
				$d['formValues']['languages'][$i]
	);
	$i++;
}
?>
</fieldset>
<fieldset>
<legend><?php echo _('form.module');?></legend>
<p>Indiquez dans quel module fait partie votre questionnaire</p>
<?php
$i=0;
if(isset($d['formValues']['modules']))
	$nbrModules=$d['formValues']['modules'];
else
	$nbrModules = array();
foreach($nbrModules as $m){
?>
<div id="containerModule-<?php echo $i+1 ?>" style="margin-bottom:4px;" class="clonedElt">
	<label for="module-<?php echo $i+1 ?>">
		<?php
		echo _("form.module"); 
		printf('<span class="small">%s</span>',_('form.help.module'));
		?>
	</label>
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
<?php
$i++;
}
?>
<div class="addElement" maxElt="2" minElt="1">
	<button class="btnAdd" type="button">Ajouter module</button>
	<button class="btnDel" type="button">Supprimer module</button>
</div>
</fieldset>

<button type="submit">Etape 2</button>
<div class="spacer"></div>

</form>
</div>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>