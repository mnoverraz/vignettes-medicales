<?php
class VignetteController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		/*
		$questionnary_id = $this->params('id');
		
		if(isset($questionnary_id)){*/
			if(isset($_SESSION['vignette'])){
				if($_SESSION['vignette']['questionnary']['id'] != $questionnary_id){
					unset($_SESSION['vignette']);
					$this->loading($questionnary_id);
				}
			}else{
				$this->loading($questionnary_id);
			}
			
			xUtil::redirect('vignette/anamnese');
			
		/*	
		}elseif(!isset($_SESSION['vignette'])){
			throw new xException(_("exception-vignette-doesntExist"), 412);
		}
		*/
		
	}
	
	function anamneseAction(){
	
		$d = $_SESSION['questionnary'];
		return xView::load('vignette/anamnese', $d)->render();
	}
	
	function questionnaryAction(){

		//Setting in session
		if(isset($this->params['paramedicalTests']) || isset($this->params['pictureTests'])){			
			$_SESSION['questionnary']['answers']['paramedicalTests'] = $this->params['paramedicalTests'];
			$_SESSION['questionnary']['answers']['pictureTests'] = $this->params['pictureTests'];
			xUtil::redirect('/vignette/public/vignette/bilan');
		}
		
		$d = $_SESSION['questionnary'];
		
		//Setting in session
		if(isset($this->params['paramedicalTests']) || isset($this->params['pictureTests'])){
			$_SESSION['questionnary']['answers']['paramedicalTests'] = $this->params['paramedicalTests'];
			$_SESSION['questionnary']['answers']['pictureTests'] = $this->params['pictureTests'];
			xUtil::redirect('/vignette/public/vignette/bilan');
		}
		
		return xView::load('vignette/questionnary', $d)->render();
	}
	
	function bilanAction(){
		
		//Setting in session
		if(isset($this->params['bilan'])){
			$_SESSION['questionnary']['answers']['pictureTests']['answers'] = $this->params['PictureTest'];
			$alredyFill = xController::load('userQuestionnary')->alreadyFillQuestionnary($_SESSION['questionnary']['questionnary']['questionnary']['id']);
			if($alredyFill == 0){
				$this->saveAnswers($_SESSION['questionnary']['answers']);
			}
			xUtil::redirect('/vignette/public/vignette/feedback');
		}
		
		$d = $_SESSION['questionnary'];
		return xView::load('vignette/bilan', $d)->render();
	}
	
	function feedbackAction(){
		$d = $_SESSION['questionnary']['questionnary'];
	
		return xView::load('vignette/feedback', $d)->render();
	}
	
	
	function loadingAction(){
		$this->loading($this->params['id']);
		xUtil::redirect('/vignette/public/vignette/anamnese');
	}
	
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
	
	
}