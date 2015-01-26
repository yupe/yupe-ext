<?php
/**
 * TopicController контроллер для темы на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.forum.controllers
 * @since 0.1
 *
 */
class TopicController extends yupe\components\controllers\FrontController
{
    /**
     * Отобразить карточку темы
     *
     * @param string $alias - url темы
     * @throws CHttpException
     *
     * @return void
     */
    public function actionShow($alias = null)
    {
        $topic = ForumTopic::model()->findByAttributes(array(
            'alias' => $alias,
        ));

        if ($topic === null){
           throw new CHttpException(404, Yii::t('ForumModule.forum', 'Page was not found!'));
        }

        if (($data = Yii::app()->getRequest()->getPost('ForumMessage')) !== null)
        {
            $model = new ForumMessage;
            $model->setAttributes($data);
            $model->topic_id = $topic->id;
            $model->user_id = Yii::app()->user->id;

            if ($model->save()) {

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    'Сообщение добавлено'
                );

                $this->redirect(
                    Yii::app()->createUrl($this->getRoute(), array('alias' => $topic->alias))
                );
            }
        }

        $this->render('show', array('topic' => $topic));
    }
}