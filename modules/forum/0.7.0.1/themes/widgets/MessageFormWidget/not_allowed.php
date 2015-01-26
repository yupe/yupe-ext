<div class="alert alert-notice">
    <?php echo Yii::t('ForumModule.forum','Please, {login} or {register} for free to leave a message!', array(
    	'{login}' => CHtml::link(Yii::t('ForumModule.forum','login'), array('/user/account/login')),
    	'{register}' => CHtml::link(Yii::t('ForumModule.forum','register'), array('/user/account/registration'))
    ));?>	
</div>