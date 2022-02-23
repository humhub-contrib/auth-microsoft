<?php

namespace humhubContrib\auth\live;

use humhub\components\Event;
use humhub\modules\user\authclient\Collection;
use humhubContrib\auth\live\authclient\LiveAuth;
use humhubContrib\auth\live\models\ConfigureForm;
use yii\helpers\Url;

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
            $authClientCollection->setClient('live', [
                'class' => LiveAuth::class,
                'clientId' => ConfigureForm::getInstance()->clientId,
                'clientSecret' => ConfigureForm::getInstance()->clientSecret,
            ]);
        }
    }

}
