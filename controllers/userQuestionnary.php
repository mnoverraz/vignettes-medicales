<?php
class userQuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
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
	
	function get($params = null){
		return xModel::load('user-questionnary', $params)->get();
	}
	
	
}