<?php

use yii\db\Migration;

/**
 * Handles adding gps_hide to table `sale`.
 */
class m160630_192053_add_gps_hide_to_sale extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sale', 'gps_hide', $this->boolean()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sale', 'gps_hide');
    }
}
