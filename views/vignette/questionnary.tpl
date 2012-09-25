<script type="text/javascript">
$(function() {
	$( ".check" ).button();
});
</script>

<?php
$questionnary = $d['questionnary']['questionnary'];
$questions = $d['questions'];

echo xView::load('vignette/identical/header', $questionnary);


printf('<h1>%s - %s</h1>',
	$questionnary['questionnary-traduct_title'],
	_('Bilan initial')
);
printf('<p id="question">%s</p>', $questions['questionParamedicalTest'][0]['question']['question-traduct_question']);
printf('<p id="remark">%s: %s</p>',
	_('Remarque'),
	$questions['questionParamedicalTest'][0]['question']['question-traduct_remark']
);


$group_paramedical = $questions['questionParamedicalTest'][0]['test'];
$question_picture = $questions['questionPictureTest'];
$modulo = 5;
?>
<form id="paramedicalTestQuestionnary" name="paramedicalTestQuestionnary" method="post">
	<input type="hidden" name="questionnary" value="questionnary" />
	<table>
		<?php
		$j=1;
		foreach($group_paramedical as $grp => $test){
			printf('<tr><th colspan="%s">%s</th></tr>', $modulo, $grp);
			$i=0;
			echo '<tr>';
			foreach($test as $t){
				if($i%$modulo == 0){ echo '</tr>'; echo '<tr>'; }
				printf('<td><input type="checkbox" name="paramedicalTests[%d]" value="%d" id="check%d" class="check" /><label for="check%d">%s</label></td>',
						$t['id'],
						$t['id'],
						$j,
						$j,
						$t['paramedical-test-traduct_name']
				);
				$j++;
				$i++;
			}
		}
		printf('<tr><th colspan="%s">%s</th></tr>', $modulo, _('Examens complémentaires'));
		foreach($question_picture as $question){
			foreach($question['test'] as $group){
				$i=0;
				echo '<tr>';
				foreach($group as $testname => $t){
					
					if($i%$modulo == 0){ echo '</tr>'; echo '<tr>'; }
					
					printf('<td><input type="checkbox" name="pictureTests[%s]" value="%s" id="check%d" class="check" /><label for="check%d">%s</label></td>',
							$t[$i]['question_id'],
							$t[$i]['question_id'],
							$j,
							$j,
							$testname
					);
					$j++;
					$i++;
				}
			}
		}
		?>
	</table>
	<?php
	printf('<button type="submit" class="btn btn-primary">%s</button>',
		_("Valider et passer à l'étape suivante")
	);
	?>
</form>
<?php
printf('<div id="anamneseRepeate">%s</div>', $questionnary['questionnary-traduct_description']);
printf('<h1>$d</h1>');
xUtil::pre($d);
?>