<?php

namespace humhubContrib\auth\live\authclient;

use yii\authclient\clients\Live;

/**
 * LiveAuth allows authentication via Microsoft Live OAuth.
 */
class LiveAuth extends Live
{
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
            'username' => 'displayName',
            'firstname' => function ($attributes) {
                if (!isset($attributes['first_name'])) {
                    return '';
                }

                return $attributes['first_name'];
            },
            'lastname' => function ($attributes) {
                if (!isset($attributes['last_name'])) {
                    return '';
                }

                return $attributes['last_name'];
            },
            'title' => 'tagline',
            'email' => function ($attributes) {
                return $attributes['emails']['account'];
            },
        ];
    }
}
