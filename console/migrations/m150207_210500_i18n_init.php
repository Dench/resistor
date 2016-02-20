<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\db\Migration;

class m150207_210500_i18n_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('source_message', [
            'id' => $this->primaryKey(),
            'category' => $this->string(16),
            'message' => $this->text(),
        ], $tableOptions);

        $this->createTable('message', [
            'id' => $this->integer()->notNull(),
            'language' => $this->string(2)->notNull(),
            'translation' => $this->text(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_message_id_language', 'message', ['id', 'language']);
        $this->addForeignKey('fk_message_source_message', 'message', 'id', 'source_message', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_message_source_message', 'message');
        $this->dropTable('message');
        $this->dropTable('source_message');
    }
}
