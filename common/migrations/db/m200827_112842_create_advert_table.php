<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advert}}`.
 */
class m200827_112842_create_advert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advert}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->integer(11)->notNull(),
            'contacts' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->notNull(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advert}}');
    }
}
