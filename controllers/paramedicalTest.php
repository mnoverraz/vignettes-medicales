<?php
class ParamedicalTestController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	function paramedicalTestAction(){
		$d['toto'] = 9;
		
		
		
		
		
		
		//$this->meta['layout']['template'] = 'layoutDialog.tpl';
		return xView::load('create/dialog/paramedicalTest', $d);
	}
	
	
	
	/*
	 * Get Paramedical tests in DB 
	 * @return	Array Array from whole ParamedicalTests
	 */
	function getParamedicalTests($lang){
		$params = array(
				'paramedical-test-traduct_language_id' => $lang
				
		);
		return $this->get($params);
	}
	
	function get($params = null){
		return xModel::load('paramedical-test', $params)->get();
	}
}