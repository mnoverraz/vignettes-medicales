<?php
class FeedbackController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	function getFeedback($questionnary_id){
		$params = array(
				'questionnary_id' => $questionnary_id,
				//'xreturn' => ''
		);
		return $this->get($params);
	}
	
	function get($params = null){
		return xModel::load('user-questionnary', $params)->get();
	}
	
	
}