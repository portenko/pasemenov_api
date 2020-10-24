<?php

use yii\db\Migration;

/**
 * Class m201021_191212_create_pages_data
 */
class m201021_191212_create_pages_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%data}}', [
            'fields' => '[ { "tag": "input", "type": "text", "label": "Title", "name": "f-title", "class": "class-title", "alt": "Title", "placeholder": "", "value": "" }, { "tag": "textarea", "label": "Description", "name": "f-description", "class": "class-description", "alt": "Description", "placeholder": "", "value": "" } ]',
            'page_uid' => 'slug-page-1',
            'created' => time(),
        ]);
        $this->insert('{{%data}}', [
            'fields' => '[ { "tag": "input", "type": "text", "label": "First name", "name": "f-first-name", "class": "class-first-name", "alt": "First name", "placeholder": "", "value": "" }, { "tag": "input", "type": "text", "label": "Last name", "name": "f-last-name", "class": "class-last-name", "alt": "Last name", "placeholder": "", "value": "" }, { "tag": "select", "label": "Gender", "name": "f-gender", "class": "class-gender", "value": "", "items": [ {"value":"m", "label": "Male"}, {"value":"f", "label": "Female"} ] } ]',
            'page_uid' => 'slug-page-2',
            'created' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%data}}');
    }

}
