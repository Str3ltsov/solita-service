<?php

return [
    'cookie_key' => '__cookie_consent',
    'cookie_value_analytics' => '2',
    'cookie_value_marketing' => '3',
    'cookie_value_both' => 'all',
    'cookie_value_none' => 'mandatory',
    'cookie_expiration_days' => '365',
    'gtm_event' => 'cookie_refresh',
    'ignored_paths' => [],
    'policy_url_en' => env('COOKIE_POLICY_URL_EN', null),
    'policy_url_lt' => env('COOKIE_POLICY_URL_lt', null),
];
