<?php
class ModuleController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		return xView::load('home/home')->render();
	}
	
	/**
	 * Get modules infos from a questionnary id
	 * @param integer $questionnaryId
	 * @return array Array with data from a module
	 */
	function getModulesFromQuestionnary($questionnaryId){
		$params = array(
    			'questionnary_id' => $questionnaryId,
				'joins' => array('module'),
				'xreturn' => array('module_id, module')
    	);
		return xModel::load('module-questionnary', $params)->get();
	}
	
	/**
	 * Get all modules
	 * @return array Array of all modules
	 */
	function getModules(){
		return $this->get();
	}
	
	/**
	 * Main method get for get modules infos
	 * @param array $params Array to specify the query
	 * @see xRestElement::get()
	 * @return array Array of modules
	 */
	function get($params = null){
		return xModel::load('module', $params)->get();
	}
}