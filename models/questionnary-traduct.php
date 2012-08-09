<?php
class QuestionnaryTraductModel extends xModelMysql {

	public $table = 'Questionnary_traduct';

	public $mapping = array(
			'id' => 'id',
			'language_id' => 'language_id',
			'theme' => 'theme',
			'title' => 'title',
			'descr_anamnese' => 'descr_anamnese',
			'descr_traitement' => 'descr_traitement',
			'descr_statut_clinique' => 'descr_statut_clinique'
	);
}