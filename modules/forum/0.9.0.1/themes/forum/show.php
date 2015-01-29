<?php
$this->breadcrumbs = array_merge(
    [Yii::t('ForumModule.forum', 'Forums') => ['/forum/forum/index']],
    array_reverse($forum->getParentList()),
    [$forum->title]
);
?>
<?php echo $this->renderPartial('_view', ['data' => $forum]); ?>