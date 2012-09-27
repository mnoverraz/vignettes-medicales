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
	
	function pdfurl($url) {
		$is_pdf = !isset($_REQUEST['html']);
		if (!$is_pdf) return $url;
		$file = preg_replace('/.*a(.+)/', 'file://'.xContext::$basepath.'/public/a$1', $url);
		return $file;
	}
}