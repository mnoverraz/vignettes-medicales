<?php

class HomeController extends xWebController {

    function defaultAction() {
        $data['welcome-text'] = 'Welcome here!';
        return xView::load('home/home', $data)->render();
    }
    
    function testAction(){
    	$data['toto'] = 'toto';
    	return xView::load('vignette/vignette', $data)->render();
    }
}