<?php
echo CHtml::beginForm(array('/zendsearch/search/search'), 'post', array('style' => 'inline')) .
        CHtml::textField('q', '', array('placeholder' => 'Поиск...', 'class' => '')) .
        CHtml::submitButton('', array('class'=>'btn')) .
        CHtml::endForm('');
?>