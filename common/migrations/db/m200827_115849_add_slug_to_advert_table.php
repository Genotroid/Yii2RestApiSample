<?php

use yii\db\Migration;

/**
 * Class m200827_115849_add_slug_to_advert_table
 */
class m200827_115849_add_slug_to_advert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('advert', 'slug', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('advert', 'slug');
    }
}
