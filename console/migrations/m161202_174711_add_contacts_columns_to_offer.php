<?php

use yii\db\Migration;

class m161202_174711_add_contacts_columns_to_offer extends Migration
{
    public function safeUp()
    {
        $this->addColumn('offer', 'name', $this->string());

        $this->addColumn('offer', 'phone1', $this->string());

        $this->addColumn('offer', 'phone2', $this->string());

        $this->addColumn('offer', 'email', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('offer', 'name');

        $this->dropColumn('offer', 'phone1');

        $this->dropColumn('offer', 'phone2');

        $this->dropColumn('offer', 'email');
    }
}
