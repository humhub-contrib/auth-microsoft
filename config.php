<?php

use humhub\modules\user\authclient\Collection;

return [
    'id' => 'auth-microsoft',
    'class' => 'humhubContrib\auth\microsoft\Module',
    'namespace' => 'humhubContrib\auth\microsoft',
    'events' => [
        [Collection::class, Collection::EVENT_AFTER_CLIENTS_SET, ['humhubContrib\auth\microsoft\Events', 'onAuthClientCollectionInit']]
    ]
];
