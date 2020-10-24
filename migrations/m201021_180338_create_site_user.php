<?php

use yii\db\Migration;

/**
 * Class m201021_180338_create_site_user
 */
class m201021_180338_create_site_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'site',
            'auth_key' => 'auth-key',
            'access_token' => 'gmxbjwSQvunUhXHFYBDzZpAGtsaPfEry',
            'password_hash' => 'secret',
            'email' => 'email@site.here',
            'status' => 1, // active
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'site']);
    }
}
