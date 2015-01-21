<?php
$this->breadcrumbs = array(
    Yii::t('ForumModule.forum', 'Forums') => array('/forum/forumBackend/index'),
    Yii::t('ForumModule.forum', 'Topics') => array('index'),
    $model->title => array('/forum/topicBackend/view', 'id' => $model->id),
    Yii::t('ForumModule.forum', 'Change'),
);

$this->pageTitle = Yii::t('ForumModule.forum', 'Topics - edit');

$this->menu = array_merge(
    Yii::app()->getModule('forum')->getNavigation(),
    array(
        array('label' => Yii::t('ForumModule.forum', 'Forum') . ' «' . mb_substr($model->title, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('ForumModule.forum', 'Change topic'), 'url' => array(
            '/forum/topicBackend/update',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('ForumModule.forum', 'View topic'), 'url' => array(
            '/forum/topicBackend/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('ForumModule.forum', 'Remove topic'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/forum/topicBackend/delete', 'id' => $model->id),
            'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
            'confirm' => Yii::t('ForumModule.forum', 'Do you really want to remove topic?'),
            'csrf' => true,
        )),
    )
);
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('ForumModule.forum', 'Change topic'); ?><br />
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
