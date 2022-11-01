<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttributesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'code' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'type' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addKey('code');
		$this->forge->createTable('attributes');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('attributes');
	}
}