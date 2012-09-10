<?php
class DialogController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	function paramedicalTestAction(){
		
		$usedLang = xController::load('language')->getLanguageFromAbbr(xContext::$lang);
		
		
		$d['usedLang'] = $usedLang;
		$d['paramedicalTests'] = xController::load('paramedicalTest')->getParamedicalTests($usedLang[0]['id']);
		
		
		
		$this->meta['layout']['template'] = 'layoutDialog.tpl';
		return xView::load('create/dialog/paramedicalTest', $d);
	}
	
	function pictureAction(){
	
		$this->meta['layout']['template'] = 'layoutDialog.tpl';
		return xView::load('create/dialog/picture');
	}
	
}