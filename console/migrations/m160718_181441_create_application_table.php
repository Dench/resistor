<?php

use yii\db\Migration;

/**
 * Handles the creation for table `application_table`.
 */
class m160718_181441_create_application_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'time' => $this->integer()->notNull(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'mycity' => $this->string(),
            'rooms' => $this->string(),
            'distance' => $this->string(),
            'sqr' => $this->string(),
            'budget' => $this->string(),
            'region' => $this->string(),
            'text' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('application');
    }
}
