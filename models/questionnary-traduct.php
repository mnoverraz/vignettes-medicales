<?php
class QuestionnaryTraductModel extends xModelMysql {

	public $table = 'Questionnary_traduct';

	public $mapping = array(
			'id' => 'id',
			'theme' => 'theme',
			'title' => 'title',
			'description' => 'description',
			'conclusion' => 'conclusion',
			'language_id' => 'language_id',
			'questionnary_id' => 'questionnary_id'
	);
}