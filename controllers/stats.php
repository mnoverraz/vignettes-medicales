<?php
class StatsController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){	
	}
	
	
	function statsAction(){
	
		$d['vignette'] = $_SESSION['vignette'];
		
		return xView::load('stats/stats', $d)->render();
	}
	
	function loadingAction(){
		xController::load('vignette')->loading($this->params['id']);
		xUtil::redirect(xUtil::url('stats/stats'));
	}
	
}