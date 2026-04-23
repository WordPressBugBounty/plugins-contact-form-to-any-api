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
$cf7anyapi_options = $cf7anyapi_object->Cf7_To_Any_Api_get_options();
$cf7anyapi_predefined_tags = $cf7anyapi_object->get_predefined_tags();
$cf7anyapi_predefined_keys = array_keys( $cf7anyapi_predefined_tags );

$cf7anyapi_selected_form = (empty($cf7anyapi_options['cf7anyapi_selected_form']) ? '' : $cf7anyapi_options['cf7anyapi_selected_form']);
$cf7anyapi_base_url = (empty($cf7anyapi_options['cf7anyapi_base_url']) ? '' : $cf7anyapi_options['cf7anyapi_base_url']);
$cf7anyapi_basic_auth = (empty($cf7anyapi_options['cf7anyapi_basic_auth']) ? '' : $cf7anyapi_options['cf7anyapi_basic_auth']);
$cf7anyapi_bearer_auth = (empty($cf7anyapi_options['cf7anyapi_bearer_auth']) ? '' : $cf7anyapi_options['cf7anyapi_bearer_auth']);
$cf7anyapi_input_type = (empty($cf7anyapi_options['cf7anyapi_input_type']) ? '' : $cf7anyapi_options['cf7anyapi_input_type']);
$cf7anyapi_method = (empty($cf7anyapi_options['cf7anyapi_method']) ? '' : $cf7anyapi_options['cf7anyapi_method']);
$cf7anyapi_form_field = (empty($cf7anyapi_options['cf7anyapi_form_field']) ? '' : $cf7anyapi_options['cf7anyapi_form_field']);
$cf7anyapi_header_request = (empty($cf7anyapi_options['cf7anyapi_header_request']) ? '' : $cf7anyapi_options['cf7anyapi_header_request']);
$cf7anyapi_enable_condition = (empty($cf7anyapi_options['cf7anyapi_enable_condition']) ? '' : $cf7anyapi_options['cf7anyapi_enable_condition']);
$cf7anyapi_conditions = (empty($cf7anyapi_options['cf7anyapi_conditions']) ? '' : $cf7anyapi_options['cf7anyapi_conditions']);

