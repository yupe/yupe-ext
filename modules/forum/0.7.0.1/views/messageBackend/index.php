<?php
$this->breadcrumbs = array(
    Yii::t('ForumModule.forum', 'Forums') => array('/forum/forumBackend/index'),
    Yii::t('ForumModule.forum', 'Topics') => array('/forum/messageBackend/index'),
    Yii::t('ForumModule.forum', 'Manage'),
);

$this->pageTitle = Yii::t('ForumModule.forum', 'Messages - manage');

$this->menu = Yii::app()->getModule('forum')->getNavigation();
?>
    <div class="page-header">
        <h1>
            <?php echo Yii::t('ForumModule.forum', 'Messages'); ?>
            <small><?php echo Yii::t('ForumModule.forum', 'manage'); ?></small>
        </h1>
    </div>

    <p><?php echo Yii::t('ForumModule.forum', 'This section describes forum management'); ?></p>

<?php $this->widget('yupe\widgets\CustomGridView', array(
    'id'           => 'forum-message-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        array(
            'name' => 'id',
            'htmlOptions' => array('style' => 'width:20px'),
            'type' => 'raw',
            'value' => 'CHtml::link($data->id, array("/forum/forumBackend/update", "id" => $data->id))'
        ),
        array(
            'name'  => 'topic_id',
            'value' => '$data->getTopicTitle()',
            'filter' => CHtml::activeDropDownList($model, 'topic_id', ForumTopic::model()->getFormattedList(), array('encode' => false, 'empty' => ''))
        ),
        array(
            'name'  => 'user_id',
            'value' => '$data->getUserNickname()',
            'filter' => CHtml::activeDropDownList($model, 'user_id', ForumMessage::model()->getUserList(), array('encode' => false, 'empty' => ''))
        ),
        array(
            'name' => 'message',
            'type' => 'ntext',
        ),
        'date',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>