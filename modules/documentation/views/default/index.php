<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Документация'
);

?>

<div class="accordion" id="accordion2">
<?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse');?>

<?php foreach($files as $num => $file): ?>
	<div class="accordion-group">
	    <div class="accordion-heading">
	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $num;?>">
	            <?php echo $file; ?>
	        </a>
	    </div>
	    <div id="collapse<?php echo $num;?>" class="accordion-body collapse">
	        <div class="accordion-inner">
	            <?php $sourse = file($this->createAbsoluteUrl('/').'/'.$file); 
	            $this->beginWidget('CMarkdown');
	            foreach($sourse as $key => $value):
	            	 echo $value.'<br>';
	            endforeach;
	            $this->endWidget(); ?>
	        </div>
	    </div>
	</div>
<?php endforeach; ?>

<?php $this->endWidget();?>
</div>