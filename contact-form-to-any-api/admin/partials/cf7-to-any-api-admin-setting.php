<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Cf7_To_Any_Api
 * @subpackage Cf7_To_Any_Api/admin/partials
 */

$cf7anyapi_object = new Cf7_To_Any_Api();
$cf7anyapi_options = $cf7anyapi_object->setting_get_options();

// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$cf7anyapi_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';
if ( 'status' === $cf7anyapi_tab ) {?>
    <div class="wrap cf-settings-wrap cf-sys-status">
        <h1 class="wp-heading-inline"><?php esc_html_e( 'CF7 to Any API Settings', 'contact-form-to-any-api' ); ?></h1> 
        <h2 class="screen-reader-text"><?php esc_html_e( 'CF7 to Any API Settings ', 'contact-form-to-any-api' ); ?></h2>
        <nav class="nav-tab-wrapper cf-tab-wrapper">
            <a href="<?php echo esc_url(admin_url('edit.php?post_type=cf7_to_any_api&page=cf7anyapi_setting')); ?>" class="nav-tab"><?php esc_html_e( 'Settings', 'contact-form-to-any-api' ); ?></a>
            <a href="<?php echo esc_url(admin_url('edit.php?post_type=cf7_to_any_api&page=cf7anyapi_setting&tab=status')); ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'System Status', 'contact-form-to-any-api' ); ?></a>
        </nav>

        <div class="cfs-box">
            <div class="title-wrap">
                <h3><img src="<?php echo esc_url( plugin_dir_url( __DIR__ ).'images/check.png');?>" alt="key"><span><?php esc_html_e( 'System Status', 'contact-form-to-any-api' ); ?></span></h3>
            </div>
            <div class="status-wrap">
                <table class="table status-table widefat" width="100%">
                    <tbody>
                        <tr>
                            <td><?php esc_html_e( 'Site URL', 'contact-form-to-any-api' ); ?></td>
                            <td><?php echo esc_url(get_site_url()); ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e( 'PHP Version', 'contact-form-to-any-api' ); ?></td>
                            <td><?php echo esc_html(phpversion()); ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e( 'SSL Status', 'contact-form-to-any-api' ); ?></td>
                            <td><?php echo is_ssl() ? 'Enabled' : 'Disabled'; ?></td>
                        </tr> 
                        <tr>
                            <td><?php esc_html_e( 'Version', 'contact-form-to-any-api' ); ?></td>
                            <td><?php echo esc_html( CF7_TO_ANY_API_VERSION ); ?></td>
                        </tr> 
                        <tr>
                            <td><?php esc_html_e( 'WP version', 'contact-form-to-any-api' ); ?></td>
                            <td><?php echo esc_html(get_bloginfo('version') ); ?></td>
                        </tr> 
                        <tr>
                            <td><?php esc_html_e( 'REST API', 'contact-form-to-any-api' ); ?></td>
                            <td><?php echo function_exists( 'rest_get_server' ) ? 'Enabled' : 'Disabled'; ?></td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php 
}else{?>
    <div class="wrap cf-settings-wrap cf-settings">
        <h1 class="wp-heading-inline"><?php esc_html_e( 'CF7 to Any API Settings', 'contact-form-to-any-api' ); ?></h1> 
        <h2 class="screen-reader-text"><?php esc_html_e( 'CF7 to Any API Settings ', 'contact-form-to-any-api' ); ?></h2>
        <?php 
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if(isset($_GET["update-status"])): ?>
            <div class="notice notice-success is-dismissible">
                <p><?php echo esc_html('Settings saved successfully.' , 'contact-form-to-any-api'); ?></p>
            </div>
        <?php endif; ?>
        <nav class="nav-tab-wrapper cf-tab-wrapper">
            <a href="<?php echo esc_url(admin_url('edit.php?post_type=cf7_to_any_api&page=cf7anyapi_setting')); ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Settings', 'contact-form-to-any-api' ); ?></a>
            <a href="<?php echo esc_url(admin_url('edit.php?post_type=cf7_to_any_api&page=cf7anyapi_setting&tab=status')); ?>" class="nav-tab"><?php esc_html_e( 'System Status', 'contact-form-to-any-api' ); ?></a>     
        </nav>
        
        <div class="cfs-box">
            <div class="cf-head" bis_skin_checked="1">
                <div class="title-wrapper">
                    <span class="dashicons dashicons-admin-generic" style="margin-right: 8px;"></span><h3><?php echo esc_html( 'CF7 To Any API Settings', 'contact-form-to-any-api' );?></h3>
                </div>
            </div>        
            <div class="cf-settings">
                <hr>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="save_cf7_to_any_api_update_settings" />
                    <?php wp_nonce_field(-1,'save_cf7_to_any_api_update_settings' ); ?>
                    <div class="cf7_to_any_api_setting_form">
                        <table class="form-table" width="100%">
                            <tr>
                                <th scope="row"><?php echo esc_html('Would you like to make API call before mail sent ?','contact-form-to-any-api');?></th>
                                <td class="with-label">
                                    <input type="checkbox" name="cf7_to_api_before_mail_sent" id="cf7_to_api_before_mail_sent" value="1" <?php checked( ! empty( $cf7anyapi_options['cf7_to_api_before_mail_sent'] ) ); ?> />
                                    <label for="cf7_to_api_before_mail_sent"></label>
                                    <small><?php echo esc_html('Enable this option means plugin will fire API call before form submit CF7 Hook wpcf7_before_send_mail','contact-form-to-any-api');?></small>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html('Would you like to Disable logs ?','contact-form-to-any-api');?></th>
                                <td>
                                    <input type="checkbox" name="cf7_to_api_log_hide" id="cf7_to_api_log_hide" value="1" <?php checked( ! empty( $cf7anyapi_options['cf7_to_api_log_hide'] ) ); ?> />
                                    <label for="cf7_to_api_log_hide"></label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html('Would you like to Disable CF7 Entries ?','contact-form-to-any-api');?></th>
                                <td>
                                    <input type="checkbox" name="cf7_to_api_entry_hide" id="cf7_to_api_entry_hide" value="1" <?php checked( ! empty( $cf7anyapi_options['cf7_to_api_entry_hide'] ) ); ?>  />
                                    <label for="cf7_to_api_entry_hide"></label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Auto Delete Logs', 'contact-form-to-any-api' ); ?></th>
                                <td class="with-label">
                                    <input type="checkbox" name="cf7_to_api_auto_delete_logs" id="cf7_to_api_auto_delete_logs" value="1" <?php checked( ! empty( $cf7anyapi_options['cf7_to_api_auto_delete_logs'] ) ); ?> />
                                    <label for="cf7_to_api_auto_delete_logs"></label>
                                    <small><?php esc_html_e( 'Automatically delete API logs older than the specified number of days.', 'contact-form-to-any-api' ); ?></small>
                                </td>
                            </tr>
                            <tr class="cf7_to_api_auto_delete_days_row" <?php echo empty( $cf7anyapi_options['cf7_to_api_auto_delete_logs'] ) ? 'style="display:none;"' : ''; ?>>
                                <th scope="row"><?php esc_html_e( 'Auto Delete Logs After (Days)', 'contact-form-to-any-api' ); ?></th>
                                <td>
                                    <?php $cf7anyapi_auto_delete_days = ! empty( $cf7anyapi_options['cf7_to_api_auto_delete_days'] ) ? absint( $cf7anyapi_options['cf7_to_api_auto_delete_days'] ) : 90; ?>
                                    <input type="number" name="cf7_to_api_auto_delete_days" id="cf7_to_api_auto_delete_days" class="small-text" min="1" value="<?php echo esc_attr( $cf7anyapi_auto_delete_days ); ?>" />
                                    <p class="description"><?php esc_html_e( 'Log entries older than this many days will be automatically deleted. Default is 90 days.', 'contact-form-to-any-api' ); ?></p>
                                </td>
                            </tr>
                        </table>

                        <hr />
                        <div class="cf-head">
                            <div class="title-wrapper">
                                <span class="dashicons dashicons-email-alt" style="margin-right: 8px;"></span><h3><?php esc_html_e( 'Email Notification on API Failure', 'contact-form-to-any-api' ); ?></h3>
                            </div>
                        </div>
                        <table class="form-table" width="100%">
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Enable failure email alerts', 'contact-form-to-any-api' ); ?></th>
                                <td class="with-label">
                                    <input type="checkbox" name="cf7_to_api_failure_email_enable" id="cf7_to_api_failure_email_enable" value="1" <?php checked( ! empty( $cf7anyapi_options['cf7_to_api_failure_email_enable'] ) ); ?> />
                                    <label for="cf7_to_api_failure_email_enable"></label>
                                    <small><?php esc_html_e( 'Send an email notification when an API call returns a non-success (non-2xx) HTTP status code.', 'contact-form-to-any-api' ); ?></small>
                                </td>
                            </tr>
                            <tr class="cf7_to_api_failure_email_row" <?php echo empty( $cf7anyapi_options['cf7_to_api_failure_email_enable'] ) ? 'style="display:none;"' : ''; ?>>
                                <th scope="row"><?php esc_html_e( 'Notification email recipients', 'contact-form-to-any-api' ); ?></th>
                                <td>
                                    <input type="text" name="cf7_to_api_failure_email_recipients" id="cf7_to_api_failure_email_recipients" class="regular-text" value="<?php echo esc_attr( $cf7anyapi_options['cf7_to_api_failure_email_recipients'] ); ?>" placeholder="<?php echo esc_attr( get_option('admin_email') ); ?>" />
                                    <p class="description"><?php esc_html_e( 'Comma-separated email addresses. Defaults to the site admin email.', 'contact-form-to-any-api' ); ?></p>
                                </td>
                            </tr>
                            <tr class="cf7_to_api_failure_email_row" <?php echo empty( $cf7anyapi_options['cf7_to_api_failure_email_enable'] ) ? 'style="display:none;"' : ''; ?>>
                                <th scope="row"><?php esc_html_e( 'Email throttle interval', 'contact-form-to-any-api' ); ?></th>
                                <td>
                                    <?php $cf7anyapi_throttle_value = ! empty( $cf7anyapi_options['cf7_to_api_failure_email_throttle'] ) ? intval( $cf7anyapi_options['cf7_to_api_failure_email_throttle'] ) : 5; ?>
                                    <select name="cf7_to_api_failure_email_throttle" id="cf7_to_api_failure_email_throttle">
                                        <option value="0" <?php selected( $cf7anyapi_throttle_value, 0 ); ?>><?php esc_html_e( 'No Limit (send every time)', 'contact-form-to-any-api' ); ?></option>
                                        <option value="5" <?php selected( $cf7anyapi_throttle_value, 5 ); ?>><?php esc_html_e( '5 Minutes', 'contact-form-to-any-api' ); ?></option>
                                        <option value="15" <?php selected( $cf7anyapi_throttle_value, 15 ); ?>><?php esc_html_e( '15 Minutes', 'contact-form-to-any-api' ); ?></option>
                                        <option value="30" <?php selected( $cf7anyapi_throttle_value, 30 ); ?>><?php esc_html_e( '30 Minutes', 'contact-form-to-any-api' ); ?></option>
                                        <option value="60" <?php selected( $cf7anyapi_throttle_value, 60 ); ?>><?php esc_html_e( '1 Hour', 'contact-form-to-any-api' ); ?></option>
                                    </select>
                                    <p class="description"><?php esc_html_e( 'Minimum time between failure notification emails to prevent flooding.', 'contact-form-to-any-api' ); ?></p>
                                </td>
                            </tr>
                        </table>


                        <div class="submit">
                            <input type="submit" name="Submit" class="button button-primary" value="<?php echo esc_html( 'Save Changes', 'contact-form-to-any-api'); ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><?php
}