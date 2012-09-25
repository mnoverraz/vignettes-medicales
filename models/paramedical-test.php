<?php
class ParamedicalTestModel extends xModelMysql {

	public $table = 'Paramedical_test';

	public $mapping = array(
			'id' => 'id',
			'normal_values' => 'normal_values'
	);

	public $joins = array(
			'paramedical-test-traduct' => 'JOIN Paramedical_test_traduct ON (Paramedical_test_traduct.paramedical_test_id = Paramedical_test.id)',
			'ans-paramedical-test' => 'JOIN Ans_paramedical_test ON (Ans_paramedical_test.paramedical_test_id = Paramedical_test.id)',
			'group' => 'JOIN `Group` ON (`Group`.id = Ans_paramedical_test.group_id)',
			'group-traduct' => 'JOIN Group_traduct ON (Group_traduct.group_id = `Group`.id)'
			
	);


	public $join = array('paramedical-test-traduct');
}