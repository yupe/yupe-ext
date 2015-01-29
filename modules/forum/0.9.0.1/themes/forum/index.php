<?php
$this->pageTitle = Yii::t('ForumModule.forum', 'Forums');
$this->description = Yii::t('ForumModule.forum', 'Forums');
$this->keywords = Yii::t('ForumModule.forum', 'Forums');
?>

<?php $this->breadcrumbs = [Yii::t('ForumModule.forum', 'Forums')]; ?>

<h1>
    <small><?php echo Yii::t('ForumModule.forum', 'Forums'); ?></small>
</h1>

<?php
$this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider'       => $forums->search(),
        'template'           => '{items}',
        'itemView'           => '_view',
        'ajaxUpdate'         => false,
    ]
);
?>
