<?php
class userQuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	/**
	 * Get boolean to say if the questionnary was already filled
	 * @param integer $questionnary_id
	 * @return boolean true if filled, false else
	 */
	function alreadyFillQuestionnary($questionnary_id){
		$params = array(
				'questionnary_id' => $questionnary_id,
				'user_id' => xAuth::info('id'),	
		);
		
		$params = array(
				'questionnary_id' => $questionnary_id,
				'user_id' => xAuth::info('id'),
		);
		
		$model = $this->get($params);
		
		if($model == null){
			return 0;
		}else{
			return 1;
		}
	}
	
	/**
	 * Main method to get infos about user-questionnary
	 * @see xRestElement::get()
	 */
	function get($params = null){
		return xModel::load('user-questionnary', $params)->get();
	}
	
	
}