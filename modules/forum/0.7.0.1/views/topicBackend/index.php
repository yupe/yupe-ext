<?php
$this->breadcrumbs = array(
    Yii::t('ForumModule.forum', 'Forums') => array('/forum/forumBackend/index'),
    Yii::t('ForumModule.forum', 'Topics') => array('/forum/topicBackend/index'),
    Yii::t('ForumModule.forum', 'Manage'),
);

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

<?php $this->widget('yupe\widgets\CustomGridView', array(
    'id'           => 'forum-grid',
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
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name'  => 'title',
            'editable' => array(
                'url' => $this->createUrl('/forum/forumBackend/inline'),
                'mode' => 'inline',
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name'  => 'alias',
            'editable' => array(
                'url' => $this->createUrl('/forum/forumBackend/inline'),
                'mode' => 'inline',
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            )
        ),
        array(
            'name'  => 'forum_id',
            'value' => '$data->getForumTitle()',
            'filter' => CHtml::activeDropDownList($model, 'forum_id', Forum::model()->getFormattedList(), array('encode' => false, 'empty' => ''))
        ),
        array(
            'class'  => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'url'  => $this->createUrl('/forum/forumBackend/inline'),
                'mode' => 'popup',
                'type' => 'select',
                'source' => $model->getStatusList(),
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            ),
            'name'   => 'status',
            'type'   => 'raw',
            'value'  => '$data->getStatus()',
            'filter' => $model->getStatusList()
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>