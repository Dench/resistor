<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_175132_create_country_table extends Migration
{
    
    private $table_name = '{{%country}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table_name, [
            'code' => 'CHAR(2) NOT NULL PRIMARY KEY',
            'name' => $this->string(52)->notNull(),
            'population' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert($this->table_name,
            ['code', 'name',  'population'],
            [['AU', 'Australia', 18886000],
            ['BR', 'Brazil', 170115000],
            ['CA', 'Canada', 1147000],
            ['CN', 'China', 1277558000],
            ['DE', 'Germany', 82164700],
            ['FR', 'France', 59225700],
            ['GB', 'United Kingdom', 59623400],
            ['IN', 'India', 1013662000],
            ['RU', 'Russia', 146934000],
            ['US', 'United States', 278357000]]
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table_name);
    }
}
