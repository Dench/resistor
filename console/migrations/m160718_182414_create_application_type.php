<?php

use yii\db\Migration;

/**
 * Handles the creation for table `application_type`.
 */
class m160718_182414_create_application_type extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('application_type', [
            'application_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull()
        ]);
        
        $this->addForeignKey('fk-application_type-application_id', 'application_type', 'application_id', 'application', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-application_type-application_id', 'application_type');
        
        $this->dropTable('application_type');
    }
}
