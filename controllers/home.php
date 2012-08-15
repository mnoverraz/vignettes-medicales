<?php

class HomeController extends xWebController {

    function defaultAction() {
    	//getLTI();
        return $this->listAction();
    }
    
    /*
     * @TODO: put quesitonnary_publication to 1 (true)
     */
    function listAction(){
    	return xView::load('home/home', $this->get())->render();
    }
    
    function get(){
    	$params = array(
    			'language_common_abbr' => xContext::$lang,
    			'questionnary_publication' => '0',
    			'xreturn' => 'theme, title, creation_date, limit_date, firstname, lastname, email, module'
    	);
    	 
    	return xModel::load('questionnary-traduct', $params)->get();
    }
    
    function getLTI(){
    	return new BLTI();
    }
}