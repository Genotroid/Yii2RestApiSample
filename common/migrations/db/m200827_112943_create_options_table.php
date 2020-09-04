<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%options}}`.
 */
class m200827_112943_create_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%options}}', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer(11)->notNull(),
            'air_conditioning' => $this->smallInteger(1)->defaultValue(0),
            'airbags' => $this->smallInteger(1)->defaultValue(0),
            'multimedia' => $this->smallInteger(1)->defaultValue(0),
            'cruise_control' => $this->smallInteger(1)->defaultValue(0)
        ]);

        $this->createIndex(
            'idx-options-advert_id',
            'options',
            'advert_id'
        );

        $this->addForeignKey(
            'fk-options-advert_id',
            'options',
            'advert_id',
            'advert',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-options-advert_id',
            'options'
        );

        $this->dropIndex(
            'idx-options-advert_id',
            'options'
        );

        $this->dropTable('{{%options}}');
    }
}
