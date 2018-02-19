<?php

use yii\db\Migration;

/**
 * Handles the creation for table `social_table`.
 */
class m160511_023756_create_social_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{social}}', [
            'id'            => $this->primaryKey(),
            'image'         => $this->string(100)->notNull(),
            'url'           => $this->string(100)->notNull(),
            'title'         => $this->string(100)->notNull(),
            'name'          => $this->string(100)->notNull(),
            'created_by'    => $this->integer()->notNull(),
            'created_at'    => $this->dateTime()->notNull(),
            'updated_by'    => $this->integer()->notNull(),
            'updated_at'    => $this->dateTime()->notNull(),
        ], $tableOptions);
        
        $this->addForeignKey(
            'usercreatesocial', 'social', 'created_by', 'user', 'id', 'no action', 'no action'
        );
        
        $this->addForeignKey(
            'userupdatesocial', 'social', 'updated_by', 'user', 'id', 'no action', 'no action'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('usercreatesocial', 'social');
        $this->dropForeignKey('userupdatesocial', 'social');
        $this->dropTable('{{social}}');
    }
}
