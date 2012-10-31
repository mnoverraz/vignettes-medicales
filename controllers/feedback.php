<?php
class FeedbackController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	/**
	 * Get feedback from a questionnary
	 * @param integer $questionnary_id
	 * @return string Feedback text
	 */
	function getFeedback($questionnary_id){
		$params = array(
				'questionnary_id' => $questionnary_id,
		);
		return $this->get($params);
	}
	
	/**
	 * Main method to get a feedback.
	 * @see xRestElement::get()
	 */
	function get($params = null){
		return xModel::load('user-questionnary', $params)->get();
	}
	
	
}