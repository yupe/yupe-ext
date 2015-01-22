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
    <ul class="tabdef">
        <li class="active"><a>Сообщения</a></li>
    </ul>
    <div class="tab-content">
        <div class="table-list">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'           => 'topic-message-grid',
                'dataProvider' => ForumMessage::getMessages($topic->id),
                'enableSorting' => false,
                'template' => '{items}{pager}',
                'ajaxUpdate' => true,
                'pager'=>array(
                    'header' => '',
                    'maxButtonCount'=>'5',
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
                        'htmlOptions' => array('style' => 'width:50px'),
                        'value' => '$data->getUserNickname()',
                    ),
                    array(
                        'name' => 'message',
                        'type' => 'ntext',
                    ),
                    array(
                        'name' => 'date',
                        'htmlOptions' => array('style' => 'width:120px'),
                    )
                ),
            )); ?>
        </div>
    </div>
</div>

<div style="width: 500px;margin: 50px auto;">
    <?php $this->widget('application.modules.forum.widgets.MessageFormWidget'); ?>
</div>