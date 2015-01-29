<script type='text/javascript'>
    $(document).ready(function(){
        $('#forum-form').liTranslit({
            elName: '#Forum_title',
            elAlias: '#Forum_alias'
        });
    })
</script>

<?php
/**
 * Отображение для forumBackend/_form:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'forum-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => ['class' => 'well'],
    ]
); ?>
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
            'parent_id',
            [
                'widgetOptions' => [
                    'data'        => Forum::model()->getFormattedList(),
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('parent_id'),
                        'data-content'        => $model->getAttributeDescription('parent_id'),
                        'empty' => Yii::t('ForumModule.forum', '--no--'),
                        'encode' => false
                    ],
                ],
            ]
        ); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->dropDownListGroup(
            $model,
            'status',
            [
                'widgetOptions' => [
                    'data'        => $model->getStatusList(),
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content'        => $model->getAttributeDescription('status'),
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php
        echo $form->textFieldGroup(
            $model,
            'title',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('title'),
                        'data-content'        => $model->getAttributeDescription('title'),
                        'maxlength' => 250
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php
        echo $form->textFieldGroup(
            $model,
            'alias',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('alias'),
                        'data-content'        => $model->getAttributeDescription('alias'),
                        'maxlength' => 250
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 form-group popover-help"
         data-original-title='<?php echo $model->getAttributeLabel('description'); ?>'
         data-content='<?php echo $model->getAttributeDescription(
             'description'
         ); ?>'>
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php
        $this->widget(
            $this->module->getVisualEditor(),
            [
                'model'     => $model,
                'attribute' => 'description',
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
        'label'      => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create forum and continue') : Yii::t(
                'ForumModule.forum',
                'Save forum and continue'
            ),
    ]
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create forum and close') : Yii::t(
                'ForumModule.forum',
                'Save forum and close'
            ),
    ]
); ?>

<?php $this->endWidget(); ?>
