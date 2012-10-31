<?php
class DialogController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	/**
	 * Get paramedical test in DB to give to the view
	 * @return xView paramedical test dialog view
	 */
	function paramedicalTestAction(){
		
		$usedLang = xController::load('language')->getLanguageFromAbbr(xContext::$lang);
		
		
		$d['usedLang'] = $usedLang;
		$d['paramedicalTests'] = xController::load('paramedicalTest')->getParamedicalTests($usedLang[0]['id']);
		
		
		
		$this->meta['layout']['template'] = 'layoutDialog.tpl';
		return xView::load('create/dialog/paramedicalTest', $d);
	}
	
	/**
	 * Return view for picture loading form
	 * @return xView Picture load view form
	 */
	function pictureAction(){
	
		$this->meta['layout']['template'] = 'layoutDialog.tpl';
		return xView::load('create/dialog/picture');
	}
	
}