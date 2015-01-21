<script type='text/javascript'>
    $(document).ready(function(){
        $('#forum-topic-form').liTranslit({
            elName: '#ForumTopic_title',
            elAlias: '#ForumTopic_alias'
        });
    })
</script>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'forum-topic-form',
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

<div class='control-group <?php echo $model->hasErrors("forum_id") ? "error" : ""; ?>'>
    <?php echo $form->dropDownListRow(
        $model,
        'forum_id',
        Forum::model()->getFormattedList(),
        array('empty' => Yii::t('ForumModule.forum', '--no--'), 'class' => 'span7', 'encode' => false)
    ); ?>
</div>

<div class='control-group'>
    <?php echo $form->dropDownListRow($model, 'status', $model->getStatusList(), array('class' => 'span7')); ?>
</div>

<div class='control-group <?php echo $model->hasErrors("title") ? "error" : ""; ?>'>
    <?php echo $form->textFieldRow($model, 'title', array('class' => 'span7', 'maxlength' => 250)); ?>
</div>

<div class='control-group <?php echo $model->hasErrors("alias") ? "error" : ""; ?>'>
    <?php echo $form->textFieldRow($model, 'alias', array('class' => 'span7', 'maxlength' => 150)); ?>
</div>

<div class="row-fluid control-group <?php echo $model->hasErrors('description') ? 'error' : ''; ?>">
    <div class="span12">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php $this->widget($this->yupe->editor, array(
            'model'       => $model,
            'attribute'   => 'description',
            'options'     => $this->module->editorOptions,
        )); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
</div>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type'       => 'primary',
    'label'      => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create topic and continue') : Yii::t('ForumModule.forum', 'Save topic and continue'),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'  => 'submit',
    'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
    'label'       => $model->isNewRecord ? Yii::t('ForumModule.forum', 'Create topic and close') : Yii::t('ForumModule.forum', 'Save topic and close'),
)); ?>

<?php $this->endWidget(); ?>
