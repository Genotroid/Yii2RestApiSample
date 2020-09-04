<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auto}}`.
 */
class m200827_112912_create_auto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auto}}', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer(11)->notNull(),
            'brand' => $this->string(255)->notNull(),
            'model' => $this->string(255)->notNull(),
            'year' => $this->integer(4)->notNull(),
            'body_type' => $this->integer(11)->notNull(),
            'mileage' => $this->integer(11)->notNull()
        ]);

        $this->createIndex(
            'idx-auto-advert_id',
            'auto',
            'advert_id'
        );

        $this->addForeignKey(
            'fk-auto-advert_id',
            'auto',
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
            'fk-auto-advert_id',
            'auto'
        );

        $this->dropIndex(
            'idx-auto-advert_id',
            'auto'
        );

        $this->dropTable('{{%auto}}');
    }
}
