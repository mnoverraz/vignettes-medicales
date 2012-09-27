<form id="questionnary" name="questionnary" method="post" class="form-horizontal">
	<input type="hidden" name="feedback" value="posted" />
	<legend><?php echo _('Création du feedback')?></legend>
		<?php
		foreach($d['chooseLang'] as $l){
		?>
		<div class="control-group">
			<label for="feedback[<?php echo $l['common_abbr'] ?>]" class="control-label">Feedback <?php echo ucfirst($l['common_abbr']) ?></label>
			<div class="controls">
				<textarea id="feedback[<?php echo $l['common_abbr'] ?>]" name="feedback[<?php echo ucfirst($l['common_abbr']) ?>]"></textarea>
			</div>
		</div>
		<?php
		}
		?>
	<hr />
	<?php printf('<button class="btn btn-inverse" type="button" onclick="document.location.href=\'%s\'">%s</button>', xUtil::url('questionnary/settings/'), _("btn.retour"));?>
	<button type="submit" class="btn btn-primary"><?php echo _("btn.valider&envoyer")?></button>
	
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>