<?php
/**
 * Виджет отрисовки формы для добавления сообщения
 *
 * @category YupeWidget
 * @package  yupe.modules.forum.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.7.0.1
 * @link     http://yupe.ru
 *
 **/
class MessageFormWidget extends yupe\widgets\YWidget
{
    public $topic;
    public $view = 'form';

    public function init()
    {
        if(!$this->topic) {
            throw new CException('Error "MessageFormWidget::topic" is not set!');
        }

        parent::init();
    }

    public function run()
    {
        if($this->topic->status == ForumTopic::STATUS_OPEN)
        {
            $message = new ForumMessage();

            if(!Yii::app()->user->isAuthenticated()) {
                $this->view = 'not_allowed';
            }

            $this->render($this->view, array('message' => $message));
        }
    }
}