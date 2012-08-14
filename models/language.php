<?php
class LanguageModel extends xModelMysql {

	public $table = 'Language';

	public $mapping = array(
			'id' => 'id',
			'iso_code' => 'iso_code',
			'common_abbr' => 'common_abbr'
	);
}