<?php foreach ($forums as $forum) {
    echo $this->renderPartial('_view', array('model' => $forum));
} ?>
