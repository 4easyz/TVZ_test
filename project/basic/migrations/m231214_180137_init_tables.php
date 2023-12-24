<?php

use yii\db\Migration;

/**
 * Class m231214_180137_init_tables
 */
class m231214_180137_init_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cars', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string()->notNull()->notNull(),
        ]);

        $this->createTable('operator', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string()->notNull()->notNull(),
        ]);

        $this->createTable('operator_car', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'car_id' => $this->integer()->unsigned()->notNull(),
            'operator_id' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->addForeignKey(
            'car_id_fk_constraint', 
            'operator_car', 
            'car_id', 
            'cars', 
            'id', 
            'CASCADE' 
        );
        $this->addForeignKey(
            'operator_id_fk_constraint', 
            'operator_car', 
            'operator_id',
            'operator', 
            'id', 
            'CASCADE' 
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231214_180137_init_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231214_180137_init_tables cannot be reverted.\n";

        return false;
    }
    */
}
