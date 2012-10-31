<?php
class RoleController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}

	function indexAction(){
		
	}
	
	/**
	 * Get if the role is administrator
	 * @todo finish this method
	 * @param string $role
	 * @return bloolean
	 */
	function isAdmin($role){
		return $role;
	}
	
	/**
	 * Get roles from users
	 * @param integer $userId
	 * @return array Roles of the user
	 */
	function getRolesFromUser($userId){
		$params = array(
				'user_id' => $userId,
				'xjoin' => 'role-user, user',
				'xreturn' => 'role'
		);
		$roles = xModel::load('role', $params)->get();
		
		return $roles;
	}
	
	/**
	 * Get role id
	 * @param string $roleName
	 * @return integer Role id
	 */
	function getRoleId($roleName){
		$params = array(
				'role' => $roleName,
				'xreturn' => 'id'
		);
		$role_id = xModel::load('role', $params)->get();
		
		return $role_id[0]['id'];
	}
}