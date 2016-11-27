<?php

use yii\db\Migration;

/**
 * Handles the creation of table `offer_photo`.
 */
class m161127_145301_create_offer_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('offer_photo', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'hash' => $this->string(),
            'sort' => $this->integer()->notNull()->defaultValue(0)
        ]);
        
        $this->addForeignKey('fk-offer_photo-item_id', 'offer_photo', 'item_id', 'offer_item', 'id', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-offer_photo-item_id', 'offer_photo');
        
        $this->dropTable('offer_photo');
    }
}
