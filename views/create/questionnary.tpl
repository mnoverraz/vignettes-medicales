<div id="stylized" class="myform">
<form id="form" name="form" method="post" action="index.html">
<h1>Création du questionnaire</h1>
<p>Créer votre formulaire</p>


<label for="title">
	<?php echo _("Titre"); ?>
	<span class="small">test</span>
</label><input id="title" name="title" type="text" />

<label for="theme">
	<?php echo _("Thème"); ?>
	<span class="small">test</span>
</label><input id="theme" name="theme" type="text"/>

<label for="description">
	<?php echo _("Description du cas"); ?>
	<span class="small">test</span>
</label>
<div class="test"><textarea id="description" name="description">ds</textarea></div>
<fieldset>
<legend><?php echo _('Module');?></legend>
		
<div id="containerModule-1" style="margin-bottom:4px;" class="clonedElt">
	<label for="moduleFr-1">
		<?php echo _("Module FR"); ?>
		<span class="small">test</span>
	</label>
	<select id="moduleFr-1" name="moduleFr-1">
		<?php
		foreach($d as $module){
			printf('<option value="%s">%s</option>',
					$module['id'],
					$module['module']
			);
		}
		?>
	</select>
	<label for="moduleEn-1">
		<?php echo _("Module EN"); ?>
		<span class="small">test</span>
	</label>
	<select id="moduleEn-1" name="moduleEn-1">
		<?php
		foreach($d as $module){
			printf('<option value="%s">%s</option>',
					$module['id'],
					$module['module']
			);
		}
		?>
	</select>
</div>
<div class="addElement">
	<button class="btnAdd" type="button">Ajouter module</button>
	<button class="btnDel" type="button">Supprimer module</button>
</div>

<div id="theme-1" style="margin-bottom:4px;" class="clonedElt">
	<label for="theme-1">
		<?php echo _("Thème"); ?>
		<span class="small">test</span>
	</label>
	<input id="theme-1" name="theme-1" type="text"/>
</div>
    <div>
        <button class="btnAdd" type="button">Ajouter module</button>
        <button class="btnDel" type="button">Supprimer module</button>
    </div>
</fieldset>
<button type="submit">Créer</button>
<div class="spacer"></div>

</form>
</div>