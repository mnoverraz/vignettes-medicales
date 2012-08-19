<?php
class ModuleModel extends xModelMysql {

	public $table = 'Module';

	public $mapping = array(
			'id' => 'id',
			'module' => 'module',
	);
}