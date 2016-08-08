<?php

namespace Fuel\Migrations;

class Create_fuel_res_bbs
{
	public function up()
	{
		\DBUtil::create_table('fuel_res_bbs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'res_time' => array('type' => 'text'),
			'user_name' => array('type' => 'text'),
			'content' => array('type' => 'text'),
			'mail_address' => array('type' => 'text'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('fuel_res_bbs');
	}
}