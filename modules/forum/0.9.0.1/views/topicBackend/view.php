<?php
$this->breadcrumbs = [
    Yii::t('ForumModule.forum', 'Forums') => ['/forum/forumBackend/index'],
    Yii::t('ForumModule.forum', 'Topics') => ['index'],
    $model->title,
];

$this->pageTitle = Yii::t('ForumModule.forum', 'Topics - show');

$this->menu = array_merge(
    Yii::app()->getModule('forum')->getNavigation(),
    [
        ['label' => Yii::t('ForumModule.forum', 'Forum') . ' «' . mb_substr($model->title, 0, 32) . '»'],
        ['icon' => 'pencil', 'label' => Yii::t('ForumModule.forum', 'Change topic'), 'url' => [
            '/forum/topicBackend/update',
            'id' => $model->id
        ]],
        ['icon' => 'eye-open', 'label' => Yii::t('ForumModule.forum', 'View topic'), 'url' => [
            '/forum/topicBackend/view',
            'id' => $model->id
        ]],
        ['icon' => 'trash', 'label' => Yii::t('ForumModule.forum', 'Remove topic'), 'url' => '#', 'linkOptions' => [
            'submit' => ['/forum/topicBackend/delete', 'id' => $model->id],
            'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
            'confirm' => Yii::t('ForumModule.forum', 'Do you really want to remove topic?'),
            'csrf' => true,
        ]],
    ]
);
?>
<div class="page-header">
     <h1>
         <?php echo Yii::t('ForumModule.forum', 'Show topic'); ?><br />
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
     </h1>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    [
        'data'       => $model,
        'attributes' => [
            'id',
            [
                'name'  => 'forum_id',
                'value' => $model->getForumTitle(),
            ],
            'title',
            'alias',
            [
                'name' => 'description',
                'type' => 'raw'
            ],
            [
                'name'  => 'status',
                'value' => $model->getStatus(),
            ],
        ],
    ]
); ?>