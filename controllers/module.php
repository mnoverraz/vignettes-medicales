<?php
class ModuleController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		return xView::load('home/home')->render();
	}
	
	function getModulesFromQuestionnary($questionnaryId){
		$params = array(
    			'questionnary_id' => $questionnaryId,
				'joins' => array('module'),
				'xreturn' => array('module_id, module')
    	);
		return xModel::load('module-questionnary', $params)->get();
	}
	
	/*
	 * Get all modules
	 * 
	 * @return Array Array of all modules
	 */
	function getModules(){
		return $this->get();
	}
	
	function get($params = null){
		return xModel::load('module', $params)->get();
	}
}