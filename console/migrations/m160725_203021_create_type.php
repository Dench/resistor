<?php

use yii\db\Migration;

/**
 * Handles the creation for table `type`.
 */
class m160725_203021_create_type extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
        
        $this->batchInsert('type',
            ['name'],
            [
                ['Villa'],
                ['Apartments'],
                ['Townhouse'],
                ['Building plot'],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('type');
    }
}
