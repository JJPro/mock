<?php
/**
 * Author: Jason Ji
 * Github: https://github.com/JJPro
 */
namespace nucssa_core\inc;

/**
 * Manage all JS and CSS scripts used in the admin dashboard
 */
class AdminScripts
{
  public static function init($hook)
  {
    self::loadAdminScripts($hook);
    self::loadAdminStyles($hook);

    // load browserSync script for development
    self::enableBrowserSyncOnDebugMode();
  }

  private static function loadAdminScripts($hook)
  {
    if ($hook != 'toplevel_page_admin-menu-page-nucssa-core') {
      return;
    }

    $handle = 'nucssa_core_amdin_script';
    // load core script
    wp_enqueue_script(
      $handle,
      NUCSSA_CORE_DIR_URL . 'public/js/admin.js',
      [ 'wp-element' ], // deps
      WP_DEBUG ? time() : false, // version
      true // in_footer?
    );

    $base_rest_url = esc_url_raw( rest_url() );
    // localize core script with some vars
    wp_localize_script(
      $handle,
      'core_admin_data',
      array(
        'root_url' => get_site_url(),
        'rest_url' => $base_rest_url,
        'ldap_config_rest_url' => $base_rest_url . 'nucssa-core/v1/ldap-config',
        'permissions_rest_url' => $base_rest_url . 'nucssa-core/v1/permissions',
        'nonce' => wp_create_nonce('wp_rest'),
      )
    );


  }

  private static function loadAdminStyles($hook)
  {
    // NUCSSA Core Plugin Page only Styles
    if ($hook === 'toplevel_page_admin-menu-page-nucssa-core') {
      wp_enqueue_style(
        'nucssa_core_admin_plugin_page_style',
        NUCSSA_CORE_DIR_URL . 'public/css/admin-plugin-page.css',
        array(), // deps
        false,   // version
        'all'    // media
      );
    }

    // Global Styles
    wp_enqueue_style(
      'nucssa_core_admin_global_style',
      NUCSSA_CORE_DIR_URL . 'public/css/admin-global.css',
      array(), // deps
      false,   // version
      'all'    // media
    );
  }


  private static function enableBrowserSyncOnDebugMode()
  {
    if (WP_DEBUG) {
      wp_enqueue_script('browser-sync', 'http://localhost:3000/browser-sync/browser-sync-client.js', [], false, true);
    }
  }
}
