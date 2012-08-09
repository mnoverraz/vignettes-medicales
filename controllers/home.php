<?php
class HomeController extends xWebController {

    function defaultAction() {
        return $this->listAction();
    }
    
    function listAction(){
    	$this->params = xModel::load('home')->get();
    	return xView::load('home/home', $this->params)->render();
    }
}