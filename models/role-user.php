<?php
class RoleUserModel extends xModelMysql {

	public $table = 'Role_user';

	public $mapping = array(
			'id' => 'id',
			'role_id' => 'role_id',
			'User_id' => 'user_id'
	);

	public $joins = array(
			'user' => 'JOIN `User` ON (`User`.lms_id = Role_user.user_id)',
			'role' => 'JOIN Role ON (Role_user.role_id = Role.id)'
	);


	public $join = array();
}