<?php
class QuestionTraductModel extends xModelMysql {

	public $table = 'Question_traduct';

	public $mapping = array(
			'id' => 'id',
			'question' => 'question',
			'remark' => 'remark',
			'language_id' => 'language_id',
			'question_id' => 'question_id'
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}