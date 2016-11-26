<?php

use yii\db\Migration;

/**
 * Handles the creation of table `offer_item`.
 */
class m161126_142414_create_offer_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('offer_item', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()
        ]);

        $this->addForeignKey('fk-offer_item-group_id', 'offer_item', 'group_id', 'offer', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-offer_item-group_id', 'offer_item');

        $this->dropTable('offer_item');
    }
}
