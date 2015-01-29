<h2>
    <small><?php echo $data->title; ?></small>
</h2>

<?php echo $this->renderPartial('_viewForum', ['forums' => $data->getForums()]); ?>
<?php echo $this->renderPartial('_viewTopic', ['topics' => $data->getTopics()]); ?>
