<?php
$questionnary = $d['questionnary']['questionnary'];
$questions = $d['questions'];
$answers = $d['answers'];

printf('<h1>%s</h1>', $questionnary['questionnary-traduct_title']);
printf('<p>%s</p>', $questionnary['questionnary-traduct_description']);
printf('<h2>%s</h2>', _("Bilan initial"));

$group_paramedical = $questions['questionParamedicalTest'][0]['test'];
$question_picture = $questions['questionPictureTest'];
$modulo = 5;
?>
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
						/*printf('<a class="fancybox" rel="group" href="../../upload/%s"><img src="../../upload/%s" alt="%s" title="%s" /></a>',
							$t['image_url'],
							$t['image_url'],
							$t['ans-picture-traduct_comment'],
							$t['ans-picture-traduct_comment']
						);*/
						printf('<p>%s</p><hr />', $t['ans-picture-traduct_comment']);
						
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
	printf('<h2>%s</h2>', _('Evolution clinique'));
	printf('<p>%s</p>', $questionnary['questionnary-traduct_conclusion']);
	printf('<button type="button" onclick="document.location.href=\'/vignette/public/pdf/printFeedback\'" class="btn btn-primary">%s</button>',
	_("Passer à l'étape suivante")
	);
	?>