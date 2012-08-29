<?php
class QuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		//spécifier quel est l'état courant du quesitonnaire
		switch('roger'){
			case 'toto':
				//---
			default:
				return $this->headerAction();
		}
	}
	
	function settingsAction(){
		
		if($this->params['lang']){
			$this->putSessionSettings();
			return $this->headerAction();
		}
		
		$d['availableLanguages'] = xController::load('language')->getLanguages();
		$d['modules'] = xController::load('module')->getModules();
		$d['params'] = $this->params;
		$d['store'] = $_SESSION['store'];
		
		if(isset($_SESSION['store']['settings'])){
			/*
			 * Language
			*/
			$checked='';
			foreach($d['availableLanguages'] as $l){
				foreach($_SESSION['store']['settings']['languages'] as $lang){
					$haystack[] = $lang['id'];
				}
				if(in_array($l['id'], $haystack))
					$checked='checked="checked"';
			
				$d['formValues']['languages'][] = $checked;
			}
				
			/*
			 * Modules
			*/
			foreach($_SESSION['store']['settings']['modules'] as $m){
				$selected = array();
				foreach($d['modules'] as $module){
					if($m == $module['id'])
						$selected[] ='selected="selected"';
					else
						$selected[] ='';
				}
				$d['formValues']['modules'][] = $selected;
			}
		}
		
		return xView::load('create/questionnary-settings', $d)->render();
	}
	
	function headerAction(){
		
		
		$data = xUtil::filter_keys($this->params, array('title', 'theme', 'description', 'module-1'));
		
		if(isset($data['title'])){
			$d['toSession'] = $this->putSession();
			return xView::load('create/question')->render();
		}
		//if(isset($_SESSION['store']['questionnary'])){
		$d['formValues'] = $this->generateFormValues();
		//}
		$d['chooseLang'] = $_SESSION['store']['settings']['languages'];
		$d['modules'] = xController::load('module')->getModules();
		$d['params'] = $this->params;
		$d['session'] = $_SESSION['store'];
		$d['role_id'] = xController::load('role')->getRoleId('Instructor');
		
		return xView::load('create/questionnary-header', $d)->render();
	}

	
	/*
	 * Insert the form content in session
	 * 
	 * @return	Array Array inserted in session
	 */
	function putSessionSettings(){
		//modules

		$i=1;
		while(isset($this->params["module-".$i])){
			$modules[] = $this->params["module-".$i];
			$i++;
		}
		//-----------
		
		$r = array(
				'languages' => xController::load('language')->getLangFromId($this->params['lang']),
				'modules' => $modules
		);
		
		$_SESSION['store']['settings'] = $r;
		return $r;
	}
	
	/*
	 * Generate an array with values of form to fill with
	 * @return	Array Array of values to fill
	 */
	private function generateFormValues(){
		if(isset($_SESSION['store']['questionnary'])){
			$r = $_SESSION['store']['questionnary'];
		}else{
			$r = array(
					'title' => '',
					'theme' => '',
					'description' => '',
					'modules' => array(1)
			);
		}
		return $r;
	}
}