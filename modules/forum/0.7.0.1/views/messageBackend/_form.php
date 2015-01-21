<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'forum-message-form',
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'type'                   => 'vertical',
    'htmlOptions'            => array('class' => 'well'),
    'inlineErrors'           => true,
)); ?>
<div class="alert alert-info">
    <?php echo Yii::t('ForumModule.forum', 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('ForumModule.forum', 'are required.'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class='control-group <?php echo $model->hasErrors("topic_id") ? "error" : ""; ?>'>
    <?php echo $form->dropDownListRow(
        $model,
        'topic_id',
        ForumTopic::model()->getFormattedList(),
        array('class' => 'span7', 'encode' => false)
    ); ?>
</div>

<div class='control-group <?php echo $model->hasErrors("user_id") ? "error" : ""; ?>'>
    <?php echo $form->dropDownListRow(
        $model,
        'user_id',
        $model->getUserList(),
        array('class' => 'span7')
    ); ?>
</div>

<div class="row-fluid control-group <?php echo $model->hasErrors('message') ? 'error' : ''; ?>">
    <div class="span12">
        <?php /*echo $form->labelEx($model, 'message'); ?>
        <?php $this->widget($this->yupe->editor, array(
            'model'       => $model,
            'attribute'   => 'message',
            'options'     => $this->module->editorOptions,
        ));*/ ?>
        <?php echo $form->textAreaRow(
            $model,
            'message',
            array(
                'rows' => 3,
                'cols' => 98,
                'class' => 'span7 popover-help',
                'data-original-title' => $model->getAttributeLabel('message'),
                'data-content' => $model->getAttributeDescription('message')
            )
        ); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>
</div>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type'       => 'primary',
    'label'      => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create message and continue') : Yii::t('ForumModule.forum', 'Save message and continue'),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'  => 'submit',
    'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
    'label'       => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create message and close') : Yii::t('ForumModule.forum', 'Save message and close'),
)); ?>

<?php $this->endWidget(); ?>
