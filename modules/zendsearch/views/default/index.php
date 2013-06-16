<?php
/* @var $this DefaultController */

 $this->breadcrumbs = array(
        Yii::app()->getModule('zendsearch')->getCategory() => array(),
        Yii::t('slideshow', 'Поиск (Zend)') => array('/zendsearch/default/index'),
        Yii::t('slideshow', 'Управление'),
    );

    $this->pageTitle = Yii::t('zendsearch', 'Поиск (Zend) - управление');
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('zendsearch', 'Поиск (Zend)'); ?>
        <small><?php echo Yii::t('zendsearch', 'управление'); ?></small>
    </h1>
</div>
<p>
    Модели, которые вы хотите загнать в индекс нужно описать в конфигурационном файле.<br/>
    Для создания или обновления индекса нажмите кнопку ниже.
</p>
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'ajaxButton',
    'id' => 'create-search',
    'type' => 'primary',
    'label' => Yii::t('zendsearch', 'Обновить индекс'),
    'loadingText' => 'Индекс обновляется... Подождите...',
    'size' => 'large',
    'url' => $this->createUrl('/zendsearch/default/create'),
    'ajaxOptions' => array(
	'type' => 'POST',
	'data' => array(Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
	'url' => $this->createUrl('/zendsearch/default/create'),
	'beforeSend' => 'function(){
	    $("#create-search").text("Подождите...");
	}',
	'success' => 'js:function(data,status){
	    $("#create-search").text("Обновить поиск");
	    alert(data);
	}',
    )
));
?>
