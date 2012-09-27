<?php
class StatsController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){	
	}
	
	
	function statsAction(){
		$d['questionnary'] = $_SESSION['questionnary'];
		$questionnary_id = $d['questionnary']['questionnary']['questionnary']['id'];
		
		//sum of all students who effectuated the vignette.
		$nbrUserModelparams = array(
				'questionnary_id' => $questionnary_id
		);
		$nbrUserModel = xModel::load('user-questionnary', $nbrUserModelparams)->get();
		
		$questionParamedicalId = &$d['questionnary']['questions']['questionParamedicalTest'][0]['question']['id'];
		$paramedicalGroups = &$d['questionnary']['questions']['questionParamedicalTest'][0]['test'];
		
		
		//PARAMEDICAL TESTS
		foreach($paramedicalGroups as &$tests){
			foreach($tests as &$test){
				$test['statsNbrChecked'] = $this->getHit($questionParamedicalId, 1,$test['id']);
			}
		}
		
		
		$questionPictureTests = &$d['questionnary']['questions']['questionPictureTest'];
		//PICTURE TESTS
		foreach($questionPictureTests as &$question){
			foreach($question['test'] as &$group){
				
				foreach($group as &$tests){
					$d['d'] = $test;
					
					foreach($tests as &$t){
						$t['statsNbrChecked'] = 1;
					}
				}
			}
		}
		
		
		
		
		$d['infoStats']['nbrUser'] = count($nbrUserModel);
		
		return xView::load('stats/stats', $d)->render();
	}
	
	function loadingAction(){
		xController::load('vignette')->loading($this->params['id']);
		xUtil::redirect(xUtil::url('stats/stats'));
	}
	
	/*
	 * Get nbr of hits for one test
	 * 
	 * @param int $question_id
	 * @param int $question_type
	 * @param int $answer_type_id
	 * @return String return the number of checked for the question
	 */
	function getHit($question_id, $question_type, $answer_type_id){
		$params = array(
				'question_id' => $question_id,
				'question_type' => $question_type,
				'answer_type_id' => $answer_type_id,
		);
		return count(xModel::load('Answer', $params)->get());
	}
	
}