<?php

namespace humhubContrib\auth\microsoft\authclient;

use Yii;
use yii\authclient\clients\Live;

/**
 * MicrosoftAuth allows authentication via Microsoft OAuth.
 */
class MicrosoftAuth extends Live
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://login.microsoftonline.com/common/oauth2/v2.0/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://graph.microsoft.com';

    /**
     * @var string|null Directory (tenant) ID or domain. If set, only users of this organization can sign in.
     */
    public $tenantId;

    /**
     * @inheritdoc
     */
    public $accessTokenLocation = self::ACCESS_TOKEN_LOCATION_HEADER;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->scope === null) {
            $this->scope = implode(' ', [
                'email',
                'openid',
                'profile',
            ]);
        }

        if ($this->tenantId !== null && trim($this->tenantId) !== '') {
            $tenant = rawurlencode(trim($this->tenantId));
            $this->authUrl = str_replace('/common/', '/' . $tenant . '/', $this->authUrl);
            $this->tokenUrl = str_replace('/common/', '/' . $tenant . '/', $this->tokenUrl);
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $attributes = $this->api('/oidc/userinfo', 'POST');

        $username = (string)($attributes['name'] ?? '');
        if (trim($username) === '' && !empty($attributes['email'])) {
            $username = (string)strstr($attributes['email'], '@', true);
        }
        $username = preg_replace('/[^\p{L}\d_\-@.]+/u', '.', $username);
        $username = mb_substr(trim($username, '.'), 0, Yii::$app->getModule('user')->maximumUsernameLength);
        if ($username !== '') {
            $attributes['username'] = $username;
        }

        return $attributes;
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'microsoft';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Microsoft';
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-windows',
            'buttonBackgroundColor' => '#e0492f',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'sub',
            'firstname' => 'given_name',
            'lastname' => 'family_name',
            'email' => 'email',
        ];
    }
}
