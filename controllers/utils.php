<?php
class UtilsController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){	
	}
	
	/**
	 * Change the language in the framework context
	 * @param string $langString
	 */
	function changeLanguage($langString){
		xContext::$front->setup_i18n($langString);		
	}
	
	/**
	 * Return a url formated for dompdf images.
	 * @param string $url
	 * @return string
	 */
	function pdfurl($url) {
		$is_pdf = !isset($_REQUEST['html']);
		if (!$is_pdf) return $url;
		$file = preg_replace('/.*a(.+)/', 'file://'.xContext::$basepath.'/public/a$1', $url);
		return $file;
	}
}