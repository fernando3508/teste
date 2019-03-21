<?php

use yii\db\Migration;

/**
 * Class m190320_193105_category
 */
class m190320_193105_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_product_category_id',
            'product',
            'category_id',
            'category',
            'id'
        );

        $inserts[] = [
          'name' => 'Laptops & Notebooks',
          'created_at' => strtotime('NOW'),
        ];

        $inserts[] = [
          'name' => 'Macs',
          'created_at' => strtotime('NOW'),
        ];

        foreach ($inserts as $insert)
        {
            $this->insert('category', $insert);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193105_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193105_category cannot be reverted.\n";

        return false;
    }
    */
}
