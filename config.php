<?php

use humhub\modules\user\authclient\Collection;

return [
    'id' => 'auth-live',
    'class' => 'humhubContrib\auth\live\Module',
    'namespace' => 'humhubContrib\auth\live',
    'events' => [
        [Collection::class, Collection::EVENT_AFTER_CLIENTS_SET, ['humhubContrib\auth\live\Events', 'onAuthClientCollectionInit']]
    ],
];
