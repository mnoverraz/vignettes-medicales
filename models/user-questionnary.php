<?php
class UserQuestionnaryModel extends xModelMysql {

	public $table = 'User_questionnary';

	public $mapping = array(
			'user_id' => 'user_id',
			'questionnary_id' => 'questionnary_id',
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}