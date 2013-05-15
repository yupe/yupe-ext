<?php

class DefaultController extends YBackController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    /*
    *Функция возвращает json ответ для плагина dynatree
    */
    public function actionInit($key)
    {
        $dir = $key;
        if ($handle = opendir($dir)) {
            $dirs = array();
            $files = array();
            while (false !== ($entry = readdir($handle))) {
                if ($entry{0} == '.') {
                    continue;
                }
                if (is_dir($dir . '/' . $entry)) {
                    /*Массив директорий*/
                    $dirs[] = array(
                        'title' => $entry,
                        'isFolder' => true,
                        'isLazy' => true,
                        'url' => $dir . '/' . $entry
                    );
                } else {
                    /*Массив файлов*/
                    $files[] = array('title' => $entry, 'url' => $dir . '/' . $entry);
                }
            }
        }
        sort($dirs);
        sort($files);
        $output = array_merge($dirs, $files);
        if (Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode($output);
            Yii::app()->end();
        }
    }

    /* Получаем контент файла*/
    public function actiongetFileContent($key)
    {
        $fcontent = file_get_contents($key);
        if (Yii::app()->request->isAjaxRequest) {
            /*избегаем повторной загрузки скриптов*/
            Yii::app()->clientScript->scriptMap['*.js'] = false;
            Yii::app()->clientScript->scriptMap['*.css'] = false;
            $this->renderPartial('_form', array('fcontent' => $fcontent, 'path' => $key), false, true);
        }
    }

    /*Сохраняем изменения в файл*/
    public function actionUpdateFile()
    {
        $content = Yii::app()->request->getPost('codemirror');
        $file = Yii::app()->request->getPost('path');
        if (!$file || !file_exists($file) || !is_writable($file)) {
            Yii::app()->ajax->failure(Yii::t('Sourceeditor.files', 'Файл не найден или запись невозможна!'));
        } else {
            if(file_put_contents($file, $content)){
                Yii::app()->ajax->success(Yii::t('Sourceeditor.files', 'Файл сохранен!'));
            }
        }
    }
}