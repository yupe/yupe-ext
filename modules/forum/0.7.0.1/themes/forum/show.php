<?php
$this->breadcrumbs = array_merge(
    array(Yii::t('ForumModule.forum', 'Forums') => array('/forum/forum/index')),
    array_reverse($forum->getParentList()),
    array($forum->title)
);
?>
<?php echo $this->renderPartial('_view', array('model' => $forum)); ?>