<?php

use yii\db\Migration;

/**
 * Handles adding name to table `sale_lang`.
 */
class m160616_162105_add_name_to_sale_lang extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sale_lang', 'name', $this->string());
        $this->dropColumn('sale', 'name');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sale_lang', 'name');
        $this->addColumn('sale', 'name', $this->string());
    }
}
