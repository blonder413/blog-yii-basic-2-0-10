<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_table`.
 */
class m160511_023654_create_categories_table extends Migration
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
        
        $this->createTable('{{categories}}', [
            'id'            => $this->primaryKey(),
            'category'      => $this->string(100)->notNull(),
            'slug'      => $this->string(100)->notNull(),
            'image'         => $this->string(50),
            'description'   => $this->string(255),
            'created_by'    => $this->integer()->notNull(),
            'created_at'    => $this->dateTime()->notNull(),
            'updated_by'    => $this->integer()->notNull(),
            'updated_at'    => $this->dateTime()->notNull(),
        ], $tableOptions);
        
        $this->addForeignKey(
            'usercreatecategory', 'categories', 'created_by', 'user', 'id', 'no action', 'no action'
        );
        
        $this->addForeignKey(
            'userupdatecategory', 'categories', 'updated_by', 'user', 'id', 'no action', 'no action'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('usercreatecategory', 'categories');
        $this->dropForeignKey('userupdatecategory', 'categories');
        $this->dropTable('{{categories}}');
    }
}
