<?php

namespace humhubContrib\auth\microsoft;

use humhub\components\Event;
use humhub\modules\user\authclient\Collection;
use humhubContrib\auth\microsoft\authclient\MicrosoftAuth;
use humhubContrib\auth\microsoft\models\ConfigureForm;

class Events
{
    /**
     * @param Event $event
     */
    public static function onAuthClientCollectionInit($event)
    {
        /** @var Collection $authClientCollection */
        $authClientCollection = $event->sender;

        $tenantId = ConfigureForm::getInstance()->directoryId;
        if($tenantId){
            $authUrl = "https://login.microsoftonline.com/".(ConfigureForm::getInstance()->directoryId)."/oauth2/v2.0/authorize";
            $tokenUrl = "https://login.microsoftonline.com/".(ConfigureForm::getInstance()->directoryId)."/oauth2/v2.0/token";
        } else {
            $authUrl = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize";
            $tokenUrl = "https://login.microsoftonline.com/common/oauth2/v2.0/token";
        }

        if (!empty(ConfigureForm::getInstance()->enabled)) {
            $authClientCollection->setClient('microsoft', [
                'class' => MicrosoftAuth::class,
                'authUrl' => $authUrl,
                'tokenUrl' => $tokenUrl,
                'clientId' => ConfigureForm::getInstance()->clientId,
                'clientSecret' => ConfigureForm::getInstance()->clientSecret,
                'returnUrl' => \Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/external?authclient=microsoft'])
            ]);
        }
    }

}
