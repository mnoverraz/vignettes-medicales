<?php
class LanguageController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		return xView::load('home/home')->render();
	}
	
	/*
	 * Get all languages
	 * @return Array Array with all languages
	 */
	function getLanguages(){
		return $this->get(null);
	}
	
	function getLangFromId($id){
		$params = array(
				'id' => $id
		);
		return $this->get($params);
	}
	
	function getLanguageFromAbbr($common_abbr){
		$params = array(
				'common_abbr' => $common_abbr
		);
		return $this->get($params);
	}
	
	function get($params = null){
		return xModel::load('language', $params)->get();
	}
}