if(!class_exists('WPCF7_ContactForm')){?>
    <div id="cf7anyapi_admin" class="cf7anyapi_wrap">
        <p><?php esc_html_e( 'Contact form 7 api integrations requires CONTACT FORM 7 Plugin to be installed and active', 'contact-form-to-any-api' ); ?></p>
    </div>
<?php
} else {

    if(!empty($cf7anyapi_selected_form)){
        $cf7anyapi_default_form_field = $cf7anyapi_object->Cf7_To_Any_Api_default_form_field($cf7anyapi_selected_form);
        if($cf7anyapi_default_form_field['status'] == 404){
            ?>
                <div id="cf7anyapi_admin" class="cf7anyapi_wrap">
                    <p><?php esc_html_e( 'Your Selected Contact Form was not found Please try to add new data in this API', 'contact-form-to-any-api' ); ?></p>
                </div>
            <?php
            $cf7anyapi_selected_form = '';
            $cf7anyapi_base_url = '';
            $cf7anyapi_basic_auth = '';
            $cf7anyapi_bearer_auth = '';
            $cf7anyapi_input_type = '';
            $cf7anyapi_method = '';
            $cf7anyapi_form_field = '';
            $cf7anyapi_header_request = '';
        }
    }?>

    <!-- Multi-step form wrapper -->
    <div id="cf7anyapi_admin" class="cf7anyapi_wrap">
        <?php wp_nonce_field('cf7_to_any_api_cpt_nonce','cf7_to_any_api_cpt_nonce' ); ?>
            <div class="cf7anyapi_step">
                <ul>
                    <li class="active"><a href="javascript:;"><?php esc_html_e( 'Configure API Request', 'contact-form-to-any-api' ); ?></a></li>
                    <li><a href="javascript:;"><?php esc_html_e( 'Map Form Fields', 'contact-form-to-any-api' ); ?></a></li>
                </ul>
                <a href="javascript:;" class="button button-primary json-preview" id="jsonPreviewBtn"><?php esc_html_e( 'Show API Payload', 'contact-form-to-any-api' ); ?></a>
            </div>
        <!-- Step 1: API Setup -->
        <div id="cf7anyapi_step1">
            <div class="cf7anyapi_field">
                <label class="cf7anyapi_title" for="cf7anyapi_base_url" ><?php esc_html_e( 'API Endpoint URL', 'contact-form-to-any-api' ); ?><div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Provide the URL where requests will be sent', 'contact-form-to-any-api' ); ?>"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg></div>
            </label>
                <input type="text" id="cf7anyapi_base_url" name="cf7anyapi_base_url" value="<?php echo esc_url($cf7anyapi_base_url); ?>" placeholder="<?php esc_attr_e( 'Enter API Endpoint URL', 'contact-form-to-any-api' ); ?>" required>
            </div>
            <div class="wrapper cf7anyapi_step_1">
                <div class="left_col">
                    <div class="cf7anyapi_full_width col-50">
                        <label for="cf7anyapi_header_request"><?php esc_html_e( 'Request Headers', 'contact-form-to-any-api' ); ?><div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Custom headers to send with the API request.', 'contact-form-to-any-api' ); ?>"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg></div><span class="sample_header"><?php esc_html_e( 'Add sample header', 'contact-form-to-any-api' ); ?></span></label>
                        <textarea id="cf7anyapi_header_request" name="cf7anyapi_header_request" data-sample="<?php esc_attr_e( 'Authorization: Bearer YOUR_API_KEY
Content-Type: application/json
Custom-Header: Value', 'contact-form-to-any-api' ); ?>" placeholder="<?php esc_attr_e( 'Authorization: Bearer YOUR_API_KEY 
Content-Type: application/json
Custom-Header: Value

Enter each header on a new line. Add as many headers as required.', 'contact-form-to-any-api' ); ?>
                        "><?php echo esc_textarea($cf7anyapi_header_request); if($cf7anyapi_basic_auth){ echo "Authorization : Basic ".esc_html($cf7anyapi_basic_auth); } if($cf7anyapi_bearer_auth){ echo "Authorization : Bearer ".esc_html($cf7anyapi_bearer_auth); }?></textarea>
                    </div>
                    
                </div>
                <div class="right_col">
                    <div class="cf7anyapi_field">
                        <label for="cf7anyapi_input_type"><?php esc_html_e( 'Request Body Type', 'contact-form-to-any-api' ); ?><div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Choose how your form data is sent to the API.', 'contact-form-to-any-api' ); ?>"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg></div></label>
                        <select id="cf7anyapi_input_type" name="cf7anyapi_input_type" required>         
                            <option value="json" <?php selected($cf7anyapi_input_type, 'json'); ?>><?php esc_html_e( 'Raw JSON ( application/json )', 'contact-form-to-any-api' ); ?></option>
                            <option value="params" <?php selected($cf7anyapi_input_type, 'params'); ?>><?php esc_html_e( 'Parameters - GET/POST ( application/x-www-form-urlencoded )', 'contact-form-to-any-api' ); ?></option>
                            <option value="" disabled><?php esc_html_e( 'Form Data - Multipart/Form-data ( Pro Version Only )', 'contact-form-to-any-api' ); ?></option>
                            <option value="" disabled><?php esc_html_e( 'Multidimensional Data ( Pro Version Only )', 'contact-form-to-any-api' ); ?></option>
                        </select>
                    </div>

                    <div class="cf7anyapi_field">
                        <label for="cf7anyapi_method"><?php esc_html_e( 'Request Method', 'contact-form-to-any-api' ); ?><div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Select the action for sending your form data.', 'contact-form-to-any-api' ); ?>"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg></div></label>
                        <select id="cf7anyapi_method" name="cf7anyapi_method" required>
                            <option value="POST" <?php selected($cf7anyapi_method, 'POST'); ?>><?php esc_html_e( 'POST', 'contact-form-to-any-api' ); ?></option>
                            <option value="GET" <?php selected($cf7anyapi_method, 'GET'); ?>><?php esc_html_e( 'GET', 'contact-form-to-any-api' ); ?></option>
                        </select>
                    </div>               
                    
                </div>
                
            </div>
            <div class="bottom-button">
                <button type="button" id="cf7anyapi_next_btn" class="button button-primary" style="margin-top:20px;">Next &rarr;</button>
            </div>
        </div>

        <!-- Step 2: Form Mapping (hidden by default) -->
        <div id="cf7anyapi_step2" style="display:none;">
            <div class="cf7anyapi_col2">
                <div class="cf7anyapi_field">                
                    <label for="cf7anyapi_selected_form"><?php esc_html_e( 'Select Contact Form', 'contact-form-to-any-api' ); ?><div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Choose which contact form should send data.', 'contact-form-to-any-api' ); ?>"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg></div></label>
                    <select name="cf7anyapi_selected_form" id="cf7anyapi_selected_form" required> 
                        <option value="" selected disabled><?php esc_html_e( 'Choose a Contact Form', 'contact-form-to-any-api' ); ?></option>
                        <?php
                            $posts = get_posts(
                                array(
                                    'post_type'     => 'wpcf7_contact_form',
                                    'numberposts'   => -1
                                )
                            );
                            foreach($posts as $post){
                                ?>
                                <option value="<?php echo esc_attr($post->ID); ?>" <?php selected($post->ID, $cf7anyapi_selected_form); ?> ><?php echo esc_html($post->post_title.'('.$post->ID.')'); ?> </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="cf7anyapi-form-mapping-fields">
                <div class="wrapper">
                    <div class="cf7anyapi-form-mapping-header">
                        <label style="font-size: 16px; font-weight: 500; text-transform: capitalize;"><?php esc_html_e( 'Map Form Fields to API Keys', 'contact-form-to-any-api' ); ?><div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Match your form fields with the API’s fields.', 'contact-form-to-any-api' ); ?>"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg></div></label>                        
                    </div>    
                    <div class="cf7anyapi_maping_label">
                        <ul>
                            <li><p><?php esc_html_e( 'Contact Form Field', 'contact-form-to-any-api' ); ?></p><p><?php esc_html_e( 'API Key (Mapping)', 'contact-form-to-any-api' ); ?></p></li>
                            <li><p><?php esc_html_e( 'Contact Form Field', 'contact-form-to-any-api' ); ?></p><p><?php esc_html_e( 'API Key (Mapping)', 'contact-form-to-any-api' ); ?></p></li>
                        </ul>
                    </div>
                    <div id="cf7anyapi-form-fields" class="form-fields cf7anyapi_map_form">
                        <?php
                        if ($cf7anyapi_form_field) {
                            foreach ($cf7anyapi_form_field as $cf7anyapi_form_field_key => $cf7anyapi_form_field_value) {
                                $cf7anyapi_is_predefined = in_array($cf7anyapi_form_field_key, $cf7anyapi_predefined_keys, true);
                                ?>
                                <div class="cf7anyapi_field" <?php echo $cf7anyapi_is_predefined ? 'data-tag="' . esc_attr($cf7anyapi_form_field_key) . '"' : ''; ?>>
                                    <label for="cf7anyapi_<?php echo esc_attr($cf7anyapi_form_field_key); ?>"><?php echo esc_html($cf7anyapi_form_field_key); ?> </label>                                 
                                    <input type="text" id="cf7anyapi_<?php echo esc_attr($cf7anyapi_form_field_key); ?>" name="cf7anyapi_form_field[<?php echo esc_attr($cf7anyapi_form_field_key); ?>]" value="<?php echo esc_attr($cf7anyapi_form_field_value); ?>" placeholder="<?php esc_attr_e('Enter your API mapping key', 'contact-form-to-any-api'); ?>" >
                                    
                                    <?php if ($cf7anyapi_is_predefined) : ?>
                                        <button type="button" class="button cf7anyapi_remove_predefined_tag">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 511.76 511.76" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M436.896 74.869c-99.84-99.819-262.208-99.819-362.048 0-99.797 99.819-99.797 262.229 0 362.048 49.92 49.899 115.477 74.837 181.035 74.837s131.093-24.939 181.013-74.837c99.819-99.818 99.819-262.229 0-362.048zm-75.435 256.448c8.341 8.341 8.341 21.824 0 30.165a21.275 21.275 0 0 1-15.083 6.251 21.277 21.277 0 0 1-15.083-6.251l-75.413-75.435-75.392 75.413a21.348 21.348 0 0 1-15.083 6.251 21.277 21.277 0 0 1-15.083-6.251c-8.341-8.341-8.341-21.845 0-30.165l75.392-75.413-75.413-75.413c-8.341-8.341-8.341-21.845 0-30.165 8.32-8.341 21.824-8.341 30.165 0l75.413 75.413 75.413-75.413c8.341-8.341 21.824-8.341 30.165 0 8.341 8.32 8.341 21.824 0 30.165l-75.413 75.413 75.415 75.435z" fill="#189b9b" opacity="1" data-original="#189b9b" class=""></path></g></svg>
                                            <?php echo esc_html__('Remove', 'contact-form-to-any-api'); ?>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            <?php }
                        } else {
                            echo "<span class='selected_form_empty'>".esc_html__('Select your contact form', 'contact-form-to-any-api')."</span>";
                        } ?>
                    </div>
                </div> 
            </div>

            <!-- Predefined Tags Functionality -->
            <div class="cf7anyapi_col2">
                <div class="cf7anyapi_field">
                    <label class="cf7anyapi_title" for="cf7anyapi_predefined_tags" ><?php echo esc_html__( 'Built-in form fields', 'contact-form-to-any-api' ); ?>
                        <div class="cf7anyapi_tooltip" data-cf7apitooltip="<?php esc_html_e( 'Use default tags to automatically include dynamic data (like time, date, post title, user IP etc) when sending information to your API. No hidden fields needed!', 'contact-form-to-any-api' ); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 20 20" xml:space="preserve" class=""><g><path d="M10 1a8.987 8.987 0 0 0-7.921 13.257l-1.037 3.455A1 1 0 0 0 2 19a1.019 1.019 0 0 0 .288-.042l3.455-1.037A9 9 0 1 0 10 1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1zm1 10h-1a1 1 0 0 1-1-1v-4a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1v4a1 1 0 0 1 0 2z" fill="#189b9b" opacity="1" data-original="#000000" class=""></path></g></svg>
                        </div>
                    </label>
                    <div class="cf7anyapi_dynamic_tags">
                        <select id="cf7anyapi_predefined_tag_select">
                            <option value=""><?php echo esc_html__( '--Select Tag--', 'contact-form-to-any-api' ); ?></option>
                            <?php            
                            foreach ( $cf7anyapi_predefined_tags as $cf7anyapi_tag_key => $cf7anyapi_tag_label ) {?>
                                <option value="<?php echo esc_attr( $cf7anyapi_tag_key ); ?>">
                                    <?php echo esc_html( $cf7anyapi_tag_label ); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <button type="button" id="cf7anyapi_add_predefined_tag" class="button button-white"><?php echo esc_html__( 'Add Tag', 'contact-form-to-any-api' ); ?></button>
                    </div>
                </div>
            </div>
            
            <!-- Enable Conditional Logic Main -->
            <div class="cf7anyapi-conditional-logic">

                <!-- Enable Conditional Logic -->
                <div class="cf7anyapi-conditional-toggle">
                    <label>
                        <input type="checkbox" id="cf7anyapi_enable_condition" name="cf7anyapi_enable_condition" value="1" <?php checked($cf7anyapi_enable_condition, '1'); ?> />
                        <strong><?php echo esc_html__( 'Enable Conditional Logic', 'contact-form-to-any-api' ); ?></strong>
                    </label>
                    <p class="description"><?php echo esc_html__('API request will be triggered only if the selected form field matches the defined condition.', 'contact-form-to-any-api' ); ?></p>
                </div>

                <!-- Condition Wrapper -->
                <?php 
                $cf7anyapi_selected_field    = $cf7anyapi_options['cf7anyapi_conditions']['field']    ?? '';
                $cf7anyapi_selected_operator = $cf7anyapi_options['cf7anyapi_conditions']['operator'] ?? '';
                $cf7anyapi_selected_value    = $cf7anyapi_options['cf7anyapi_conditions']['value']    ?? '';?>
                <div class="cf7anyapi-condition-wrap" style="<?php echo ($cf7anyapi_enable_condition === '1') ? 'display:block;' : 'display:none;'; ?>">

                    <div class="cf7anyapi-condition-row">
                        <label class="cf7anyapi-condition-label"><?php echo esc_html__( 'Condition', 'contact-form-to-any-api' ); ?></label>

                        <select name="cf7anyapi_conditions[field]" class="cf7anyapi-condition-field">
                            <option value=""><?php echo esc_html__( 'Select Field', 'contact-form-to-any-api' ); ?></option>
                            <?php 
                            if ($cf7anyapi_form_field) {
                            foreach ($cf7anyapi_form_field as $cf7anyapi_key => $cf7anyapi_value) {?>
                                <option value="<?php echo esc_attr($cf7anyapi_key); ?>" <?php selected($cf7anyapi_selected_field, $cf7anyapi_key); ?> >[<?php echo esc_html($cf7anyapi_key); ?>]</option>
                            <?php }
                            } ?>
                        </select>

                        <select name="cf7anyapi_conditions[operator]" class="cf7anyapi-condition-operator">
                            <option value="equals" <?php selected($cf7anyapi_selected_operator, 'equals'); ?>>
                                <?php echo esc_html__( 'Equals', 'contact-form-to-any-api' ); ?>
                            </option>
                            <option value="not_equals" <?php selected($cf7anyapi_selected_operator, 'not_equals'); ?>>
                                <?php echo esc_html__( 'Not Equals', 'contact-form-to-any-api' ); ?>
                            </option>
                            <option value="contains" disabled>
                                <?php echo esc_html__( 'Contains (PRO)', 'contact-form-to-any-api' ); ?>
                            </option>
                            <option value="empty" disabled>
                                <?php echo esc_html__( 'Is Empty (PRO)', 'contact-form-to-any-api' ); ?>
                            </option>
                            <option value="not_empty" disabled>
                                <?php echo esc_html__( 'Is Not Empty (PRO)', 'contact-form-to-any-api' ); ?>
                            </option>
                        </select>

                        <input type="text" name="cf7anyapi_conditions[value]" class="cf7anyapi-condition-value" value="<?php echo esc_attr($cf7anyapi_selected_value); ?>" placeholder="<?php echo esc_html__( 'Value', 'contact-form-to-any-api' ); ?>" />
                    </div>
                </div>
            </div>

             <!-- Previous and Save Button -->
            <div class="bottom-button">
                <button type="button" id="cf7anyapi_prev_btn" class="button button-white" style="margin-top:20px;">&larr; <?php echo esc_html__( 'Previous', 'contact-form-to-any-api' ); ?></button>
                <button type="button" id="cf7anyapi_submit" class="button button-primary" style="margin-top:20px;"><?php echo esc_html__( 'Save', 'contact-form-to-any-api' ); ?></button>
            </div>
        </div>

         <!-- Popup Modal For the JSON-->
        <div id="jsonPreviewModal" class="cf7anyapi-json-preview-modal" style="display: none;">
            <div class="cf7anyapi-json-preview-modal-content">
                <span class="cf7anyapi-json-preview-close">&times;</span>
                <h2><?php echo esc_html__( 'Preview API Request', 'contact-form-to-any-api' ); ?></h2>
                <div id="jsonPreviewOutput"></div>
            </div>
        </div>
    </div>

    <div class="cf7anyapi_loader" style="display: none;">
        <img class="" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'images/loader.gif' ); ?>" alt="loader" >
    </div>
<?php }