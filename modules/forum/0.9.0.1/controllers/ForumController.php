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
        $forums = new Forum('search');
        $forums->unsetAttributes();
        $forums->parent_id = [NULL];
        $forums->status = Forum::STATUS_OPEN;

        $this->render('index', ['forums' => $forums]);
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
        $forum = Forum::model()->open()->findByAttributes([
            'alias' => $alias,
        ]);

        if ($forum === null){
           throw new CHttpException(404, Yii::t('ForumModule.forum', 'Page was not found!'));
        }

        $this->render('show', ['forum' => $forum]);
    }
}