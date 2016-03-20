<?php

use yii\db\Migration;

class m160319_110723_sale_add_cell_top extends Migration
{
    public function up()
    {
        $this->addColumn('sale', 'top', 'boolean');
    }

    public function down()
    {
        $this->dropColumn('sale', 'top');
    }
}
