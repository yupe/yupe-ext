<?php
$this->breadcrumbs = [
    Yii::t('ForumModule.forum', 'Forums') => ['/forum/forumBackend/index'],
    Yii::t('ForumModule.forum', 'Topics') => ['/forum/topicBackend/index'],
    Yii::t('ForumModule.forum', 'Manage'),
];

$this->pageTitle = Yii::t('ForumModule.forum', 'Topics - manage');

$this->menu = Yii::app()->getModule('forum')->getNavigation();
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('ForumModule.forum', 'Forums'); ?>
        <small><?php echo Yii::t('ForumModule.forum', 'manage'); ?></small>
    </h1>
</div>

<p><?php echo Yii::t('ForumModule.forum', 'This section describes forum management'); ?></p>

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'forum-grid',
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
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name'  => 'title',
                'editable' => [
                    'url' => $this->createUrl('/forum/topicBackend/inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'filter' => CHtml::activeTextField($model, 'title', ['class' => 'form-control']),
            ],
            [
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name'  => 'alias',
                'editable' => [
                    'url' => $this->createUrl('/forum/topicBackend/inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'filter' => CHtml::activeTextField($model, 'alias', ['class' => 'form-control']),
            ],
            [
                'name'  => 'forum_id',
                'value' => '$data->getForumTitle()',
                'filter' => CHtml::activeDropDownList($model, 'forum_id', Forum::model()->getFormattedList(), ['class' => 'form-control', 'encode' => false, 'empty' => ''])
            ],
            [
                'class'   => 'yupe\widgets\EditableStatusColumn',
                'name'    => 'status',
                'url'     => $this->createUrl('/forum/topicBackend/inline'),
                'source'  => $model->getStatusList(),
                'options' => [
                    ForumTopic::STATUS_OPEN => ['class' => 'label-success'],
                    ForumTopic::STATUS_CLOSE => ['class' => 'label-danger'],
                ],

            ],
            [
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ],
        ],
    ]
); ?>