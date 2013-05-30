<!--Инициализация Codemirror, c registerscript чет не захотел работать-->
<script type="text/javascript">
    $(function () {
        var editor  = CodeMirror.fromTextArea(document.getElementById("codemirror"), {
            lineNumbers: true,
            matchBrackets: true,
            lineWrapping: true,
            mode: "application/x-httpd-php",
            indentUnit: 4,
            indentWithTabs: true,
            enterMode: "keep",
            tabMode: "shift"
        });

        $('#<?php echo md5($path).time() ?>').live('click',function(){
            editor.save();
            $.post('/sourceeditor/default/updatefile',$('#cd-form').serialize(),function(response){
                if(response.result){
                    $('div.alert').addClass('alert-success');
                }else{
                    $('div.alert').addClass('alert-error');
                }
                $('#flash-msg').html(response.data);
                $("#flash").clearQueue().fadeIn(1000);
            },'json');
        });
    });
</script>

<div id="flash" class="flash"
     style="position: relative; min-width: 287px; float: right; top: -100px; left:314px; display: none; margin-left: -1000px;">
    <div class="alert">
        <a class="close" data-dismiss="alert">×</a>
        <b><span id='flash-msg'><span></b>
    </div>
</div>

<?php $form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'cd-form',
        'enableAjaxValidation' => false,
    )
); ?>
<?php echo CHtml::textArea('codemirror', $fcontent); ?>
<input type="hidden" id="path" name="path" value="<?php echo $path ?>">
<div style="position: relative; left: 27px; top: 23px;">
    <?php echo CHtml::button(Yii::t('Sourceeditor.files', 'Сохранить файл'),array('id' => md5($path).time(),'class' => 'btn btn-primary'));?>
<?php $this->endWidget(); ?>
