Модуль "Метрика"
===============





Примеры вызова виджета ViewsWidget:
1) <?php $this->widget('metrika.widgets.ViewsWidget'); ?>

2) <?php $this->widget('metrika.widgets.ViewsWidget', ['url' => Yii::app()->createAbsoluteUrl('/blog/post/show/', ['slug' => $data->slug])]); ?>