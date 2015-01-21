<div class="table-exchange-rate">
    <table class="display" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <th>Форумы</th>
            <th>Тем</th>
            <th>Сообщений</th>
            <th>Последнее сообщение</th>
        </tr>
        <?php foreach($forums as $forum)
        {
            ?><tr>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('/forum/forum/show', array('alias' => $forum->alias )); ?>" style="text-decoration: none; display: block;">
                        <?php echo $forum->title; ?>
                    </a>
                </td>
                <td width="100">
                    <?php echo $forum->topicCount; ?>
                </td>
                <td width="100">
                    <?php echo $forum->getTopicsMessageCount(); ?>
                </td>
                <td width="150">
                    <?php echo $this->renderPartial('_viewLastMessage', array('message' => $forum->getLastMessage())); ?>
                </td>
                </tr>
            <?php
        } ?>
        </tbody>
    </table>
</div>