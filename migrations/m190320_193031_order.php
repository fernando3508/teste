<?php

use yii\db\Migration;

/**
 * Class m190320_193031_order
 */
class m190320_193031_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'order_status_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_order_customer_id',
            'order',
            'customer_id',
            'customer',
            'id'
        );

        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193031_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193031_order cannot be reverted.\n";

        return false;
    }
    */
}
