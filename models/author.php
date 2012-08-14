<?php
class AuthorModel extends xModelMysql {

	public $table = 'Author';

	public $mapping = array(
			'id' => 'id',
			'user_id' => 'user_id',
	);
	
	public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);
	
	
	public $join = array('user','questionnary');
}