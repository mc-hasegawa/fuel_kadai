<?php

class Model_Student extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'student_id',
		'name',
		'birthday',
	);


	protected static $_table_name = 'students';

}
