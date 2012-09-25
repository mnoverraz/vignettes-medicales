<?php
class AnswerModel extends xModelMysql {

	public $table = 'Answer';

	public $mapping = array(
			'id' => 'id',
			'question_type' => 'question_type',
			'answer_type_id' => 'answer_type_id',
			'question_id' => 'question_id',
			'user_id' => 'user_id'
	);
}