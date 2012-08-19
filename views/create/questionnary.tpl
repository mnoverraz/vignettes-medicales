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
<legend>tiotire</legend>
		
<div id="elt-1" style="margin-bottom:4px;" class="clonedElt">
<label for="module-1">
	<?php echo _("Module"); ?>
	<span class="small">test</span>
</label><select id="module-1" name="module-1">
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

 
    <div>
        <button id="btnAdd" type="button">Ajouter module</button>
        <button id="btnDel" type="button">Supprimer module</button>
    </div>
</fieldset>
<button type="submit">Créer</button>
<div class="spacer"></div>

</form>
</div>