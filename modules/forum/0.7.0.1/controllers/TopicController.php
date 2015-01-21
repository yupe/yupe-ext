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
        $topic = ForumTopic::model()->open()->findByAttributes(array(
            'alias' => $alias,
        ));

        if ($topic === null){
           throw new CHttpException(404, Yii::t('ForumModule.forum', 'Page was not found!'));
        }

        $this->render('show', array('topic' => $topic));
    }
}