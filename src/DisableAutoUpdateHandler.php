<?php
namespace Gwa\Wordpress\DisableAutoUpdate;

/**
 * A modern WordPress stack.
 *
 * @author      Daniel Bannert <bannert@greatwhiteark.com>
 * @copyright   2015 Great White Ark
 *
 * @link        http://www.greatwhiteark.com
 *
 * @license     MIT
 */

use Gwa\Wordpress\MockeryWpBridge\MockeryWpBridge;

/**
 * DisableAutoUpdateHandler.
 *
 * @author  GWA
 */
class DisableAutoUpdateHandler
{
    /**
     * MockeryWpBridge instance.
     *
     * @var \Gwa\Wordpress\MockeryWpBridge\MockeryWpBridge
     */
    protected $wpMockery;

    public function __construct() {
        $this->wpMockery = new MockeryWpBridge();
    }

    /**
     * Disable All Automatic Updates
     * 3.7+
     *
     * @author  sLa NGjI's @ slangji.wordpress.com
     */
    protected function disableWpAutoUpdate()
    {
        $this->wpMockery->addFilter('automatic_updater_disabled', '__return_true');

        $this->wpMockery->addFilter('allow_minor_auto_core_updates', '__return_false');
        $this->wpMockery->addFilter('allow_major_auto_core_updates', '__return_false');
        $this->wpMockery->addFilter('allow_dev_auto_core_updates', '__return_false');

        $this->wpMockery->addFilter('auto_update_core', '__return_false');
        $this->wpMockery->addFilter('wp_auto_update_core', '__return_false');
        $this->wpMockery->addFilter('send_core_update_notification_email', '__return_false');

        $this->wpMockery->addFilter('auto_update_translation', '__return_false');
        $this->wpMockery->addFilter('auto_core_update_send_email', '__return_false');
        $this->wpMockery->addFilter('auto_update_plugin', '__return_false');
        $this->wpMockery->addFilter('auto_update_theme', '__return_false');

        $this->wpMockery->addFilter('automatic_updates_send_debug_email', '__return_false');
        $this->wpMockery->addFilter('automatic_updates_is_vcs_checkout', '__return_true');
        $this->wpMockery->addFilter('automatic_updates_send_debug_email ', '__return_false', 1);

        if (!defined('AUTOMATIC_UPDATER_DISABLED')) {
            define('AUTOMATIC_UPDATER_DISABLED', true);
        }

        if (!defined('WP_AUTO_UPDATE_CORE')) {
            define('WP_AUTO_UPDATE_CORE', false);
        }
    }

    /**
     * Check the outgoing request
     */
    public function blockWpRequest($pre, $args, $url)
    {
        if (empty($url)) {
            return $pre;
        }

        /* Invalid host */
        if (!$host = $this->wpMockery->parseUrl($url, PHP_URL_HOST)) {
            return $pre;
        }

        $urlData = $this->wpMockery->parseUrl($url);

        /* block request */
        $path =  (false !== stripos($urlData['path'], 'update-check') || false !== stripos($urlData['path'], 'browse-happy'));

        if (false !== stripos($host, 'api.wordpress.org') && $path) {
            return true;
        }

        return $pre;
    }

    /**
     * Hide all noctices in wp-admin
     */
    protected function hideAdminNag()
    {
        if (!function_exists("remove_action")) {
            return;
        }

        /**
         * Hide maintenance and update nag
         */
        $this->wpMockery->removeAction('admin_notices', 'update_nag', 3);
        $this->wpMockery->removeAction('network_admin_notices', 'update_nag', 3);
        $this->wpMockery->removeAction('admin_notices', 'maintenance_nag');
        $this->wpMockery->removeAction('network_admin_notices', 'maintenance_nag');

        $this->wpMockery->removeAction('wp_maybe_auto_update', 'wp_maybe_auto_update');
        $this->wpMockery->removeAction('admin_init', 'wp_maybe_auto_update');
        $this->wpMockery->removeAction('admin_init', 'wp_auto_update_core');

        $this->wpMockery->wpClearScheduledHook('wp_maybe_auto_update');
    }

    /**
     * init
     */
    public function init()
    {
        $this->disableWpAutoUpdate();

        $this->wpMockery->addFilter('pre_http_request', [$this, 'blockWpRequest'], 10, 3);

        $this->hideAdminNag();
    }
}
