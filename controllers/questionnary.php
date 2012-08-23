<?php
class QuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
		$data = xUtil::filter_keys($this->params, array('title', 'theme', 'description', 'module-1'));
		
		if($data)
			$d['toSession'] = $this->putSession();
			//return xView::load('create/question')->render();
		if(isset($_SESSION['store']['questionnary']))
			$d['formValues'] = $this->generateFormValues();
		
		$d['modules'] = xModel::load('module')->get();
		$d['params'] = $this->params;
		
		return xView::load('create/questionnary', $d)->render();
	}
	
	function post(){
		return xView::load('home/home')->render();
	}
	
	/*
	 * Insert the form content in session
	 * 
	 * @return	Array Array inserted in session
	 */
	function putSession(){
		//modules

		$i=1;
		while(isset($this->params["module-".$i])){
			$modules[] = $this->params["module-".$i];
			$i++;
		}
		//-----------
		
		$r = array(
				'title' => $this->params['title'],
				'theme' => $this->params['theme'],
				'description' => $this->params['description'],
				'modules' => $modules
		);
		
		$_SESSION['store']['questionnary'] = $r;
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