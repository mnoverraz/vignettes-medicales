<?php
class ParamedicalTestModel extends xModelMysql {

	public $table = 'Paramedical_test';

	public $mapping = array(
			'id' => 'id',
			'normal_values' => 'normal_values'
	);

	public $joins = array(
			'paramedical-test-traduct' => 'JOIN Paramedical_test_traduct ON (Paramedical_test_traduct.paramedical_test_id = Paramedical_test.id)',
	);


	public $join = array('paramedical-test-traduct');
}