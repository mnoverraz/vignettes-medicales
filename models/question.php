<?php
class QuestionParamedicalTestModel extends xModelMysql {

	public $table = 'Question';

	public $mapping = array(
			'id' => 'id',
			'is_multiple_choice' => 'is_multiple_choice',
			'question_type' => 'question_type',
			'questionnary_id' => 'questionnary_id'
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}