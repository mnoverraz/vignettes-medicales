<div id="stylized" class="myform">
<form id="questionnary" name="questionnary" method="post">
<h1><?php echo _("Création du questionnaire") ?></h1>
<p><?php echo _("Créer votre formulaire") ?></p>

<fieldset>
<legend><?php echo _('Langues des questionnaires');?></legend>
<p>Attention: si vous</p>
<?php
foreach($d['availableLanguages'] as $l){
	printf('<label for="lang%s">%s<span class="small"></span></label>',$l['common_abbr'],$l['common_abbr']);
	printf('<input id="lang%s" name="lang[]" value="%s" type="checkbox" />', $l['common_abbr'], $l['id']);
}
?>
</fieldset>
<fieldset>
<legend><?php echo _('Module');?></legend>
<p>Indiquez dans quel module fait partie votre questionnaire</p>
<?php
$i=1;
foreach($d['formValues']['modules'] as $m){
?>
<div id="containerModule-<?php echo $i ?>" style="margin-bottom:4px;" class="clonedElt">
	<label for="module-<?php echo $i ?>">
		<?php echo _("Module"); ?>
		<span class="small">test</span>
	</label>
	<select id="module-<?php echo $i ?>" name="module-<?php echo $i ?>">
		<?php
		foreach($d['modules'] as $module){

			if($m == $module['id'])
				$toto = 'selected="'.$module['id'].'"';
			else
				$toto = '';
			
			printf('<option value="%s" %s>%s</option>',
					$module['id'],
					$toto,
					$module['module']
			);
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

<label for="title">
	<?php echo _("Titre"); ?>
	<span class="small">Titre du formulaire lorsque</span>
</label><input id="title" name="title" type="text" <?php printf('value="%s"', $d['formValues']['title']) ?> />

<label for="theme">
	<?php echo _("Thème"); ?>
	<span class="small">test</span>
</label><input id="theme" name="theme" type="text" <?php printf('value="%s"', $d['formValues']['theme']) ?> />

<label for="description">
	<?php echo _("Description du cas"); ?>
	<span class="small">test</span>
</label>
<div class="test"><textarea id="description" name="description"><?php echo $d['formValues']['description'] ?></textarea></div>

<button type="submit">Etape 2</button>
<div class="spacer"></div>

</form>
</div>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>