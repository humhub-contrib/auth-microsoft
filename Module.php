<?php

namespace humhubContrib\auth\live;

use yii\helpers\Url;

/**
 * @inheritdoc
 */
class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/auth-live/admin']);
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
