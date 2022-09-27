<?php

namespace humhubContrib\auth\microsoft;

use humhub\libs\DynamicConfig;
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
        return Url::to(['/auth-microsoft/admin']);
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

    public function init() {
        parent::init();

        $config = DynamicConfig::load();
        $rule = [
            'class' => 'yii\web\UrlRule',
            //'pattern' => '/user/auth/microsoft',
            'pattern' => '/user/auth/external?authclient=microsoft',
            'route' => '/user/auth/external',
            'defaults' => [
                'authclient' => 'microsoft'
            ]
        ];

        if(!array_key_exists('urlManager', $config['components']) || !array_key_exists('rules', $config['components']['urlManager']) ||!in_array($rule, $config['components']['urlManager']['rules'])) {
            DynamicConfig::merge(['components' => [
                'urlManager' => [
                    'showScriptName' => false,
                    'enablePrettyUrl' => true,
                    'rules' => [
                        $rule
                    ]
                ],
            ]]);
        }
    }
}
