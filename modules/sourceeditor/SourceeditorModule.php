<?php
/**
 *Класс модуля редактирования файлов - Files
 * @category filemanagement
 * @package YupeCMS
 * @author SergeyMiracle <sergeymiracle@gmail.com>
 * @version 1.0
 **/

class SourceeditorModule extends YWebModule
{
    /**
     * Категория модуля:
     *
     * @return string category
     */
    public function getCategory()
    {
        return Yii::t('Sourceeditor.files', 'Юпи!');
    }

    /**
     * Название модуля:
     *
     * @return string module name
     */
    public function getName()
    {
        return Yii::t('Sourceeditor.files', 'Редактор файлов');
    }

    /**
     * Описание модуля:
     *
     * @return string module description
     */
    public function getDescription()
    {
        return Yii::t('Sourceeditor.files', 'Модуль для просмотра и редактирования файлов');
    }

    /**
     * Автор модуля:
     *
     * @return string module author
     */
    public function getAuthor()
    {
        return Yii::t('Sourceeditor.files', 'SergeyMiracle');
    }

    /**
     * E-mail адрес автора модуля:
     *
     * @return string module author email
     */
    public function getAuthorEmail()
    {
        return Yii::t('Sourceeditor.files', 'sergeymiracle@gmail.com');
    }

    /**
     * Домашняя страница модуля:
     *
     * @return string module homepage
     */
    public function getUrl()
    {
        return Yii::t('Sourceeditor.files', '');
    }

    /**
     * Иконка модуля:
     *
     * @return string module icon
     */
    public function getIcon()
    {
        return "folder-open";
    }

    /**
     * Версия модуля:
     *
     * @return string module version
     */
    public function getVersion()
    {
        return Yii::t('Sourceeditor.files', '0.1');
    }

    /**
     * Меню для "верхушки" (возможно с чайлдами)
     *
     * @return array меню для "верхушки"
     **/
    public function getTopMenu()
    {
        return array(
            array(
                'label' => Yii::t('Sourceeditor.files', 'Файловый редактор'),
                'url' => array('/files/show/index', 'file' => 'index'),
                'icon' => 'folder-open',
            ),
        );
    }

    /**
     * Меню для сайдбара
     *
     * @return array меню для сайдбара
     **/
    public function getLeftMenu()
    {
        return array(
            array(
                'label' => Yii::t('Sourceeditor.files', 'Файловый редактор'),
                'url' => array('/files/show/index', 'file' => 'index'),
                'icon' => 'home',
            ),
        );
    }

    public function init()
    {
        parent::init();
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else {
            return false;
        }
    }

}
