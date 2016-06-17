<?php

use yii\db\Migration;

/**
 * Handles adding vat to table `sale`.
 */
class m160616_133733_add_vat_to_sale extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sale', 'vat', $this->boolean());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sale', 'vat');
    }
}
