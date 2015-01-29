<?php
$this->breadcrumbs = array_merge(
    [Yii::t('ForumModule.forum', 'Forums') => ['/forum/forum/index']],
    array_reverse($topic->forum->getParentList()),
    [$topic->forum->title => ['/forum/forum/show', 'alias' => $topic->forum->alias]],
    [$topic->title]
);
?>
<h1><?php echo $topic->title; ?></h1>
<div class="container-fluid">
    <?php echo $topic->description; ?>
</div>

<div class="container-fluid">
    <?php $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'id' => 'topic-message-grid',
            'dataProvider' => $topic->getMessages(),
            'enableSorting' => false,
            'template' => "{items}\n{pager}",
            'type' => 'condensed striped',
            'ajaxUpdate' => true,
            'columns'      => [
                [
                    'name'  => 'user_id',
                    'htmlOptions' => ['style' => 'width:50px'],
                    'value' => '$data->getUserNickname()',
                ],
                [
                    'name' => 'message',
                    'type' => 'ntext',
                ],
                [
                    'name' => 'date',
                    'htmlOptions' => ['style' => 'width:120px'],
                ]
            ],
        ]
    ); ?>
</div>

<?php $this->widget('application.modules.forum.widgets.MessageFormWidget',
    ['topic' => $topic]
); ?>