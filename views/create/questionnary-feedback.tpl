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
	<button type="submit" class="btn btn-primary">Etape 3</button>
	
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>