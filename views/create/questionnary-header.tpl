 <script type="text/javascript">
$(function(){
$('#tabs').tabs();
});
</script>
 
 
 
<form id="questionnary" name="questionnary" method="post">
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Français</a></li>
			<li><a href="#tabs-2">Anglais</a></li>
		</ul>
		
		
		<div id="stylized" class="myform">
			<div id="tabs-1">
				
					<h1><?php echo _("Création du questionnaire") ?></h1>
					<p><?php echo _("Créer votre formulaire") ?></p>
					<label for="title">
						<?php echo _("TitreFR"); ?>
						<span class="small">Titre du formulaire lorsque</span>
					</label>
					<input id="title" name="title" type="text" <?php printf('value="%s"', $d['formValues']['title']) ?> />
				
					<label for="theme">
						<?php echo _("Thème"); ?>
						<span class="small">test</span>
					</label><input id="theme" name="theme" type="text" <?php printf('value="%s"', $d['formValues']['theme']) ?> />
					
					<label for="description">
						<?php echo _("Description du cas"); ?>
						<span class="small">test</span>
					</label>
					<div class="test">
						<textarea id="description" name="description"><?php echo $d['formValues']['description'] ?></textarea>
					</div>
					
				
			</div>
			
			<div id="tabs-2">
				
					<h1><?php echo _("Création du questionnaire") ?></h1>
					<p><?php echo _("Créer votre formulaire") ?></p>
					<label for="title">
						<?php echo _("TitreEN"); ?>
						<span class="small">Titre du formulaire lorsque</span>
					</label>
					<input id="title" name="title" type="text" <?php printf('value="%s"', $d['formValues']['title']) ?> />
				
					<label for="theme">
						<?php echo _("Thème"); ?>
						<span class="small">test</span>
					</label><input id="theme" name="theme" type="text" <?php printf('value="%s"', $d['formValues']['theme']) ?> />
					
					<label for="description">
						<?php echo _("Description du cas"); ?>
						<span class="small">test</span>
					</label>
					<div class="test">
						<textarea id="description" name="description"><?php echo $d['formValues']['description'] ?></textarea>
					</div>
					
				
			</div>
			<button type="submit">Etape 2</button>
		</div>
	</div>
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>