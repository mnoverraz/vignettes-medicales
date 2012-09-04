<?php
class GroupModel extends xModelMysql {

	public $table = 'Group';

	public $mapping = array(
			'id' => 'id',
			'name' => 'name'
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}