<?php

class HomeController extends xWebController {

    function defaultAction() {
    	try{
    		$this->ltiProcessingAction();
    	}catch (xException $e){
    		$d['exception'] = $e;
    		return xView::load('error/display', $d)->render();
    	}
    	
        return $this->listAction();
    }
    
    /*
     * @TODO: put quesitonnary_publication to 1 (true)
     */
    function listAction(){
    	$d['model'] = $this->get();
    	$d['langMoodle'] = $_SESSION['_basic_lti_context']['launch_presentation_locale'];
    	return xView::load('home/home', $d)->render();
    }
    
    function get(){
    	$params = array(
    			'language_common_abbr' => xContext::$lang,
    			'questionnary_publication' => '0',
    			'xreturn' => 'theme, title, creation_date, limit_date, firstname, lastname, email, module'
    	);
    	return xModel::load('questionnary-traduct', $params)->get();
    }
    
    public function put($lms_id, $firstname, $lastname, $email, $role){
    	//USER
    	$userData = array(
    			'lms_id' =>  $lms_id,
    			'firstname' => $firstname,
    			'lastname' => $lastname,
    			'email' => $email
    	);
    	$user = xModel::load('user', $userData);
    	
    	//ROLE USER
    	$params = array(
    			'role' => $role,
    			'xreturn' => 'id'
    	);
    	$role_id = xModel::load('role', $params)->get();
    	$role_userData = array(
    			'role_id' =>  $role_id,
    			'user_id' => $lms_id
    	);
    	$role_user = xModel::load('role-user', $role_userData);
    	
    	//SEND TO DB
    	$t = new xTransaction();
    	$t->start();
    	$t->execute($user, 'put');
    	$t->execute($role_user, 'put');
    	$t->end();
    }
    /*
     * @TODO : supprimer l'action qui n'est là que pour les tests
     */
    function ltiProcessingAction(){
    	$lti = $_SESSION['_basic_lti_context'];
    	if(isset($lti)){
    		$lti = $_SESSION['_basic_lti_context'];
    		 
    		//insert user with his role in database if not exist
    		$params = array(
    				'lms_id' => $lti['user_id']
    		);
    		$r['userFound'] = xModel::load('user', $params)->count();
    		if($r['userFound'] == 0){
    			$this->put(
    					$lti['user_id'],
    					$lti['lis_person_name_given'],
    					$lti['lis_person_name_family'],
    					$lti['lis_person_contact_email_primary'],
    					$lti['roles']
    			);
    		}
    		 
    		//set language
    		xContext::$front->setup_i18n($lti['launch_presentation_locale']);
    		 
    		return xView::load('debug/debug', $r)->render();
    	}else{
    		//appeler une page d'erreur
    		throw new xException(_("exception-moodle-noConnected"), 401, array('toto','toto2'));
    	}
    	
    }
  
}