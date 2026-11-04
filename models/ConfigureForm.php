<?php

namespace humhubContrib\auth\microsoft\models;

use humhubContrib\auth\microsoft\Module;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * The module configuration model
 */
class ConfigureForm extends Model
{
    /**
     * @var bool Enable this authclient
     */
    public $enabled;

    /**
     * @var string the client id provided by Microsoft (Azure application id)
     */
    public $clientId;

    /**
     * @var string the client secret provided by Microsoft (Azure application secret)
     */
    public $clientSecret;

    /**
     * @var string|null optional directory (tenant) ID or domain to restrict sign-in to one organization
     */
    public $tenantId;

    /**
     * @var string readonly
     */
    public $redirectUri;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'clientSecret'], 'required', 'when' => fn() => (bool)$this->enabled],
            [['enabled'], 'boolean'],
            ['tenantId', 'trim'],
            ['tenantId', 'match', 'pattern' => '/^[a-zA-Z0-9.\-]+$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enabled' => Yii::t('AuthMicrosoftModule.base', 'Enabled'),
            'clientId' => Yii::t('AuthMicrosoftModule.base', 'Client ID'),
            'clientSecret' => Yii::t('AuthMicrosoftModule.base', 'Client secret'),
            'tenantId' => Yii::t('AuthMicrosoftModule.base', 'Tenant ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'tenantId' => Yii::t('AuthMicrosoftModule.base', 'Optional. Directory (tenant) ID or domain of your organization. If set, only users of this organization can sign in. Users of other organizations and personal Microsoft accounts, including already registered ones, will not be able to sign in with Microsoft. Leave empty to allow all accounts.'),
        ];
    }

    /**
     * Loads the current module settings
     */
    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('auth-microsoft');

        $settings = $module->settings;

        $this->enabled = (bool)$settings->get('enabled');
        $this->clientId = $settings->get('clientId');
        $this->clientSecret = $settings->get('clientSecret');
        $this->tenantId = $settings->get('tenantId');

        $this->redirectUri = Url::to(['/user/auth/microsoft'], true);
    }

    /**
     * Saves module settings
     */
    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('auth-microsoft');

        $module->settings->set('enabled', (bool)$this->enabled);
        $module->settings->set('clientId', $this->clientId);
        $module->settings->set('clientSecret', $this->clientSecret);
        $module->settings->set('tenantId', $this->tenantId);

        return true;
    }

    /**
     * Returns a loaded instance of this configuration model
     */
    public static function getInstance()
    {
        $config = new static();
        $config->loadSettings();

        return $config;
    }

}
