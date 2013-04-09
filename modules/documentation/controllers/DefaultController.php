<?php

class DefaultController extends YBackController
{
	public function actionIndex()
	{

		$this->render('index', array('files' => explode(',', $this->module->files)));
	}
}