<?php
/**
 * ForumBackendController контроллер для управления форумами в панели управления
 *
 * @author    yupe team <team@yupe.ru>
 * @link      http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package   yupe.modules.forum.controllers
 * @version   0.7.1
 *
 */

class ForumBackendController extends yupe\components\controllers\BackController
{
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'Forum',
                'validAttributes' => ['title', 'alias', 'status']
            ]
        ];
    }

    /**
     * Отображает форум по указанному идентификатору
     *
     * @param integer $id Идинтификатор форума для отображения
     * @return void
     */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    /**
     * Создает новую модель Форума.
     * Если создание прошло успешно - перенаправляет на просмотр.
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Forum;

        if (($data = Yii::app()->getRequest()->getPost('Forum')) !== null) {

            $model->setAttributes($data);

            if ($model->save()) {

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('ForumModule.forum', 'Record was created!')
                );

                $this->redirect(
                    (array) Yii::app()->getRequest()->getPost(
                        'submit-type', ['create']
                    )
                );
            }
        }

        $this->render('create', ['model' => $model]);
    }

     /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     * @return void
     */
    public function actionUpdate($id)
    {
        // Указан ID форума, редактируем только ее
        $model = $this->loadModel($id);

        if (($data = Yii::app()->getRequest()->getPost('Forum')) !== null)
        {

            $model->setAttributes(Yii::app()->getRequest()->getPost('Forum'));

			if ($model->save()) {

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('ForumModule.forum', 'Record was changed!')
                );

                $this->redirect(
                    (array) Yii::app()->getRequest()->getPost(
                        'submit-type', [
                            'update',
                            'id' => $model->id,
                        ]
                    )
                );
            }
        }

        $this->render('update', ['model' => $model]);
    }

    /**
     * Удаляет модель форума из базы.
     * Если удаление прошло успешно - возвращется в index
     *
     * @param integer $id идентификатор категории, который нужно удалить
     * @return void
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        //TODO при удалении форума, блокировать удаление если есть потомки
        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $transaction = Yii::app()->db->beginTransaction();

            try {
                // поддерживаем удаление только из POST-запроса
                $this->loadModel($id)->delete();
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

                $transaction->commit();

                if (is_null(Yii::app()->getRequest()->getQuery('ajax'))) {
                    Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('ForumModule.forum', 'Record was deleted!')
                    );
                    $this->redirect(
                        (array) Yii::app()->getRequest()->getPost('returnUrl', 'index')
                    );
                }
            } catch(Exception $e) {
                $transaction->rollback();

                Yii::log($e->__toString(), CLogger::LEVEL_ERROR);
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    $e->getMessage()
                );
                $this->redirect(
                    (array) Yii::app()->getRequest()->getPost('returnUrl', 'index')
                );
            }

        } else {
            throw new CHttpException(
                400,
                Yii::t('ForumModule.forum', 'Bad request. Please don\'t use similar requests anymore')
            );
        }
    }

    /**
     * Управление форумами.
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Forum('search');
        $model->unsetAttributes();

        if (!is_null(Yii::app()->getRequest()->getQuery('Forum'))) {
            $model->attributes = Yii::app()->getRequest()->getQuery('Forum');
        }

        $this->render('index', ['model' => $model]);
    }

    /**
     * Возвращает модель по указанному идентификатору
     * Если модель не будет найдена - возникнет HTTP-исключение.
     *
     * @param integer идентификатор нужной модели
     * @return Forum $model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Forum::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('ForumModule.forum', 'Page was not found!'));
        return $model;
    }

    /**
     * Производит AJAX-валидацию
     *
     * @param CModel модель, которую необходимо валидировать
     * @return void
     */
    /*protected function performAjaxValidation(Forum $model)
    {
        if (Yii::app()->getRequest()->getIsAjaxRequest() && Yii::app()->getRequest()->getPost('ajax') === 'forum-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }*/
}