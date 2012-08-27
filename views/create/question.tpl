<div id="stylized" class="myform">
<form id="questions" name="questions" method="post">
<h1><?php echo _("Création des questions") ?></h1>
<p><?php echo _("Créer vos questions") ?></p>


<label for="question-1">
	<?php echo _("Question"); ?>
	<span class="small">Question</span>
</label><input id="question-1" name="question-1" type="text" />

<label for="questionType-1">
	<?php echo _("Question type"); ?>
	<span class="small">Question type</span>
</label>
<select id="questionType-1" name="questionType1">
	<option value="1">qcm</option>
	<option value="2">single choice</option>
</select>


<button type="submit">Etape 3</button>
<div class="spacer"></div>

</form>
</div>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>