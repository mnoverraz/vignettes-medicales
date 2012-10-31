<?php
class PictureTestController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	/**
	 * Get picture test from a question
	 * @param integer $question_id
	 * @return array Array of a picture test
	 */
	function getTestsFromQuestion($question_id){
		$params = array(
				'question_id' => $question_id,
				'ans-picture-traduct_language_id' => 1, //TODO
				'group-traduct_language_id' => 1, //TODO
				
				'xorder' => 'ASC',
				'xjoin' => 'ans-picture-traduct, group, group-traduct',
				'xorder_by' => 'group_id',
				'xreturn' => 'id, checked, image_url, group_id, ans-picture-traduct_testname, ans-picture-traduct_comment, group-traduct_name, question_id'
		);
		return $this->get($params);
	}
	
	/**
	 * Main method to get a picture test
	 * @param array $params Array for the query
	 * @see xRestElement::get()
	 * @return array Array of picture test infos
	 */
	function get($params = null){
		return xModel::load('ans-picture', $params)->get();
	}
}