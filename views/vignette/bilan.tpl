<?php
$questionnary = $d['questionnary']['questionnary'];
$questions = $d['questions'];
$answers = $d['answers'];

echo xView::load('vignette/identical/header', $questionnary);
printf('<p>%s - %s</p>',
	$questionnary['questionnary-traduct_title'],
	_("Résultats du bilan initial")
);


$group_paramedical = $questions['questionParamedicalTest'][0]['test'];
$question_picture = $questions['questionPictureTest'];
$modulo = 5;
?>
<form id="BilanQuestionnary" name="BilanQuestionnary" method="post">
	<input type="hidden" name="bilan" value="bilan" />
	<table>
		<thead>
			<tr class="noFormat"><th>Examen</th><th>Patient</th><th>Valeurs normales</th><th>Votre demande</th></tr>
		</thead>
		<?php
		$j=1;
		foreach($group_paramedical as $grp => $test){
			printf('<tr><th colspan="%s">%s</th></tr>', $modulo, $grp);
			$i=0;
			
			foreach($test as $t){
				echo '<tr>';
				//if($t['ans-paramedical-test_checked']) $checked='checked="x'; else $checked='';
	
				$checked = '';
				foreach($answers['paramedicalTests'] as $index => $val){
					if($val == $t['id']) $checked='x';
				}
				printf('<td>%s</td><td>%s</td><td>%s</td><td>%s</td>',
					$t['paramedical-test-traduct_name'],
					$t['ans-paramedical-test_patient_values'],
					$t['normal_values'],
					$checked
				);
				echo '</tr>';
				$j++;
				$i++;
			}
		}
		printf('<tr><th colspan="%s">%s</th></tr>', $modulo, _('Examens complémentaires'));
		foreach($question_picture as $question){
			foreach($question['test'] as $group){
				$i=0;
				foreach($group as $testname => $test){
					printf('<tr>');
					printf('<td>%s</td>',$testname);
					printf('<td colspan="2">');
					printf('<p id="pictureTestQuestion">%s</p>', $question['question']['question-traduct_question']);
					foreach($test as $t){
						printf('<div class="pictureAnswer"><a class="fancybox reduce" rel="group" href="../../upload/%s"><img src="../../upload/%s" alt="%s" width="200" title="%s" /></a>',
							$t['image_url'],
							$t['image_url'],
							$t['ans-picture-traduct_comment'],
							$t['ans-picture-traduct_comment']
						);
						printf('<p>%s</p>', $t['ans-picture-traduct_comment']);
						printf('<input type="radio" name="PictureTest[%d]" value="%d" /></div>', $t['question_id'], $t['id']);
						
						$checked = '';
						foreach($answers['pictureTests'] as $index => $val){
							if($val == $t['question_id']) $checked='x';
						}
					}
					printf('<td>%s</td>', $checked);
					printf('</td>');
					printf('</tr>');
					
					$j++;
					$i++;
				}
			}
		}
		?>
	</table>
	<?php
	printf('<button type="submit" class="btn btn-primary">%s</button>',
		_("Valider votre questionnaire et passer à l'étape suivante")
	);
	?>
</form>
<h1>$d</h1>
<?php
xUtil::pre($d);
?>