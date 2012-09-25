<?php
class QuestionModel extends xModelMysql {

	public $table = 'Question';

	public $mapping = array(
			'id' => 'id',
			'is_multiple_choice' => 'is_multiple_choice',
			'question_type' => 'question_type',
			'questionnary_id' => 'questionnary_id'
	);

	public $joins = array(
			'question-traduct' => 'JOIN Question_traduct ON (Question.id = Question_traduct.question_id)'
	);


	public $join = array('question-traduct');
	
}