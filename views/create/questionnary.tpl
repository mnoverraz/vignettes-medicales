<!-- form name="questionnary">
	<div id="formTitle">Création du questionnaire</div>
	<div id="formBody">
		<fieldset id="coordonnees">
			<legend>Coordonnées</legend>
			<br />
			<p>
				<label for="title"><?php echo _("Titre"); ?></label><input name="title" type="text" />
		
			</p>
			<p>
				<label for="theme"><?php echo _("Thème"); ?></label><input name="theme" type="text" />
			</p>
			<p>
				<label for="description"><?php echo _("Description"); ?></label><textarea name="description"></textarea>
			</p>
			
			<p>
				<label for="limit_date"><?php echo _("Date limite"); ?></label><input name="limit_date" type="text" />
			</p>
			
			<p>
				Pays :
				<select id="pays">
					<option value="france" selected="selected">France</option>
					<option value="allemagne">Allemagne</option>
					<option value="etatsunis">&Eacute;tats-Unis</option>
					<option value="canada">Canada</option>
					<option value="japon">Japon</option>
					<option value="chine">Chine</option>
				</select>
			</p>
			<p>
				Date de naissance : <input type="text" name="dateNaissance" id="dateNaissance" />
			</p>
		</fieldset>
		<br />
		<fieldset id="periodicite">
			<legend>Options</legend>
			<p>
				<input type="radio" name="periode" id="periodeH" value="hebdo" checked="checked" /> Newsletter hebdomadaire<br />
				<input type="radio" name="periode" id="periodeM" value="mens" /> Newsletter mensuelle<br />
				<input type="radio" name="periode" id="periodeT" value="trim" /> Newsletter trimestrielle
			</p>
		</fieldset>
	</div>
	<div id="formFooter">
		<input type="reset" name="reset" id="reset" value="Annuler" />
		<input type="submit" name="valid" id="valid" value="Valider" />
	</div>
</form-->

<div id="stylized" class="myform">
<form id="form" name="form" method="post" action="index.html">
<h1>Création du questionnaire</h1>
<p>Créer votre formulaire</p>


<label for="title">
	<?php echo _("Titre"); ?>
	<span class="small">test</span>
</label><input name="title" type="text" />

<label>Name
<span class="small">Add your name</span>
</label>
<input type="text" name="name" id="name" />

<label>Email
<span class="small">Add a valid address</span>
</label>
<input type="text" name="email" id="email" />

<label>Password
<span class="small">Min. size 6 chars</span>
</label>
<input type="text" name="password" id="password" />

<button type="submit">Sign-up</button>
<div class="spacer"></div>

</form>
</div>