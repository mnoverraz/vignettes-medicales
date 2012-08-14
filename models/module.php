<?php
class ModuleModel extends xModelMysql {

	public $table = 'Module';

	public $mapping = array(
			'id' => 'id',
			'module' => 'module',
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');*/
}