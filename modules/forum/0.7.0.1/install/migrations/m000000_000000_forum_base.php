<?php

/**
 * FileDocComment
 * Forum install migration
 * Класс миграций для модуля Форум:
 *
 * @category YupeMigration
 * @package  yupe.modules.forum.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000000_forum_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы: forum
     *
     * @return null
     **/
    public function safeUp()
    {
        //создаем таблицу форумов
        $this->createTable(
            '{{forum}}',
            array(
                'id' => 'pk',
                'parent_id' => 'integer DEFAULT NULL',
                'title' => 'varchar(250) NOT NULL',
                'alias' => 'varchar(150) NOT NULL',
                'description' => 'text',
                'status' => "boolean NOT NULL DEFAULT '1'",
            ),
            $this->getOptions()
        );

        $this->createIndex("ux_{{forum}}_alias", '{{forum}}', "alias", true);

        //создаем таблицу для тем в форумах
        $this->createTable(
            '{{forum_topic}}',
            array(
                'id' => 'pk',
                'forum_id' => 'integer DEFAULT NULL',
                'user_id' => 'integer DEFAULT NULL',
                'title' => 'varchar(250) NOT NULL',
                'alias' => 'varchar(150) NOT NULL',
                'description' => 'text',
                'status' => "boolean NOT NULL DEFAULT '1'",
            ),
            $this->getOptions()
        );

        $this->createIndex("ux_{{forum_topic}}_alias", '{{forum_topic}}', "alias", true);

        //создаем таблицу для сообщений в темах
        $this->createTable(
            '{{forum_message}}',
            array(
                'id' => 'pk',
                'topic_id' => 'integer DEFAULT NULL',
                'user_id' => 'integer DEFAULT NULL',
                'message' => 'text',
                'date' => 'integer DEFAULT NULL',
            ),
            $this->getOptions()
        );


    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{forum}}');
        $this->dropTableWithForeignKeys('{{forum_topic}}');
        $this->dropTableWithForeignKeys('{{forum_message}}');
    }
}