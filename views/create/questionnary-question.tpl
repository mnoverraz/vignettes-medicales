<script type="text/javascript">
	$(function(){
		$('#tabs').tabs();
	});
</script>

<div id="dialog"></div>
 
<form id="questionnary" name="questionnary" method="post">
	<input type="hidden" name="question" />
	<div id="tabs">
		<ul>
			<?php
			$i=1;
			foreach($d['chooseLang'] as $l){
				printf('<li><a href="#tabs-%d">%s</a></li>',$i,strtoupper($l['common_abbr']));
				$i++;
			}
			?>
		</ul>
		
		
		<div id="stylized" class="myform">
			<?php
			$i=1;
			foreach($d['chooseLang'] as $l){
				printf('<div id="tabs-%d">',$i);
					printf('<h1>%s</h1>',_("Création du questionnaire"));
					printf('<p>%s</p>',_("Créer votre formulaire"));
			?>
			<fieldset><legend>Question 1</legend>
				<label for="question-1">Question 1<span class="small">Question 1</span></label>
				<input id="question-1" name="question-1" type="text" value="Quel est le bilan initial que vous désirez effectuer ?" />
				
				<label for="remark-1">Remarque<span class="small">Remarque</span></label>
				<input id="remark-1" name="remark-1" type="text" value="Vous devez pouvoir motiver chaque examen que vous demandez ! A l'étape suivante vous aurez tous les résultats pertinents y.c. ceux que vous n'avez pas demandés, si jugés importants par le tuteur." />
				
				<label for="type-1">Type<span class="small">Type</span></label>
				<select id="type-1" name="type-1" class="type">
					<option value="1">Test paramédical</option>
					<option value="2">Image</option>
					<option value="3">Texte</option>
				</select>
				
				<label for="mode-1">Mode<span class="small">Mode</span></label>
				<select id="mode-1" name="mode-1" class="mode">
					<option value="1">QCM</option>
					<option value="2">Single</option>
				</select>
				<button class="addAnswerTemplate" type="button">addAnswer</button>
				
				
			</fieldset>
			
		</div>
		
		<?php
		$i++;
		}
		?>
		
		
		<button type="submit">Etape 3</button>
	</div>
</form>

<h1>$d</h1>
<?php
xUtil::pre($d);
?>