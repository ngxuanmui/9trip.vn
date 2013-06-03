<?php

define('CFG_DEFAULT_NUMBER_OF_SLIDES', 9);

define('CFG_FACEBOOK_API_ID', 	'200592729969811');
define('CFG_FACEBOOK_API_SECRET','34149e04efd6b3513e29b20d94a48322');
define('CFG_FACEBOOK_ONLINE_CAMPAIGN_FB_LIKE', 'utm_source=fb-like-share&utm_medium=facebook&utm_content=via-social&utm_campaign=general-online-mkt');

define('CFG_DEFAULT_NUMBER_OF_OTHER_ITEMS', 5);

define('CFG_GOOGLE_MAP_API', 	'AIzaSyDG9QTLb37UFy2pxXyo5k6gz5eOt6ohrko');

$server = JRequest::get('server');

define('CFG_REQUEST_URI', 'http://' . $server['HTTP_HOST'].$server['REQUEST_URI']);

/* config limit for each type */
define('CFG_LIMIT_HOTELS', 5);
define('CFG_LIMIT_RESTAURANTS', 5);
define('CFG_LIMIT_TOURS', 5);
define('CFG_LIMIT_RELAXES', 5);
define('CFG_LIMIT_SHOPPINGS', 5);
define('CFG_LIMIT_SERVICES', 5);
define('CFG_LIMIT_DISCOVERS', 5);
define('CFG_LIMIT_PROMOTIONS', 12);
define('CFG_LIMIT_QUESTIONS', 5);
define('CFG_LIMIT_WARNINGS', 5);
define('CFG_LIMIT_ALBUMS', 5);