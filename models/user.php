<?php
class UserModel extends xModelMysql {

	public $table = 'User';

	public $mapping = array(
			'id' => 'id',
			'lms_id' => 'lms_id',
			'firstname' => "firstname",
			'lastname' => 'lastname',
			'email' => 'email'
	);

	public $joins = array(
			'role-user' => 'JOIN Role_user ON (Role_user.user_id = User.id)',
			'role' => 'JOIN Role ON (Role_user.role_id = Role.id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = User.id)'
			
	);
	
	public $wheres = array(
		'fullname-search' => 'models/admin/fullname-search'
	);

	public $join = array('questionnary');
}