<?php
class AdminController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		return $this->adminAction();
	}
	
	
	function addAction(){
		$user_id = $this->params['id'];
		//$d['addaction'] = $this->grantAdmin($user_id);
		//xUtil::redirect(xUtil::url('admin'));
		return $this->grantAdmin($user_id);
	}
	
	function deleteAction(){
		$user_id = $this->params['id'];
		return $this->unGrantAdmin($user_id);
		//xUtil::redirect(xUtil::url('admin'));
	}
	
	function adminAction(){

		$d['listeAdmin'] = $this->getAdmin();
		
		return xView::load('admin/admin', $d)->render();
	}
	
	function searchNonAdminAction(){
		$search = $this->params['search'];
		return $this->searchNonAdmin($search);
	}
	
	function grantAdmin($userId){
		$params = array(
				'User_id' => $userId,
				'role_id' => 4,
		);
		try{
			$insert = xModel::load('role-user', $params)->put();
		}catch(xException $e){
			throw new xException('db.admin.add.cannotAdd');
		}
		
		return $insert['xsuccess'];
	}
	
	function unGrantAdmin($userId){
		$params = array(
				'User_id' => $userId,
				'role_id' => 4,
		);
		$delete = xModel::load('role-user', $params)->delete();
		return $delete['xsuccess'];
	}
	
	function get($params=null){
		$model = xModel::load('user', $params)->get();
		return $model;
	}
	
	function getNonAdmin(){
		$params = array(
				'role_role' => 'Administrator',
				'xjoin' => 'role-user, role',
				'xreturn' => 'id'
		);
		$admin = $this->get($params);
		
		
		$model = xModel::load('user', array(
			'id' => $admin,
			'id_comparator' => 'NOT IN',
			'role_role' => array('Student', 'Learner', 'Instructor'),
			'xjoin' => 'role-user, role',
			//'xreturn' => 'id, lms_id, firstname, lastname, email',
			'xreturn' => 'id'
		))->get();
		
		return $model;
	}
	
	function getAdmin(){
		$params = array(
				'role_role' => 'Administrator',
				'xjoin' => 'role-user, role',
				'xreturn' => 'id, lms_id, firstname, lastname, email'
		);
	
		return $this->get($params);
	}
	
	function searchNonAdmin($search){
		
				
		$params = array(
				'role_role' => array('Student', 'Learner', 'Instructor'),
				'search' => $search,
				'id' => $this->getNonAdmin(),
				'xjoin' => 'role-user, role',
				'xwhere' => 'fullname-search',
				'xreturn' => 'DISTINCT User.id, lms_id, firstname, lastname, email'
		);
		$model = xModel::load('user', $params)->get();
		return $model;
	}
}