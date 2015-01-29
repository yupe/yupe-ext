<?php
if ( $forums->search()->getTotalItemCount() ) {
    $controller = $this;
    $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'id' => 'forum-grid',
            'type' => 'striped condensed',
            'dataProvider' => $forums->search(),
            'template' => "{items}",
            'enableSorting' => false,
            'columns' => [
                [
                    'header' => Yii::t('ForumModule.forum', 'Forums'),
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->title, ["/forum/forum/show", "alias" => $data->alias])',
                ],
                [
                    'name' => 'topicCount',
                    'htmlOptions' => ['width'=>'100']
                ],
                [
                    'name' => 'messageCount',
                    'value' => '$data->getTopicsMessageCount();',
                    'htmlOptions' => ['width'=>'100']
                ],
                [
                    'name' => 'lastMessage',
                    'value' => function($data) use ($controller){
                        return $controller->renderPartial('_viewLastMessage', ['message' => $data->getLastMessage()]);
                    },
                    'htmlOptions' => ['width'=>'150']
                ],
            ],
        ]
    );
} ?>
