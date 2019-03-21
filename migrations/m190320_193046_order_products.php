<?php

use yii\db\Migration;

/**
 * Class m190320_193046_order_products
 */
class m190320_193046_order_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_products', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'quatity' => $this->integer(),
            'price' => $this->decimal(15,4)->notNull(),
            'total' => $this->decimal(15,4)
        ]);

        $this->addForeignKey(
            'fk_order_products_order_id',
            'order_products',
            'order_id',
            'order',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193046_order_products cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193046_order_products cannot be reverted.\n";

        return false;
    }
    */
}
