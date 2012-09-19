<?php
class QuestionnaryController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		if(!isset($_SESSION['store']))
			return $this->settingsAction();
		elseif(!isset($_SESSION['store']['settings']))
			return $this->settingsAction();
		elseif(!isset($_SESSION['store']['header']))
			return $this->headerAction();
		elseif(!isset($_SESSION['store']['question']))
			return $this->questionAction();
		elseif(!isset($_SESSION['store']['feedback']))
			return $this->feedbackAction();
		else
			return $this->save();
	}
	
	function settingsAction(){
		
		if($this->params['lang']){
			$this->putSessionSettings();
			return $this->headerAction();
		}
		
		$d['availableLanguages'] = xController::load('language')->getLanguages();
		$d['modules'] = xController::load('module')->getModules();
		$d['params'] = $this->params;
		$d['store'] = $_SESSION['store'];
		
		if(isset($_SESSION['store']['settings'])){
			/*
			 * Language
			*/
			$checked='';
			foreach($d['availableLanguages'] as $l){
				foreach($_SESSION['store']['settings']['languages'] as $lang){
					$haystack[] = $lang['id'];
				}
				if(in_array($l['id'], $haystack))
					$checked='checked="checked"';
			
				$d['formValues']['languages'][] = $checked;
			}
				
			/*
			 * Modules
			*/
			foreach($_SESSION['store']['settings']['modules'] as $m){
				$selected = array();
				foreach($d['modules'] as $module){
					if($m == $module['id'])
						$selected[] ='selected="selected"';
					else
						$selected[] ='';
				}
				$d['formValues']['modules'][] = $selected;
			}
		}
		
		return xView::load('create/questionnary-settings', $d)->render();
	}
	
	function headerAction(){
		
		if(isset($this->params['header'])){
			$this->putSessionHeader();
			return $this->questionAction();
		}
		
		$d['chooseLang'] = $_SESSION['store']['settings']['languages'];
		$d['modules'] = xController::load('module')->getModules();
		$d['params'] = $this->params;
		$d['session'] = $_SESSION['store'];
		
		if(isset($_SESSION['store']['header'])){
			foreach($d['chooseLang'] as $l){
				$d['formValues'][$l['common_abbr']]['title'] = 'value="'.$_SESSION['store']['header'][$l['common_abbr']]['title'].'"';
				$d['formValues'][$l['common_abbr']]['theme'] = 'value="'.$_SESSION['store']['header'][$l['common_abbr']]['theme'].'"';
				$d['formValues'][$l['common_abbr']]['description'] = $_SESSION['store']['header'][$l['common_abbr']]['description'];
			}
		}
		
		return xView::load('create/questionnary-header', $d)->render();
	}
	
	function questionAction(){
		
		
		if(isset($this->params['question'])){
			$d['question'] = $this->putSessionQuestion();
			return $this->feedbackAction();
		}
		
		$d['chooseLang'] = $_SESSION['store']['settings']['languages'];
		
		return xView::load('create/questionnary-question', $d)->render();
	}
	
	function feedbackAction(){
		if(isset($this->params['feedback'])){
			$d['feedback'] = $this->putSessionFeedback();
			return $this->save();
		}
		
		$d['chooseLang'] = $_SESSION['store']['settings']['languages'];
		
		return xView::load('create/questionnary-feedback', $d)->render();
	}
	
	
	
	

	
	/*
	 * Insert the form content of questionnary-settings in session
	 * 
	 * @return	Array Array inserted in session
	 */
	function putSessionSettings(){
		//modules

		$i=1;
		while(isset($this->params["module-".$i])){
			$modules[] = $this->params["module-".$i];
			$i++;
		}
		//-----------
		
		$r = array(
				'languages' => xController::load('language')->getLangFromId($this->params['lang']),
				'modules' => $modules
		);
		
		$_SESSION['store']['settings'] = $r;
		return $r;
	}
	
	/*
	 * Insert the form content of questionnary-header in session
	*
	* @return	Array Array inserted in session
	*/
	function putSessionHeader(){
	
		foreach($_SESSION['store']['settings']['languages'] as $l){
			$r[$l['common_abbr']]['title'] = $this->params[('title'.strtoupper($l['common_abbr']))];
			$r[$l['common_abbr']]['theme'] = $this->params[('theme'.strtoupper($l['common_abbr']))];
			$r[$l['common_abbr']]['description'] = $this->params[('description'.strtoupper($l['common_abbr']))];
		}
	
		$_SESSION['store']['header'] = $r;
		return $r;
	}
	
	
	
	function putSessionQuestion(){
		$r['paramedicalTest'] = $this->params['paramedicalTest'];
		$r['complementaryTest'] = $this->params['complementaryTest'];
		
		$_SESSION['store']['question'] = $r;
		return $r;
	}
	
	
	function putSessionFeedback(){
		
		$r = $this->params['feedback'];
		
		$_SESSION['store']['feedback'] = $r;
		return $r;
	}
	
	function save(){
		$s = $_SESSION;
		$settings = $_SESSION['store']['settings'];
		$header = $_SESSION['store']['header'];
		$questions = $_SESSION['store']['question'];
		$feedback = $_SESSION['store']['feedback'];
		
		
		$t = new xTransaction();
		$t->start();
		
		
		/*
		 * QUESTIONNARY
		 */
		
		$questionnary_data['author_id'] = xAuth::info('id');
		$questionnary_data['creation_date'] = date('Y-m-d H:i:s');
		$questionnary_data['limit_date'] = null;
		$questionnary_data['publication'] = 'false';
		$questionnary = xModel::load('questionnary', $questionnary_data);
		$t_questionnary = $t->execute($questionnary, 'put');
		
		$questionnary_id = $t_questionnary['insertid'];
		
		/*
		 * QUESTIONNARY TRADUCT
		 */
		foreach($settings['languages'] as $l){
			$questionnary_traduct_data[$l['common_abbr']]['language_id'] = $l['id'];
			$questionnary_traduct_data[$l['common_abbr']]['theme'] = $header[$l['common_abbr']]['theme'];
			$questionnary_traduct_data[$l['common_abbr']]['title'] = $header[$l['common_abbr']]['title'];
			$questionnary_traduct_data[$l['common_abbr']]['description'] = $header[$l['common_abbr']]['description'];
			$questionnary_traduct_data[$l['common_abbr']]['questionnary_id'] = $questionnary_id;
			$questionnary_traduct_data[$l['common_abbr']]['conclusion'] = $feedback[ucfirst($l['common_abbr'])];
			$questionnary_traduct[$l['common_abbr']] = xModel::load('questionnary-traduct', $questionnary_traduct_data[$l['common_abbr']]);
			$t->execute($questionnary_traduct[$l['common_abbr']], 'put');
		}
		
		/*
		 * MODULE_QUESTIONNARY
		*/
		foreach($settings['modules'] as $id){
			$module_questionnary_data['module_id'] = $id;
			$module_questionnary_data['questionnary_id'] = $questionnary_id;
			$module = xModel::load('module-questionnary', $module_questionnary_data);
			$t->execute($module, 'put');
		}
		
		
		/*
		 * QUESTION (paramedicalTest)
		 */
		$question_paramedical_data['questionnary_id'] = $questionnary_id;
		$question_paramedical_data['is_multiple_choice']  = $questions['paramedicalTest']['mode'];
		$question_paramedical_data['question_type'] = 1;
		$question_paramedical = xModel::load('question', $question_paramedical_data);
		$t_questionParamedicalTest = $t->execute($question_paramedical, 'put');
		
		$questionParamedicalTest_id = $t_questionParamedicalTest['insertid'];
		
		/*
		 * QUESTION_TRADUCT (paramedicalTest)
		 */
		foreach($settings['languages'] as $l){
			$question_paramedical_traduct_data[$l['common_abbr']]['question'] = $questions['paramedicalTest']['question'][$l['common_abbr']];
			$question_paramedical_traduct_data[$l['common_abbr']]['remark'] = $questions['paramedicalTest']['remark'][$l['common_abbr']];
			$question_paramedical_traduct_data[$l['common_abbr']]['language_id'] = $l['id'];
			$question_paramedical_traduct_data[$l['common_abbr']]['question_id'] = $questionParamedicalTest_id;
			$question_paramedical_traduct = xModel::load('question-traduct', $question_paramedical_traduct_data[$l['common_abbr']]);
			$t->execute($question_paramedical_traduct, 'put');
		}
		
		/*
		 * ANS_PARAMEDICAL_TEST
		 */
		foreach($questions['paramedicalTest']['paramedicalTests'] as $test_id => $v){
			$ans_paramedical_test_data['patient_values'] = $v['testValue'];
			if(isset($v['effectuated'])) $checked='true'; else $checked='false';
			$ans_paramedical_test_data['checked'] = $checked;
			$ans_paramedical_test_data['paramedical_test_id'] = $test_id;
			$ans_paramedical_test_data['question_id'] = $questionParamedicalTest_id;
			$ans_paramedical_test_data['group_id'] = 1; //TODO
			$ans_paramedical_test = xModel::load('ans-paramedical-test', $ans_paramedical_test_data);
			$t->execute($ans_paramedical_test, 'put');
		}
		
		/*
		 * 
		 */
		$i = 0;
		foreach($questions['complementaryTest'] as $q){
			/*---------------- Question ----------------- */
			$question_picture_data['questionnary_id'] = $questionnary_id;
			$question_picture_data['is_multiple_choice'] = $q['mode'];
			$question_picture_data['question_type'] = 2;
			$question_picture = xModel::load('question', $question_picture_data);
			$t_questionPictureTest = $t->execute($question_picture, 'put');
		
			$questionPictureTest_id = $t_questionPictureTest['insertid'];
			
			$d['question'][$i]['id'] = $questionPictureTest_id;
			
			
			/*---------------- Question_traduct ----------------- */
			foreach($settings['languages'] as $l){
				$question_picture_traduct_data[$l['common_abbr']]['question'] = $q['question'][$l['common_abbr']];
				$question_picture_traduct_data[$l['common_abbr']]['remark'] = 'NULL';
				$question_picture_traduct_data[$l['common_abbr']]['language_id'] = $l['id'];
				$question_picture_traduct_data[$l['common_abbr']]['question_id'] = $questionPictureTest_id;
				$question_picture_traduct[$l['common_abbr']] = xModel::load('question-traduct', $question_picture_traduct_data[$l['common_abbr']]);
				$t->execute($question_picture_traduct[$l['common_abbr']], 'put');
			}
			
			foreach($q['pictureTest'] as $pt){
				/*---------------- Ans_picture ----------------- */
				if(isset($pt['checked'])) $checked='true'; else $checked='false';
				$ans_picture_data['checked'] = $checked;
				$ans_picture_data['image_url'] = $pt['pictureName'];
				$ans_picture_data['question_id'] = $questionPictureTest_id;
				$ans_picture_data['group_id'] = 1; //TODO
				$ans_picture = xModel::load('ans-picture', $ans_picture_data);
				$t_ansPictureTest = $t->execute($ans_picture, 'put');
					
				$ansPictureTest_id = $t_ansPictureTest['insertid'];
				
				//$d['question'][$i]['images'][] = $pt;
				
				foreach($settings['languages'] as $l){
					/*---------------- Ans_picture_traduct ----------------- */
					$ans_picture_traduct_data[$l['common_abbr']]['testname'] = $q['testName'][$l['common_abbr']];
					$ans_picture_traduct_data[$l['common_abbr']]['comment'] = $pt['commentary'][$l['common_abbr']];
					$ans_picture_traduct_data[$l['common_abbr']]['ans_picture_id'] = $ansPictureTest_id;
					$ans_picture_traduct_data[$l['common_abbr']]['language_id'] = $l['id'];
					$ans_picture_traduct[$l['common_abbr']] = xModel::load('ans-picture-traduct', $ans_picture_traduct_data[$l['common_abbr']]);
					$t->execute($ans_picture_traduct[$l['common_abbr']], 'put');
				}
			}
		$i++;
		}
		
		$t->end();
		
		$d['Transaction'] = $t;
		
		return xView::load('create/questionnary-validated-form', $d)->render();
		
	}
	
	function sessionAction(){
		return xView::load('create/session')->render();
	}
	
	function clearQuestionnarySessionAction(){
		unset($_SESSION['store']);
		return xView::load('create/questionnary-settings')->render();
	}
	
}