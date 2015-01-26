<div class="table-exchange-rate">
    <table class="display" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <th>Темы</th>
            <th>Сообщений</th>
            <th>Последнее сообщение</th>
        </tr>
        <?php foreach($topics as $topic)
        {
            ?><tr>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('/forum/topic/show', array('alias' => $topic->alias )); ?>" style="text-decoration: none; display: block;">
                        <?php echo $topic->title; ?>
                        <?php if ( $topic->status == ForumTopic::STATUS_CLOSE ) : ?>
                            <br/><b>закрыт</b>
                        <?php endif; ?>
                    </a>
                </td>
                <td width="100">
                    <?php echo $topic->messageCount; ?>
                </td>
                <td width="150">
                    <?php echo $this->renderPartial('_viewLastMessage', array('message' => $topic->getLastMessage())); ?>
                </td>
                </tr>
            <?php
        } ?>
        </tbody>
    </table>
</div>