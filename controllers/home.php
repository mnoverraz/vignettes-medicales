<?php
class HomeController extends xWebController {

    function defaultAction() {
        return $this->listAction();
    }
    
    /*
     * @TODO: put quesitonnary_publication to 1 (true)
     */
    function listAction(){
    	
    	$params = array(
    					'language_common_abbr' => xContext::$lang,
    					'questionnary_publication' => '0',
    					'xreturn' => 'theme, title, creation_date, limit_date, firstname, lastname, email, module'
    	);
    	
    	$this->params = xModel::load('questionnary-traduct', $params)->get();
    	
    	
    	
    	return xView::load('home/home', $this->params)->render();
    }
}