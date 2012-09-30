<?php

class HomeController extends xWebController {

    function defaultAction() {
    	try{
    		$this->ltiProcessing();
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
    	$d['langMoodle'] = $_SESSION['_basic_lti_context']['launch_presentation_locale'];//TODELETE
    	return xView::load('home/home', $d)->render();
    }
    
    function get(){
    	$params = array(
    			'language_common_abbr' => xContext::$lang,
    			'questionnary_publication' => '0',
    			'xreturn' => 'theme, title, creation_date, limit_date, firstname, lastname, email, module, questionnary_id'
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
    	$role_id = xController::load('role')->getRoleId($role);
    	$role_userData = array(
    			'role_id' =>  $role_id,
    			'user_id' => $lms_id
    	);
    	$role_user = xModel::load('role-user', $role_userData);
    	
    	//SEND TO DB
    	try{
	    	$t = new xTransaction();
	    	$t->start();
	    	$t->execute($user, 'put');
	    	$t->execute($role_user, 'put');
	    	$t->end();
    	}catch(xException $e){
    		throw new xException($e->getMessage());
    	}
    	
    	return $t;
    }

    
    function ltiProcessing(){
    	
    	$lti = $_SESSION['_basic_lti_context'];
    	if(isset($lti)){
    		
    		//if(empty(xAuth::info('moodle_id'))){
    			
    			//check if the user is in DB
    			$params = array(
    					'lms_id' => $lti['user_id']
    			);
    			$user = xModel::load('user', $params)->get();
    			
    			if(count($user) == 0){
    				$d['put'] = $this->put(
    						$lti['user_id'],
    						$lti['lis_person_name_given'],
    						$lti['lis_person_name_family'],
    						$lti['lis_person_contact_email_primary'],
    						$lti['roles']
    				);
    				if($d['put']['results'][0]['result']['xsuccess'] == 1){
    					$id = $d['put']['results'][0]['result']['insertid'];
    					$firstName = $lti['lis_person_name_given'];
    					$lastName = $lti['lis_person_name_family'];
    					$email = $lti['lis_person_contact_email_primary'];
    					$moodle_id = $lti['user_id'];
    					$moodle_language = $lti['launch_presentation_locale'];
    				}else{
    					throw new xException(_("exception-lti-cannotInsertInDB"), 401);
    				}
    				
    			}else{
    				$id = $user[0]['id'];
    				$firstName = $user[0]['firstname'];
    				$lastName = $user[0]['lastname'];
    				$email = $user[0]['email'];
    				$moodle_id = $user[0]['lms_id'];
    				$moodle_language = $lti['launch_presentation_locale'];
    			}
    			
    			xAuth::set($email,$lti['roles'],array(
    					'id' => $id,
    					'firstName' => $firstName,
    					'lastName' => $lastName,
    					'email' => $email,
    					'moodle_id' => $moodle_id,
    					'moodle_language' => $moodle_language
    				)
    			);
    			//set language
    			xController::load('utils')->changeLanguage($moodle_language);
    			//xContext::$front->setup_i18n($moodle_language);
    		//}
    		return xView::load('home/home')->render();
    		
    	}else{
    		//appeler une page d'erreur
    		throw new xException(_("exception-moodle-noConnected"), 401);
    	}
    
    	
    }
  
}