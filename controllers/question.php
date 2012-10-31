<?php
class QuestionController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
	}
	
	/**
	 * Get questions from a questionnary
	 * @param integer $questionnaryId
	 * @return array Array of question info
	 */
	function getQuestionsFromQuestionnary($questionnaryId){
		$params = array(
    			'questionnary_id' => $questionnaryId,
				'question-traduct_language_id' => 1, //TODO
				'xreturn' => 'id, is_multiple_choice, question-traduct_question, question-traduct_remark, question_type'
    	);
		return $this->get($params);
	}
	
	/**
	 * Main method to get questions
	 * @param integer $params Parameters for the query
	 * @see xRestElement::get()
	 * @return array Array with questions infos
	 */
	function get($params = null){
		return xModel::load('question', $params)->get();
	}
}