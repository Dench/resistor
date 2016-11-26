<?php

use yii\db\Migration;

/**
 * Handles the creation of table `offer`.
 */
class m161126_142119_create_offer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('offer', [
            'id' => $this->primaryKey(),
            'code' => $this->string(32)->unique()->notNull(),
            'text' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('offer');
    }
}
