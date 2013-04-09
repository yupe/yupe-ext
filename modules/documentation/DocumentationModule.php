<?php

class DocumentationModule extends YWebModule
{

    public $files = 'README.md,README_EN.md,LICENSE,UPGRADE,CHANGELOG,TEAM.md';

    public function getCategory()
    {
        return Yii::t('DocumentationModule.documentation', 'Юпи!');
    }


    public function getParamsLabels()
    {
        return array(
            'files' => Yii::t('DocumentationModule.documentation', 'Список файлов документации (перечислите через запятую)'),
            
        );
    }

    public function getEditableParams()
    {
        return array(
            'files'
        );
    }


    public function getName()
    {
        return Yii::t('DocumentationModule.documentation', 'Файлы документации');
    }

    public function getDescription()
    {
        return Yii::t('DocumentationModule.documentation', 'Модуль для просмотра и редактирования файлов документации (README.md, LICENSE.md, etc)');
    }

    public function getAuthor()
    {
        return Yii::t('DocumentationModule.documentation', 'reka dev team');
    }

    public function getAuthorEmail()
    {
        return Yii::t('DocumentationModule.documentation', 'reka@info.kz');
    }

    public function getUrl()
    {
        return Yii::t('DocumentationModule.documentation', 'http://reka.kz');
    }

    public function getIcon()
    {
        return "book";
    }

    public function getVersion()
    {
        return Yii::t('DocumentationModule.documentation', '0.1');
    }

}
