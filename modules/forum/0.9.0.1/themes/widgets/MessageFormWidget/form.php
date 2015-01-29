<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'          => 'topic-message-form',
        'type'        => 'vertical',
        'htmlOptions' => [
            'class' => 'well',
        ]
    ]
); ?>

<?php echo $form->errorSummary($message); ?>

<div class='row'>
    <div class="col-sm-12">
        <?php echo $form->textAreaGroup($message, 'message'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-primary" type="submit">
            <i class="glyphicon glyphicon-comment"></i>
            <?php echo Yii::t('ForumModule.forum','Write a message'); ?>
        </button>
    </div>
</div>

<?php $this->endWidget(); ?>