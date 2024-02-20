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

        if (!empty(ConfigureForm::getInstance()->enabled)) {
            $authClientCollection->setClient('microsoft', [
                'class' => MicrosoftAuth::class,
                'clientId' => ConfigureForm::getInstance()->clientId,
                'clientSecret' => ConfigureForm::getInstance()->clientSecret,
            ]);
        }
    }

}
