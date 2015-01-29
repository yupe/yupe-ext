<?php
$this->breadcrumbs = [
    Yii::t('ForumModule.forum', 'Forums') => ['index'],
    $model->title,
];

$this->pageTitle = Yii::t('ForumModule.forum', 'Forums - show');

$this->menu = array_merge(
    Yii::app()->getModule('forum')->getNavigation(),
    [
        ['label' => Yii::t('ForumModule.forum', 'Forum') . ' «' . mb_substr($model->title, 0, 32) . '»'],
        ['icon' => 'pencil', 'label' => Yii::t('ForumModule.forum', 'Change forum'), 'url' => [
            '/forum/forumBackend/update',
            'id' => $model->id
        ]],
        ['icon' => 'eye-open', 'label' => Yii::t('ForumModule.forum', 'View forum'), 'url' => [
            '/forum/forumBackend/view',
            'id' => $model->id
        ]],
        ['icon' => 'trash', 'label' => Yii::t('ForumModule.forum', 'Remove forum'), 'url' => '#', 'linkOptions' => [
            'submit' => ['/forum/forumBackend/delete', 'id' => $model->id],
            'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
            'confirm' => Yii::t('ForumModule.forum', 'Do you really want to remove forum?'),
            'csrf' => true,
        ]],
    ]
);
?>
<div class="page-header">
     <h1>
         <?php echo Yii::t('ForumModule.forum', 'Show forum'); ?><br />
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
                'name'  => 'parent_id',
                'value' => $model->getParentName(),
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