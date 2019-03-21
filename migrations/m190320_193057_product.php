<?php

use yii\db\Migration;

/**
 * Class m190320_193057_product
 */
class m190320_193057_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->text(),
            'sku' => $this->string(),
            'price' => $this->decimal(15,4)->notNull(),
            'width' => $this->string(),
            'height' => $this->string(),
            'enable' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_order_products_product_id',
            'order_products',
            'product_id',
            'product',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193057_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193057_product cannot be reverted.\n";

        return false;
    }
    */
}
