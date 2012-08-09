<?php

class HomeController extends xWebController {

    function defaultAction() {
        return $this->listAction();
    }
    
    function listAction(){
    	
    	$data = xModel::load('home')->get();
    	return xView::load('home/home', $data)->render();
    }
}