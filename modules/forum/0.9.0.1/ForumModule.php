<?php
/**
 * ForumModule основной класс модуля forum
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.forum
 * @since 0.1
 *
 */

use yupe\components\WebModule;

class ForumModule extends WebModule
{
    const VERSION = '0.9.0.1';

    public function getDependencies()
    {
        return array(
            'user'
        );
    }

    public function getEditableParams()
    {
        return array(
            'adminMenuOrder',
        );
    }

    public function getParamsLabels()
    {
        return array(
            'adminMenuOrder' => Yii::t('ForumModule.forum', 'Menu items order'),
        );
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getCategory()
    {
        return Yii::t('ForumModule.forum', 'Content');
    }

    public function getName()
    {
        return Yii::t('ForumModule.forum', 'Forum');
    }

    public function getDescription()
    {
        return Yii::t('ForumModule.forum', 'Module for forum management');
    }

    public function getAuthor()
    {
        return Yii::t('ForumModule.forum', 'ApexWire');
    }

    public function getAuthorEmail()
    {
        return Yii::t('ForumModule.forum', 'apexwire@amylabs.ru');
    }

    public function getUrl()
    {
        return Yii::t('ForumModule.forum', 'http://yupe.ru');
    }

    public function getIcon()
    {
        return 'fa fa-fw fa-folder-open';
    }

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'forum.models.*',
            'forum.components.*',
        ));
    }

    public function getNavigation()
    {
        return array(
            array('label' => Yii::t('ForumModule.forum', 'Forums')),
            array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ForumModule.forum', 'Forum manage'), 'url' => array('/forum/forumBackend/index')),
            array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ForumModule.forum', 'Create forum'), 'url' => array('/forum/forumBackend/create')),
            array('label' => Yii::t('ForumModule.forum', 'Topics')),
            array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ForumModule.forum', 'Topic manage'), 'url' => array('/forum/topicBackend/index')),
            array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ForumModule.forum', 'Create topic'), 'url' => array('/forum/topicBackend/create')),
            array('label' => Yii::t('ForumModule.forum', 'Messages')),
            array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ForumModule.forum', 'Message manage'), 'url' => array('/forum/messageBackend/index')),
            array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ForumModule.forum', 'Create message'), 'url' => array('/forum/messageBackend/create')),
        );
    }

    public function getAdminPageLink()
    {
        return '/forum/forumBackend/index';
    }
}