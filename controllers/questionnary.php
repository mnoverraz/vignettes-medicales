<?php
class QuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
		
		$tata = xModel::load('module')->get();
		return xView::load('create/questionnary', $tata)->render();
	}
}