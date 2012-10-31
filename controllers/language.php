<?php
class LanguageController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		return xView::load('home/home')->render();
	}
	
	/**
	 * Get all languages available
	 * @return Array Array with all languages
	 */
	function getLanguages(){
		return $this->get(null);
	}
	
	/**
	 * Get Language from id
	 * @param integer $id
	 * @return array Array with all info for the language
	 */
	function getLangFromId($id){
		$params = array(
				'id' => $id
		);
		return $this->get($params);
	}
	
	/**
	 * Get Language from an abbreviation of the language (p.ex. fr,en,de)
	 * @param string $common_abbr
	 * @return array Array with all info for the language
	 */
	function getLanguageFromAbbr($common_abbr){
		$params = array(
				'common_abbr' => $common_abbr
		);
		return $this->get($params);
	}
	
	/**
	 * Main method to get language
	 * @see xRestElement::get()
	 * @param array Array with all info for the language
	 */
	function get($params = null){
		return xModel::load('language', $params)->get();
	}
}