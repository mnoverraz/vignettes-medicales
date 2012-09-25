<?php
class UtilsController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){	
	}
	
	
	function changeLanguage($langString){
		xContext::$front->setup_i18n($langString);		
	}
	
}