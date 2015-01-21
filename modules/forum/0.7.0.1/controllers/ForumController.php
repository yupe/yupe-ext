<?php
/**
 * ForumController контроллер для форума на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.forum.controllers
 * @since 0.1
 *
 */
class ForumController extends yupe\components\controllers\FrontController
{
    /**
     * Выводит список форумов
     *
     * @return void
     */
    public function actionIndex()
    {       
        $forums = Forum::model()->open()->findAllByAttributes(array(
            'parent_id' => NULL,
        ));
        $this->render('index', array('forums' => $forums));
    }

    /**
     * Отобразить карточку форума
     *
     * @param string $alias - url форума
     * @throws CHttpException
     *
     * @return void
     */
    public function actionShow($alias = null)
    {
        $forum = Forum::model()->open()->findByAttributes(array(
            'alias' => $alias,
        ));

        if ($forum === null){
           throw new CHttpException(404, Yii::t('ForumModule.forum', 'Page was not found!'));
        }

        $this->render('show', array('forum' => $forum));
    }
}