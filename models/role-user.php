<?php
class RoleUserModel extends xModelMysql {

	public $table = 'Role_user';

	public $mapping = array(
			'id' => 'id',
			'role_id' => 'role_id',
			'user_id' => 'user_id'
	);

	/*public $joins = array(
	 'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}