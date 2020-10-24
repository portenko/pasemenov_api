<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data}}`.
 */
class m201021_190336_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%data}}', [
            'id' => $this->primaryKey(),
            'fields' => $this->text()->notNull(),
            'page_uid' => $this->string()->unique(),
            'created' => $this->integer()->notNull()->unsigned(),
        ], $tableOptions);

        $this->createIndex('{{%idx-data-page_uid}}', '{{%data}}', 'page_uid', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%data}}');
    }
}
