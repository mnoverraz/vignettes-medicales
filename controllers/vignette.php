<?php
class VignetteController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}
	
	/**
	 * Load a vignette in session
	 */
	function indexAction(){
		if(isset($_SESSION['vignette'])){
			if($_SESSION['vignette']['questionnary']['id'] != $questionnary_id){
				unset($_SESSION['vignette']);
				$this->loading($questionnary_id);
			}
		}else{
			$this->loading($questionnary_id);
		}
		
		xUtil::redirect(xUtil::url('vignette/anamnese/'));
	}
	
	/**
	 * Get anamnese view
	 * @return xView Anamnese view
	 */
	function anamneseAction(){
	
		$d = $_SESSION['questionnary'];
		return xView::load('vignette/anamnese', $d)->render();
	}
	
	/**
	 * Get questionnary View
	 * @return xView questionnary view
	 */
	function questionnaryAction(){

		//Setting in session
		if(isset($this->params['paramedicalTests']) || isset($this->params['pictureTests'])){			
			$_SESSION['questionnary']['answers']['paramedicalTests'] = $this->params['paramedicalTests'];
			$_SESSION['questionnary']['answers']['pictureTests'] = $this->params['pictureTests'];
			xUtil::redirect(xUtil::url('vignette/bilan/'));
		}
		
		$d = $_SESSION['questionnary'];
		
		//Setting in session
		if(isset($this->params['paramedicalTests']) || isset($this->params['pictureTests'])){
			$_SESSION['questionnary']['answers']['paramedicalTests'] = $this->params['paramedicalTests'];
			$_SESSION['questionnary']['answers']['pictureTests'] = $this->params['pictureTests'];
			xUtil::redirect(xUtil::url('vignette/bilan'));
		}
		
		return xView::load('vignette/questionnary', $d)->render();
	}
	
	/**
	 * Get the bilan view
	 * @return xView the bilan view
	 */
	function bilanAction(){
		
		//Setting in session
		if(isset($this->params['bilan'])){
			$_SESSION['questionnary']['answers']['pictureTests']['answers'] = $this->params['PictureTest'];
			$alredyFill = xController::load('userQuestionnary')->alreadyFillQuestionnary($_SESSION['questionnary']['questionnary']['questionnary']['id']);
			if($alredyFill == 0){
				$this->saveAnswers($_SESSION['questionnary']['answers']);
			}
			xUtil::redirect(xUtil::url('vignette/feedback'));
		}
		
		$d = $_SESSION['questionnary'];
		return xView::load('vignette/bilan', $d)->render();
	}
	
	/**
	 * Get the feedback view
	 * @return xView the feedback view
	 */
	function feedbackAction(){
		$d = $_SESSION['questionnary'];
	
		return xView::load('vignette/feedback', $d)->render();
	}
	/**
	 * Get the feedback HTML for pdf generation
	 * @return xView the feedback HTML view
	 */
	function feedbackHTMLAction(){
		$d = $_SESSION['questionnary'];
	
		return xView::load('vignette/feedbackHTML', $d)->render();
	}
	
	/**
	 * Action to load a vignette in session
	 */
	function loadingAction(){
		$this->loading($this->params['id']);
		xUtil::redirect(xUtil::url('vignette/anamnese'));
	}
	
	/**
	 * Load a vignette in session
	 * @param integer $questionnary_id
	 * @throws xException
	 * 
	 */
	function loading($questionnary_id){
		//QUESTIONNARY
		$model['questionnary'] = xController::load('questionnary')->getQuestionnary($questionnary_id);
		$d['questionnary']['questionnary'] = $model['questionnary'][0];
		
		if(count($model['questionnary']) > 0){
			//QUESTIONNARY-MODULES
			$d['questionnary']['questionnary']['module'] = xController::load('module')->getModulesFromQuestionnary($questionnary_id);
			
			
			$model['questions'] = xController::load('question')->getQuestionsFromQuestionnary($questionnary_id);
			foreach($model['questions'] as $q){
				//QUESTIONS
				switch($q['question_type']) //choose which database table/model to choose
				{
					case 1: $questionType='ParamedicalTest';$answerController='paramedicalTest';break;
					case 2: $questionType='PictureTest';$answerController='pictureTest';break;
					default: throw new xException(_("exception-vignette-QuestionTypedoesntExist"), 412);break;
				}
				$d['questions']['question'.$questionType][]['question'] = $q;
				
				//TEST
				$model['test'] = xController::load($answerController)->getTestsFromQuestion($q['id']);
				foreach($model['test'] as $test){
					$questionIndexElement = end(array_keys($d['questions']['question'.$questionType]));//need to fill test in the correct question array index
					$group = $test['group-traduct_name'];
					switch($questionType){
						case 'ParamedicalTest':
							$d['questions']['question'.$questionType][$questionIndexElement]['test'][$group][] = $test;
							break;
						case 'PictureTest':
							$testname = $test['ans-picture-traduct_testname'];
							$d['questions']['question'.$questionType][$questionIndexElement]['test'][$group][$testname][] = $test;
							break;
						default:throw new xException(_("exception-vignette-QuestionTypedoesntExist"), 412);break;
					}
					
				}
			}
			
			
				
		}else{
			throw new xException(_("exception-vignette-doesntExist"), 412);
		}
		$_SESSION['questionnary'] = $d;
	}
	
	/**
	 * Save answers of a vignette in DB (if it's the first time)
	 * @param array $answers
	 * @throws xException
	 */
	function saveAnswers($answers){
		$questionnary_id = $_SESSION['questionnary']['questionnary']['questionnary']['id'];
		$question_paramedical_id = $_SESSION['questionnary']['questions']['questionParamedicalTest'][0]['question']['id'];
		$answers = $_SESSION['questionnary']['answers'];
		try{
			$t = new xTransaction();
			$t->start();
			
			// FILL QUESTIONNARY
			$fillQuestionnary_data['user_id'] = xAuth::info('id');
			$fillQuestionnary_data['questionnary_id'] = $questionnary_id;
			$fillQuestionnary = xModel::load('user-questionnary', $fillQuestionnary_data);
			$t->execute($fillQuestionnary, 'put');
			
			// PARAMEDICAL TESTS
			foreach($answers['paramedicalTests'] as $question_id => $pmt){
				$answer_paramedical_test_data['question_type'] = 1;
				$answer_paramedical_test_data['answer_type_id'] = $pmt;
				$answer_paramedical_test_data['question_id'] = $question_paramedical_id;
				$answer_paramedical_test_data['user_id'] = xAuth::info('id');
				
				$answer_paramedical_test = xModel::load('answer', $answer_paramedical_test_data);
				$t->execute($answer_paramedical_test, 'put');
			}
	
			// PICTURE TESTS
			foreach($answers['pictureTests']['answers'] as $question_id => $pmt){
				$answer_picture_test_data['question_type'] = 1;
				$answer_picture_test_data['answer_type_id'] = $pmt;
				$answer_picture_test_data['question_id'] = $question_id;
				$answer_picture_test_data['user_id'] = xAuth::info('id');
					
				$answer_picture_test = xModel::load('answer', $answer_picture_test_data);
				$t->execute($answer_picture_test, 'put');
			}
	
			$t->end();
		}catch (xException $e) {
			throw new xException(_("exception-db-transactionProblem"), 401);
		}
	}
	
	/**
	 * Delete a vignette
	 * @throws xException
	 */
	function deleteAction(){
		if(xContext::$auth->is_role('Instructor')){
			$questionnary_id = $this->params['id'];
			if(isset($questionnary_id)){
				$t = new xTransaction();
				$t->start();
					$t->execute(xModel::load('questionnary', array('id' => $questionnary_id)), 'delete');
				$t->end();
				$d=$t;
				xUtil::redirect(xUtil::url('home'));
			}else{
				throw new xException(_('delete.vignette.noId'));
			}
		}else{
			throw new xException(_('delete.vignette.authorization'));
		}
	}
	
	/**
	 * Get if the user is owner of the vignette
	 * @param integer $questionnary_id
	 * @param integer $user_id
	 * @return boolean
	 */
	function isOwner($questionnary_id, $user_id){
		$params = array(
				'id' => $questionnary_id,
				'xreturn' => 'author_id'
		);
		$author_id = xModel::load('questionnary', $params)->get();
		
		return in_array($user_id, $author_id[0]);
	}
}