<?php
include_once('ims-blti/blti.php');
include_once('ims-blti/OAuth.php');
include_once('ims-blti/blti_util.php');

class HomeController extends xWebController {

    function defaultAction() {
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
  
}