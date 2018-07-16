<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180715_134242_tracing
 */
class m180715_134242_tracing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tracing', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'url' => Schema::TYPE_TEXT,
            'time' => Schema::TYPE_BIGINT
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180715_134242_tracing cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180715_134242_tracing cannot be reverted.\n";

        return false;
    }
    */
}
