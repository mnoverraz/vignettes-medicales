<?php
class RoleModel extends xModelMysql {

	public $table = 'Role';

	public $mapping = array(
			'id' => 'id',
			'role' => 'role'
	);

	public $joins = array(
			'role-user' => 'JOIN Role_user ON (Role.id = Role_user.role_id)',
			'user' => 'JOIN User ON (Role_user.user_id = User.id)',
	);


	public $join = array();
	
}