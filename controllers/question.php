<?php
class QuestionController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
	}
	
	function getQuestionsFromQuestionnary($questionnaryId){
		$params = array(
    			'questionnary_id' => $questionnaryId,
				'question-traduct_language_id' => 1, //TODO
				'xreturn' => 'id, is_multiple_choice, question-traduct_question, question-traduct_remark, question_type'
    	);
		return $this->get($params);
	}
	
	function get($params = null){
		return xModel::load('question', $params)->get();
	}
}