<?php

namespace humhubContrib\auth\microsoft\authclient;

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
     * @inheritdoc
     */
    public function init()
    {
        if ($this->scope === null) {
            $this->scope = implode(' ', [
                'email',
                'openid',
                'profile'
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('/oidc/userinfo', 'POST');
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
            'id' => function($attributes) {
                return $attributes['sub'];
            },
            'username' => 'displayName',
            'firstname' => function ($attributes) {
                if (!isset($attributes['given_name'])) {
                    return '';
                }

                return $attributes['given_name'];
            },
            'lastname' => function ($attributes) {
                if (!isset($attributes['family_name'])) {
                    return '';
                }

                return $attributes['family_name'];
            },
            'title' => 'tagline',
            'email' => function ($attributes) {
                return $attributes['email'];
            },
        ];
    }
}
