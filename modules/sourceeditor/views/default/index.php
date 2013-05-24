<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->getName(),
);
?>
<div class="page-header">
    <h1><?php echo $this->module->getName();?></h1>
</div>
<?php $path = Yii::app()->assetManager->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets');
Yii::app()->getClientScript()
    ->registerScriptFile($path . '/jquery/jquery-ui.custom.js')
    ->registerScriptFile($path . '/src/jquery.dynatree.js')
    ->registerScriptFile($path . '/lib/codemirror.js')
    ->registerScriptFile($path . '/addon/edit/matchbrackets.js')
    ->registerScriptFile($path . '/mode/javascript/javascript.js')
    ->registerScriptFile($path . '/mode/css/css.js')
    ->registerScriptFile($path . '/mode/xml/xml.js')
    ->registerScriptFile($path . '/mode/clike/clike.js')
    ->registerScriptFile($path . '/mode/php/php.js')
    ->registerCssFile($path . '/src/skin-vista/ui.dynatree.css')
    ->registerCssFile($path . '/lib/codemirror.css')
    ->registerCssFile($path . '/theme/elegant.css')
    ->registerScript(
        __CLASS__ . '#tree',
        '
                   $(function(){
                    $("#tree").dynatree({
                        autoFocus: false,
                        initAjax: {
                          url: "/sourceeditor/default/init",
                          data: {key: "./"}
                          },
                    onLazyRead: function(node){
                       node.appendAjax({
                          url: "/sourceeditor/default/init",
                        data: {key: node.data.url,},
                      });
                      },
                    onDblClick: function(node){
                        if(node.data.url)
                           $.ajax({
                           url: "/sourceeditor/default/getfilecontent",
                           data: {key: node.data.url},
                           success: function(data){
                            $("#fcontent").empty().append(data)
                           }
                           });
                    },
                });
            });
                   '
    );
?>

<div class="well" style="position: relative; float: right; left: 306px; margin-bottom: -1000px;">
    <div id="tree" style="width: 240px; height: 520px; overflow: hidden; border: 0;"></div>
</div>

<div class="well span12" id="fcontent" style="height: 560px;"></div>
