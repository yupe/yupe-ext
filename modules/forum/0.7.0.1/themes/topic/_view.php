<?php
$forums = $model->getForums();
$topics = $model->getTopics();
?>

<div class="tab-block">
    <ul class="tabset">
        <li class="active"><a><?php echo $model->title; ?></a></li>
    </ul>
    <div class="tab-content" id="tab-7">
        <?php if ( !empty($forums) ) echo $this->renderPartial('_viewForum', array('forums' => $forums)); ?>
        <?php if ( !empty($forums) && !empty($topics) ) : ?>
            <div style="height: 5px; background-color: #d1d1cb;"></div>
        <?php endif; ?>
        <?php if ( !empty($topics) ) echo $this->renderPartial('_viewTopic', array('topics' => $topics)); ?>
    </div>
</div>