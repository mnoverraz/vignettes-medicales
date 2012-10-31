<?php
class AdminController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		return $this->adminAction();
	}
	
	/**
	 * Action to add user as admin in application.
	 * @param integer $id User id
	 * @return 
	 */
	function addAction(){
		$user_id = $this->params['id'];
		return $this->grantAdmin($user_id);
	}
	
	/**
	 * Action to remove user as admin in application
	 * @param integer $id User id
	 * @return boolean Success of operation
	 */
	function deleteAction(){
		$user_id = $this->params['id'];
		return $this->unGrantAdmin($user_id);
	}
	
	/**
	 * Action to get an array with whole administrators
	 * @return array Array of all administrators
	 */
	function adminAction(){
		$d['listeAdmin'] = $this->getAdmin();
		return xView::load('admin/admin', $d)->render();
	}
	
	/**
	 * Action to get all non Admin in application by firstname lastname
	 * @param string $search firstname, lastname or both to search
	 * @return array Array with all non admin
	 */
	function searchNonAdminAction(){
		$search = $this->params['search'];
		return $this->searchNonAdmin($search);
	}
	
	/**
	 * Grant a user as Administrator
	 * @param integer $userId User id
	 * @throws xException
	 * @return boolean Success or fail
	 */
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
	
	/**
	 * UnGrant a user of Administrator rights
	 * @param integer $userId User id
	 * @return boolean Success or fail
	 */
	function unGrantAdmin($userId){
		$params = array(
				'User_id' => $userId,
				'role_id' => 4,
		);
		$delete = xModel::load('role-user', $params)->delete();
		return $delete['xsuccess'];
	}
	
	/**
	 * Get users from params
	 * @param array $params params of the request
	 * @return array users
	 */
	function get($params=null){
		$model = xModel::load('user', $params)->get();
		return $model;
	}
	
	/**
	 * Get non Admin users
	 * @return array List of users id
	 */
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
			'xreturn' => 'id'
		))->get();
		
		return $model;
	}
	
	/**
	 * Get Admins
	 * @return array return admin users
	 */
	function getAdmin(){
		$params = array(
				'role_role' => 'Administrator',
				'xjoin' => 'role-user, role',
				'xreturn' => 'id, lms_id, firstname, lastname, email'
		);
	
		return $this->get($params);
	}
	
	/**
	 * Get non admin users from a search parameter
	 * @param string $search firstname, lastname or both
	 * @return array Array of the search
	 */
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