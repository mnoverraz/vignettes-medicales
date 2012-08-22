<?php
class RoleModel extends xModelMysql {

	public $table = 'Role';

	public $mapping = array(
			'id' => 'id',
			'role' => 'role'
	);

	/*public $joins = array(
	 'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}