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

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}