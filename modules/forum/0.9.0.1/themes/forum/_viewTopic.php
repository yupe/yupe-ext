<?php

if ( $topics->getTotalItemCount() ) {
    $controller = $this;



    $this->widget(
        'bootstrap.widgets.TbGridView',
        [
            'id' => 'topic-grid',
            'type' => 'striped condensed',
            'dataProvider' => $topics,
            'template' => "{items}",
            'enableSorting' => false,
            'rowCssClassExpression' => '
                ( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
                ( $data->status == ForumTopic::STATUS_CLOSE ? " danger" : null )
            ',
            'columns' => [
                [
                    'header' => Yii::t('ForumModule.forum', 'Topics'),
                    'type' => 'raw',
                    'value' => function($data) use ($controller){
                        $view = ( $data->status == ForumTopic::STATUS_CLOSE ? CHtml::tag("span",["class" => "glyphicon glyphicon glyphicon-lock"]) : "" );
                        $view.= " ".CHtml::link($data->title, ["/forum/topic/show", "alias" => $data->alias]);
                        return $view;
                    },
                ],
                [
                    'name' => 'messageCount',
                    'value' => '$data->messageCount',
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