<?php
class QuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		if(!isset($_SESSION['store']))
			return $this->settingsAction();
		elseif(!isset($_SESSION['store']['settings']))
			return $this->settingsAction();
		elseif(!isset($_SESSION['store']['header']))
			return $this->headerAction();
		else
			return $this->questionAction();
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
		
		if(isset($this->params['header'])){
			$this->putSessionHeader();
			//return $this->headerAction();
		}
		
		$d['chooseLang'] = $_SESSION['store']['settings']['languages'];
		$d['modules'] = xController::load('module')->getModules();
		$d['params'] = $this->params;
		$d['session'] = $_SESSION['store'];
		
		if(isset($_SESSION['store']['header'])){
			foreach($d['chooseLang'] as $l){
				$d['formValues'][$l['common_abbr']]['title'] = 'value="'.$_SESSION['store']['header'][$l['common_abbr']]['title'].'"';
				$d['formValues'][$l['common_abbr']]['theme'] = 'value="'.$_SESSION['store']['header'][$l['common_abbr']]['theme'].'"';
				$d['formValues'][$l['common_abbr']]['description'] = $_SESSION['store']['header'][$l['common_abbr']]['description'];
			}
		}
		
		return xView::load('create/questionnary-header', $d)->render();
	}
	
	
	
	
	
	
	
	
	function questionAction(){
		$d['chooseLang'] = $_SESSION['store']['settings']['languages'];
		
		return xView::load('create/questionnary-question', $d)->render();
	}
	
	
	
	
	
	
	
	

	
	/*
	 * Insert the form content of questionnary-settings in session
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
	 * Insert the form content of questionnary-header in session
	*
	* @return	Array Array inserted in session
	*/
	function putSessionHeader(){
	
		foreach($_SESSION['store']['settings']['languages'] as $l){
			$r[$l['common_abbr']]['title'] = $this->params[('title'.strtoupper($l['common_abbr']))];
			$r[$l['common_abbr']]['theme'] = $this->params[('theme'.strtoupper($l['common_abbr']))];
			$r[$l['common_abbr']]['description'] = $this->params[('description'.strtoupper($l['common_abbr']))];
		}
	
		$_SESSION['store']['header'] = $r;
		return $r;
	}
}