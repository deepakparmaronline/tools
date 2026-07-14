<?php

if (!defined('ABSPATH')) {
    exit;
}

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

class Hostinger_Blog_Theme_Updates
{
    private const DEFAULT_THEME_UPDATE_URI = 'https://wp-update.hostinger.io/?action=get_metadata&slug=hostinger-blog';
    private const CANARY_THEME_UPDATE_URI = 'https://wp-update-canary.hostinger.io/?action=get_metadata&slug=hostinger-blog';
    private const STAGING_THEME_UPDATE_URI = 'https://wp-update-stage.hostinger.io/?action=get_metadata&slug=hostinger-blog';

    /**
     * @return string
     */
	private function get_plugin_update_uri(): string {
		if ( isset( $_SERVER['H_STAGING'] ) && filter_var( $_SERVER['H_STAGING'],FILTER_VALIDATE_BOOLEAN ) === true ) {
			return self::STAGING_THEME_UPDATE_URI;
		}

		if ( isset( $_SERVER['H_CANARY'] ) && filter_var( $_SERVER['H_CANARY'],FILTER_VALIDATE_BOOLEAN ) === true ) {
			return self::CANARY_THEME_UPDATE_URI;
		}

		return self::DEFAULT_THEME_UPDATE_URI;
	}

    /**
     * @return void
     */
    public function get_updates(): void
    {
        $plugin_updater_uri = $this->get_plugin_update_uri();

        if (class_exists(PucFactory::class)) {
            $hts_update_checker = PucFactory::buildUpdateChecker(
                $plugin_updater_uri,
                get_stylesheet_directory() . '/functions.php',
                'hostinger-blog-theme'
            );
        }
    }
}

$updates = new Hostinger_Blog_Theme_Updates();
$updates->get_updates();


