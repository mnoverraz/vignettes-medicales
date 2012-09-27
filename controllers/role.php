<?php
class RoleController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	function isAdmin($role){
		return $role;
	}
	
	function getRoleId($roleName){
		$params = array(
				'role' => $roleName,
				'xreturn' => 'id'
		);
		$role_id = xModel::load('role', $params)->get();
		
		return $role_id[0]['id'];
	}
}