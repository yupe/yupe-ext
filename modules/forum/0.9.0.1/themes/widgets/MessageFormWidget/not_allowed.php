<div class="alert alert-notice">
    <?php echo Yii::t(
        'ForumModule.forum',
        'Please, {login} or {register} for free to leave a message!',
        [
            '{login}' => CHtml::link(Yii::t('ForumModule.forum','login'), ['/user/account/login']),
            '{register}' => CHtml::link(Yii::t('ForumModule.forum','register'), ['/user/account/registration'])
        ]
    );?>
</div>