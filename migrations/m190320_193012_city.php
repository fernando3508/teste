<?php

use yii\db\Migration;

/**
 * Class m190320_193012_city
 */
class m190320_193012_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'state_id' => $this->integer(),
            'name' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk_city_state_id',
            'city',
            'state_id',
            'state',
            'id'
        );

        $content = json_decode(file_get_contents('citys.txt'), true);

        \Yii::$app->db->createCommand()->batchInsert(app\models\City::tableName(), ['name', 'state_id'], $content)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193012_city cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193012_city cannot be reverted.\n";

        return false;
    }
    */
}
