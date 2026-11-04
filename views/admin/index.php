<?php

use humhub\widgets\bootstrap\Button;
use humhub\widgets\bootstrap\Link;
use humhub\widgets\form\ActiveForm;
use humhubContrib\auth\microsoft\models\ConfigureForm;

/* @var $model ConfigureForm */
?>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Yii::t('AuthMicrosoftModule.base', '<strong>Microsoft</strong> Sign-In configuration') ?></div>

        <div class="panel-body">
            <p>
                <?= Link::primary(Yii::t('AuthMicrosoftModule.base', 'Microsoft Documentation'))
                    ->link('https://docs.microsoft.com/en-us/azure/active-directory/develop/active-directory-v2-protocols#app-registration')
                    ->blank()->loader(false)
                    ->right()->sm() ?>
                <?= Yii::t('AuthMicrosoftModule.base', 'Please follow the instructions to create the required <strong>client</strong> credentials.'); ?>
                <br/>
            </p>
            <br/>

            <?php $form = ActiveForm::begin(['id' => 'configure-form', 'enableClientValidation' => false, 'enableClientScript' => false]); ?>

            <?= $form->field($model, 'enabled')->checkbox(); ?>

            <br/>
            <?= $form->field($model, 'clientId'); ?>
            <?= $form->field($model, 'clientSecret'); ?>
            <?= $form->field($model, 'tenantId'); ?>

            <br/>
            <?= $form->field($model, 'redirectUri')->textInput(['readonly' => true]); ?>
            <br/>

            <?= Button::save()->submit() ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
