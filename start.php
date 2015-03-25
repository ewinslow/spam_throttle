<?php

namespace MBeckett\Spam\Throttle;

const PLUGIN_ID = 'spam_throttle';
const PLUGIN_VERSION = 20150323;

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/hooks.php';
require_once __DIR__ . '/events.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init(){
	elgg_register_library(PLUGIN_ID . ':upgrades', __DIR__ . '/lib/upgrades.php');
	
	elgg_register_event_handler('create', 'all', __NAMESPACE__ . '\\create_check');
	
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', __NAMESPACE__ . '\\hover_menu', 1000);
	
	//register action to save our plugin settings
	elgg_register_action("spam_throttle/settings/save", __DIR__ . "/actions/spam_throttle_settings.php", 'admin');
	elgg_register_action("spam_throttle/unsuspend", __DIR__ . "/spam_throttle/actions/unsuspend.php", 'admin');
	
	elgg_register_event_handler('upgrade', 'system', __NAMESPACE__ . '\\upgrades');
}
