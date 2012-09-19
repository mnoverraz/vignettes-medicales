<script type="text/javascript">
	$(function(){
		$('#tabs').tabs();
	});

	var languages = <?php echo json_encode($d['chooseLang']);?>;
</script>

<div id="dialog"></div>
 
<form id="questionnary" name="questionnary" method="post" class="form-horizontal">
<legend>Création du formulaire</legend>
	<input type="hidden" name="question" />
	<!--div id="tabs"-->
		<!--ul-->
			<?php
			$i=1;
			foreach($d['chooseLang'] as $l){
				//printf('<li><a href="#tabs-%d">%s</a></li>',$i,strtoupper($l['common_abbr']));
				$i++;
			}
			?>
		<!--/ul-->
		<?php
		//$i=1;
		//foreach($d['chooseLang'] as $l){
			//printf('<div id="tabs-%d">',$i);
		?>
		<div id="question-1" class="questionContainer">
			<legend><?php echo _('Question')?> 1</legend>
			<div class="control-group">
				<label for="question-1" class="control-label">Question 1</label>
				<div class="controls">
					<input id="question-1" name="question-1" type="text" value="Quel est le bilan initial que vous désirez effectuer ?" />
				</div>
			</div>
			
			<div class="control-group">
				<label for="remark-1" class="control-label">Remarque</label>
				<div class="controls">
					<input id="remark-1" name="remark-1" type="text" value="Vous devez pouvoir motiver chaque examen que vous demandez ! A l'étape suivante vous aurez tous les résultats pertinents y.c. ceux que vous n'avez pas demandés, si jugés importants par le tuteur." />
				</div>
			</div>
			
			<div class="control-group">
				<label for="type-1" class="control-label">Type</label>
				<div class="controls">
					<select id="type-1" name="type-1" class="type">
						<option value="1">Test paramédical</option>
						<option value="2">Image</option>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<label for="mode-1" class="control-label">Mode</label>
				<div class="controls">
					<select id="mode-1" name="mode-1" class="type">
						<option value="1">QCM</option>
						<option value="2">Single</option>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<div class="controls">
					<button class="addAnswerTemplate btn btn-success" type="button">addAnswer</button>
				</div>
			</div>
			
			<button class="btn btn-danger" type="button" onclick="delQuestion(this)">delete question 1</button>
		</div>
		<hr />
		<button id="addbtnq1" class="btn btn-success" type="button" onclick="addQuestion(this)">addQuestion</button>
			<?php //echo '</div>'; ?>
		<?php
		//$i++;
		//}
		?>
	<!--/div-->
	<hr />
	<button type="submit" class="btn btn-primary">Etape 3</button>
	
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>