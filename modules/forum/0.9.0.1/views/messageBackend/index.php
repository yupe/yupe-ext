<?php
$this->breadcrumbs = [
    Yii::t('ForumModule.forum', 'Forums') => ['/forum/forumBackend/index'],
    Yii::t('ForumModule.forum', 'Topics') => ['/forum/messageBackend/index'],
    Yii::t('ForumModule.forum', 'Manage'),
];

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

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'forum-message-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            [
                'name' => 'id',
                'htmlOptions' => ['style' => 'width:20px'],
                'type' => 'raw',
                'value' => 'CHtml::link($data->id, ["/forum/forumBackend/update", "id" => $data->id])',
                'filter' => CHtml::activeTextField($model, 'id', ['class' => 'form-control','style' => 'width:20px']),
            ],
            [
                'name'  => 'topic_id',
                'value' => '$data->getTopicTitle()',
                'filter' => CHtml::activeDropDownList($model, 'topic_id', ForumTopic::model()->getFormattedList(), ['empty' => '', 'class' => 'form-control'])
            ],
            [
                'name'  => 'user_id',
                'value' => '$data->getUserNickname()',
                'filter' => CHtml::activeDropDownList($model, 'user_id', ForumMessage::model()->getUserList(), ['empty' => '', 'class' => 'form-control'])
            ],
            [
                'name' => 'message',
                'type' => 'ntext',
            ],
            [
                'name' => 'date',
                'htmlOptions' => ['style' => 'width:150px'],
                'filter' => false,
            ],
            [
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ],
        ],
    ]
); ?>