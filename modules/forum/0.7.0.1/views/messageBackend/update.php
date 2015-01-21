<?php
$this->breadcrumbs = array(
    Yii::t('ForumModule.forum', 'Forums') => array('/forum/forumBackend/index'),
    Yii::t('ForumModule.forum', 'Messages') => array('index'),
    $model->id => array('/forum/messageBackend/view', 'id' => $model->id),
    Yii::t('ForumModule.forum', 'Change'),
);

$this->pageTitle = Yii::t('ForumModule.forum', 'Messages - edit');

$this->menu = array_merge(
    Yii::app()->getModule('forum')->getNavigation(),
    array(
        array('label' => Yii::t('ForumModule.forum', 'Forum') . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('ForumModule.forum', 'Change message'), 'url' => array(
            '/forum/messageBackend/update',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('ForumModule.forum', 'View message'), 'url' => array(
            '/forum/messageBackend/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('ForumModule.forum', 'Remove message'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/forum/messageBackend/delete', 'id' => $model->id),
            'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
            'confirm' => Yii::t('ForumModule.forum', 'Do you really want to remove message?'),
            'csrf' => true,
        )),
    )
);
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('ForumModule.forum', 'Change message'); ?><br />
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
