<?php
$this->breadcrumbs = [
    Yii::t('ForumModule.forum', 'Forums') => ['/forum/forumBackend/index'],
    Yii::t('ForumModule.forum', 'Messages') => ['/forum/messageBackend/index'],
    Yii::t('ForumModule.forum', 'Create'),
];

$this->pageTitle = Yii::t('ForumModule.forum', 'Messages - create');

$this->menu = Yii::app()->getModule('forum')->getNavigation();
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('ForumModule.forum', 'Message'); ?>
        <small><?php echo Yii::t('ForumModule.forum', 'create'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>