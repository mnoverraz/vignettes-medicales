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
	
	function getTestsFromQuestion($question_id){
		$params = array(
				'ans-paramedical-test_question_id' => $question_id,
				'paramedical-test-traduct_language_id' => 1, //TODO
				'group-traduct_language_id' => 1, //TODO
				
				'xjoin' => 'ans-paramedical-test, paramedical-test-traduct, group, group-traduct',
				'xorder' => 'ASC',
				'xorder_by' => '`ans-paramedical-test_group_id`',
				'xreturn' => 'id, normal_values, paramedical-test-traduct_name, ans-paramedical-test_patient_values, ans-paramedical-test_checked, ans-paramedical-test_group_id, group-traduct_name'
		
		);
		return $this->get($params);
	}
	
	function get($params = null){
		return xModel::load('paramedical-test', $params)->get();
	}
}