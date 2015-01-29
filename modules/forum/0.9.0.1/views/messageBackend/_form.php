<?php
/**
 * Отображение для messageBackend/_form:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id'                     => 'forum-message-form',
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'type'                   => 'vertical',
    'htmlOptions'            => ['class' => 'well'],
]); ?>
<div class="alert alert-info">
    <?php echo Yii::t('ForumModule.forum', 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('ForumModule.forum', 'are required.'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-3">
        <?php echo $form->dropDownListGroup(
            $model,
            'topic_id',
            [
                'widgetOptions' => [
                    'data'        => ForumTopic::model()->getFormattedList(),
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('topic_id'),
                        'data-content'        => $model->getAttributeDescription('topic_id'),
                        'empty' => Yii::t('ForumModule.forum', '--no--')
                    ],
                ],
            ]
        ); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->dropDownListGroup(
            $model,
            'user_id',
            [
                'widgetOptions' => [
                    'data'        => $model->getUserList(),
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('user_id'),
                        'data-content'        => $model->getAttributeDescription('user_id'),
                        'empty' => Yii::t('ForumModule.forum', '--no--')
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 form-group popover-help"
         data-original-title='<?php echo $model->getAttributeLabel('message'); ?>'
         data-content='<?php echo $model->getAttributeDescription(
             'message'
         ); ?>'>
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php
        $this->widget(
            $this->module->getVisualEditor(),
            [
                'model'     => $model,
                'attribute' => 'message',
            ]
        ); ?>
    </div>
</div>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create message and continue') : Yii::t(
                'ForumModule.forum',
                'Save message and continue'
            ),
    ]
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create message and close') : Yii::t(
                'ForumModule.forum',
                'Save message and close'
            ),
    ]
); ?>

<?php $this->endWidget(); ?>
