<?php

/**
 * Виджет для просмотра количества просмторов страницы
 *
 * @category YupeWidget
 * @package  yupe.modules.metrika.widgets
 * @author   apexwire <apexwire@amylabs.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link     http://yupe.ru
 *
 **/

class ViewsWidget extends yupe\widgets\YWidget
{
    public $url;
    public $count = 0;

    public function init()
    {
        if ( empty($this->url) ) {
            $this->url = \Yii::app()->getRequest()->getHostInfo().Yii::app()->getRequest()->getUrl();
            $this->count++;
        }
    }

    public function run()
    {
        $model = MetrikaUrl::model()->findByAttributes(array('url' => $this->url));

        if ( !is_null($model) ) {
            echo $this->count + $model->views;
        }
    }
}