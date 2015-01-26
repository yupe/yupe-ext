<?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($message); ?>

    <?php echo CHtml::textArea('ForumMessage[message]', '',
        array(
            'style' => 'width: 450px; float: right; height: 100px;'
        )
    ); ?>

    <?php echo CHtml::submitButton('Написать сообщение',
        array(
            'class' => 'btn',
            'style' => 'width: 150px; float: right; margin-top: 5px;'
        )
    ); ?>

<?php echo CHtml::endForm(); ?>