<?php
class GroupTraductModel extends xModelMysql {

	public $table = 'Group_traduct';

	public $mapping = array(
			'id' => 'id',
			'name' => 'name',
			'group_id' => 'group_id',
			'language_id' => 'language_id'
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}