<?php if ( !is_null($message) ) : ?>
    <?php echo $message->date; ?>
    <br/>
    <?php echo $message->user->nick_name; ?>
<?php else : ?>
    сообщений нет
<?php endif; ?>