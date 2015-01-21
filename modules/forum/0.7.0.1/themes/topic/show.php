<?php
$this->breadcrumbs = array_merge(
    array(Yii::t('ForumModule.forum', 'Forums') => array('/forum/forum/index')),
    array_reverse($topic->forum->getParentList()),
    array($topic->forum->title => array('/forum/forum/show', 'alias' => $topic->forum->alias)),
    array($topic->title)
);
?>
<div class="cart-exchange-office">
    <h1 style="color: #64c0da;"><?php echo $topic->title; ?></h1>
    <div class="holder">
        <?php echo $topic->description; ?>
    </div>
</div>
<div class="tab-block">
    <ul class="tabset">
        <li class="active"><a>Сообщения</a></li>
    </ul>
    <div class="tab-content" style="display: block;">
        <div class="table-exchange-rate">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'           => 'forum-message-grid',
                'dataProvider' => $topic->getMessages(),
                'enableSorting' => false,
                'template' => '{items}{pager}',
                'pager'=>array(
                    'header' => '',
                    'htmlOptions' => array(
                        'style' => 'float: right; margin-top: 8px;'
                    ),
                ),
                'htmlOptions' => array(
                    'class' => 'display',
                ),
                'columns'      => array(
                    array(
                        'name'  => 'user_id',
                        'value' => '$data->getUserNickname()',
                    ),
                    array(
                        'name' => 'message',
                        'type' => 'ntext',
                    ),
                    'date',
                ),
            )); ?>
        </div>
    </div>
</div>