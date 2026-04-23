<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!-- CF7 to any API Documentation -->
<div class="wrap">
    <div class="cf7anyapi_doc">
        <h1 class="wp-heading-inline"><?php esc_html_e( 'CF7 To Any API Documentation', 'contact-form-to-any-api' ); ?></h1>
        <h2 class="screen-reader-text"><?php esc_html_e( 'CF7 To Any API Documentation ', 'contact-form-to-any-api' ); ?></h2>
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-3 col-12 tab column-tab-nav">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active tab-index-1" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'How to configure', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-2" id="v-pills-video-tab" data-toggle="pill" href="#v-pills-video" role="tab" aria-controls="v-pills-video" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'Video for configuration', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-3" id="v-pills-logs-tab" data-toggle="pill" href="#v-pills-logs" role="tab" aria-controls="v-pills-logs" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'Logs', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-4" id="v-pills-entries-tab" data-toggle="pill" href="#v-pills-entries" role="tab" aria-controls="v-pills-entries" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'Entries', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-5" id="v-pills-json-format-tab" data-toggle="pill" href="#v-pills-json-format" role="tab" aria-controls="v-pills-json-format" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'Supported JSON Format', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-6" id="v-pills-pre-defined-tags-tab" data-toggle="pill" href="#v-pills-pre-defined-tags" role="tab" aria-controls="v-pills-pre-defined-tags" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'Pre Defined Tags', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-7" id="v-pills-cf7-hidden-field-tab" data-toggle="pill" href="#v-pills-cf7-hidden-field" role="tab" aria-controls="v-pills-cf7-hidden-field" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'CF7 Hidden Fields', 'contact-form-to-any-api' ); ?>
                    </a>
                    <a class="nav-link tab-index-10" id="v-pills-contact-us-tab" data-toggle="pill" href="#v-pills-contact-us" role="tab" aria-controls="v-pills-contact-us" aria-selected="false">
                        <div class="tab-index"></div>
                        <?php esc_html_e( 'Contact Us', 'contact-form-to-any-api' ); ?>
                    </a>
                </div>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-9 col-12 tab column-tab-content">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- cf7 API -->
                    <div class="tab-pane fade show active cf7anyapi_full_width" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h5 class="tab-title"><?php esc_html_e( 'Guide to Adding a New CF7 API Integration', 'contact-form-to-any-api' ); ?></h5>
                        <p><?php esc_html_e( 'This guide walks you through every step in the correct order to send your CF7 submissions straight to HubSpot, Salesforce, Zoho, Google Sheets, and 150+ other platforms, directly from WordPress.', 'contact-form-to-any-api' ); ?></p>
                        <p><?php esc_html_e( 'No coding, no external tools, just pure integration.', 'contact-form-to-any-api' ); ?> </p>
                        <h5 class="text-left"><?php esc_html_e( 'Steps to Configure the API:', 'contact-form-to-any-api' ); ?></h5>
                        <ol>
                            <li>
                                <strong><?php esc_html_e( 'Add a New CF7 API', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php echo wp_kses_post(__( 'Click on <strong>Add New CF7 API</strong>.', 'contact-form-to-any-api' )); ?></li>
                                    <li><?php echo wp_kses_post(__( 'Provide a suitable title for your API in the <strong>API Title</strong> field.', 'contact-form-to-any-api' )); ?></li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Select the Form', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php esc_html_e( 'Choose the Contact Form 7 form you want to connect with the API from the dropdown list.', 'contact-form-to-any-api' ); ?></li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Enter the API URL', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php echo wp_kses_post(__( 'Input the URL for your CRM or API in the <strong>API URL</strong> field.', 'contact-form-to-any-api' )); ?></li>
                                    <li>
                                        <?php esc_html_e( 'Example:', 'contact-form-to-any-api' ); ?> 
                                        <pre><?php esc_html_e( 'https://api.mailbluster.com/api/leads/', 'contact-form-to-any-api' ); ?></pre>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Add Header Requests', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php echo wp_kses_post(__( 'Include the necessary headers for the API in the <strong>Header Request</strong> field. ', 'contact-form-to-any-api' )); ?><?php esc_html_e( 'Examples:', 'contact-form-to-any-api' ); ?></li>
                                    <pre>
      Authorization: MY_API_KEY
      Authorization: Bearer xxxxxxx
      Authorization: Basic xxxxxx
      Content-Type: application/json</pre>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Authorization with Username and Password (Base64 Encoding)', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo wp_kses( 
                                                __( 'If your API requires a username and password, convert them to <strong>Base64</strong> format. You can use an online Base64 converter to achieve this.', 'contact-form-to-any-api' ), 
                                                array( 'strong' => array() ) 
                                                ); ?>
                                        </div>
                                        <pre>  Authorization: Basic ' . base64_encode(YOUR_USERNAME . ':' . YOUR_PASSWORD)</pre>
                                    </li>
                                    <li>
                                        <?php esc_html_e( 'Add the converted string in the header:', 'contact-form-to-any-api' ); ?>
                                        <pre>
      Authorization: Basic c2FsdXRlLXZldGVyYW5zLWFwaSA6IDBjd1NURENTcE91MUNOQXFVRFFmajdN
      Content-Type: application/json</pre>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Select Input Type', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php echo wp_kses_post(__( 'Choose your input type: <strong>JSON</strong> or <strong>GET/POST</strong>.', 'contact-form-to-any-api' )); ?></li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Select API Method', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php echo wp_kses_post(__( 'Specify the HTTP method your API uses: <strong>POST</strong> or <strong>GET</strong>.', 'contact-form-to-any-api' )); ?></li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Map Fields', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php esc_html_e( 'Map the form fields to the corresponding API keys provided by your API documentation.', 'contact-form-to-any-api' ); ?></li>
                                </ul>
                            </li>
                            <li>
                                <strong><?php esc_html_e( 'Save Configuration', 'contact-form-to-any-api' ); ?></strong>
                                <ul>
                                    <li><?php esc_html_e( 'Click on', 'contact-form-to-any-api' ); ?> <strong><?php esc_html_e( 'Save', 'contact-form-to-any-api' ); ?></strong> <?php esc_html_e( 'to store your API configuration.', 'contact-form-to-any-api' ); ?></li>
                                </ul>
                            </li>
                        </ol>
                        <p><?php esc_html_e( 'Just follow along, and you will have your Contact Form 7 form sending data to your API exactly the way you need within a few minutes. ', 'contact-form-to-any-api' ); ?></p>
                    </div>
                    <!-- video tutorial -->
                    <div class="tab-pane fade cf7anyapi_full_width" id="v-pills-video" role="tabpanel" aria-labelledby="v-pills-video-tab">
                        <h5 class="tab-title"><?php esc_html_e( 'CF7 to any API video tutorial', 'contact-form-to-any-api' ); ?></h5>
                        <p><?php esc_html_e( 'Watch how fast you can connect Contact Form 7 to Zoho CRM, Odoo, ActiveCampaign, or even Notion. Within 2 minutes, add your API details, map your fields, send test data, and go live without writing a line of code.', 'contact-form-to-any-api' ); ?></p>

                        <div class="iframe-wrap embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/1K-JdXwDH_k" title="<?php esc_attr_e( 'YouTube video player', 'contact-form-to-any-api' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <!-- Logs -->
                    <!-- Logs -->
                    <div class="tab-pane fade cf7anyapi_full_width" id="v-pills-logs" role="tabpanel" aria-labelledby="v-pills-logs-tab">
                        <h5 class="tab-title"><?php esc_html_e( 'Logs', 'contact-form-to-any-api' ); ?></h5>
                        <p><?php esc_html_e( 'If you want to confirm what your form actually sent, the Logs tab shows every detail instantly. You can review each request, submission, and API response with complete clarity. Here is an overview:', 'contact-form-to-any-api' ); ?></p>
                        <ol>
                            <li><?php echo wp_kses(__( 'After submitting data, you can view your data in the Logs tab.', 'contact-form-to-any-api' ), array('b' => array()) ); ?></li>
                            <li><?php esc_html_e( 'You can see your API logs and their data that is submitted by the user.', 'contact-form-to-any-api' ); ?></li>
                            <li><?php echo wp_kses(__( 'You can see your <b>API response too</b>.', 'contact-form-to-any-api' ), array('b' => array() ) ); ?></li>
                            <p><?php esc_html_e( 'Example: ', 'contact-form-to-any-api' ); ?></p>
                            <img src="<?php echo esc_url( plugin_dir_url( __DIR__ ).'images/logs.png' ); ?>" alt="logs list" style="height:100%; width:100%;">
                        </ol>
                    </div>
                    <!-- entries -->
                    <div class="tab-pane fade" id="v-pills-entries" role="tabpanel" aria-labelledby="v-pills-entries-tab">
                        <h5 class="tab-title"><?php esc_html_e( 'Entries', 'contact-form-to-any-api' ); ?></h5>
                        <p><?php esc_html_e( 'Want a quick way to check what users submitted? The Entries tab saves every form entry in your dashboard. You can review, filter, or export in one click. Here is how it works:', 'contact-form-to-any-api' ); ?></p>
                        <ol>
                            <li><?php esc_html_e( 'Select the form, and its data will display.', 'contact-form-to-any-api' ); ?></li>
                            <li> <?php echo wp_kses(__( 'You can download your data in <b>CSV</b>, <b>Excel</b>, <b>PDF</b> and also you can <b>Print</b> your data. You can also print your data.', 'contact-form-to-any-api' ), array('b' => array() ) ); ?></li>
                            <p><?php esc_html_e( 'Example: ', 'contact-form-to-any-api' ); ?></p>
                            <img src="<?php echo esc_url( plugin_dir_url( __DIR__ ).'images/entries.png');?>" alt="entries list" style="height:100%; width:100%;">
                        </ol>
                    </div>
                    <!-- Supported JSON Format -->
                    <div class="tab-pane fade cf7anyapi_full_width" id="v-pills-json-format" role="tabpanel" aria-labelledby="v-pills-json-format-tab">
                        <h5 class="tab-title"><?php esc_html_e( 'Supported JSON format', 'contact-form-to-any-api' ); ?></h5>
                        <p><?php esc_html_e( 'With the free version, you can send straightforward JSON with simple key–value pairs.', 'contact-form-to-any-api' ); ?></p>
                        <p><?php esc_html_e( 'With the Pro version, you can send more structured JSON, including nested or multi-level data used by many CRMs and advanced APIs.', 'contact-form-to-any-api' ); ?></p>
                        <ol>
                            <li>
                                <b><?php esc_html_e( 'Supported JSON format by Free Version', 'contact-form-to-any-api' ); ?></b></br>
                                <pre>
      {
          Firstname : "your-first-name",
          Lastname  : "your-last-name",
          Email     : "your-email",
          Phone     : "your-phone"
      }         </pre>
                            </li>
                            <li>
                                <?php echo wp_kses(__( '<b>Nested JSON Format Required </b><a href="https://www.contactformtoapi.com/pricing/#pricing" class="cf7_to_any_api_doc_link" target="_blank"><strong>Pro Version</strong></a>', 'contact-form-to-any-api' ), array('b' => array(), 'a' => array('href' => array(), 'class' => array(), 'target' => array() ), 'strong' => array() ) ); ?></br>
                                <pre>
      {
          Firstname : "your-first-name",
          Lastname  : "your-last-name",
          Email     : "your-email",
          Phone     : { 
                        office-number   : "9898989898", 
                        helpline-number : "1800-125-125"
                       }
      }         </pre>
                                <h5 class="mt-5 mb-2"><b><?php echo esc_html_e('Your API has Nested or Multilevel format of JSON?','contact-form-to-any-api'); ?></b></h5>
                                <h5><?php echo wp_kses(__('<b> Don\'t worry, our development team can customize our plugin as per your need.</b><p class="get_pro_version-btn"><a target="_blank" href="https://www.contactformtoapi.com/#contact_us">Click here to contact us</a></p>','contact-form-to-any-api'), array('b' => array(),'p' => array('class' => array()),'a' => array('href' => array(), 'target' => array()))); ?></h5>
                            </li>
                        </ol>
                    </div>
                    <!-- Pre Defined Tags -->
                    <div class="tab-pane fade cf7anyapi_full_width" id="v-pills-pre-defined-tags" role="tabpanel" aria-labelledby="v-pills-pre-defined-tags">
                        <h5 class="tab-title"><?php esc_html_e( 'Available Predefined Tags', 'contact-form-to-any-api' ); ?></h5>
                        <br>
                        <p>
                            <?php esc_html_e( 'These predefined tags can be used directly in your JSON payload. When the form is submitted, their values are automatically replaced with dynamic data (e.g., user IP, page URL, submission date, etc.). This ensures real-time data is passed without manual input.', 'contact-form-to-any-api' ); ?>
                        </p>
                        <ul>
                            <li><strong><?php esc_html_e( '[_user_ip]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'Captures the visitor\'s IP address at the time of form submission.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_date]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'Displays the submission date (based on your WordPress Settings → General → Date Format).', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_time]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'Displays the submission time (based on your WordPress Settings → General → Time Format).', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_submitted_date_time]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'Displays both date and time of submission (follows your WordPress Date & Time Settings).', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_site_url]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The home URL of your website.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_submission_source_url]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The URL of the page where the form was submitted.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_post_id]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The ID of the current post or page where the form is placed.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_post_slug]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The slug (URL-friendly name) of the current post or page.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_post_title]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The title of the current post or page where the form is located.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_form_id]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The unique ID of the Contact Form 7 form.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_form_name]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The name/title of the Contact Form 7 form.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_http_referer]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The previous page URL that referred the user to the form page.', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_browser_info]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'Captures the user’s browser and operating system information (User Agent).', 'contact-form-to-any-api' ); ?></li>
                            <li><strong><?php esc_html_e( '[_server_name]', 'contact-form-to-any-api' ); ?></strong> – <?php esc_html_e( 'The server hostname where your WordPress website is hosted.', 'contact-form-to-any-api' ); ?></li>
                        </ul>
                    </div>
                    <!-- CF7 Hidden field -->
                    <div class="tab-pane fade cf7anyapi_full_width" id="v-pills-cf7-hidden-field" role="tabpanel" aria-labelledby="v-pills-cf7-hidden-field">
                        <h5 class="tab-title"><?php esc_html_e( 'How to use CF7 Hidden fields', 'contact-form-to-any-api' ); ?></h5>
                        <br>
                        <p><?php esc_html_e( 'Need to send data that users never fill in themselves, like tracking IDs or source values? Hidden fields let you pass this extra information to your API automatically. You can set them up in several simple ways, such as:', 'contact-form-to-any-api' ); ?></p>
                        <ul>
                            <li>
                                <p class="pro_tab_description"><?php esc_html_e( 'Hidden field without value: ', 'contact-form-to-any-api' ); ?><strong>[hidden tracking-id]</strong></p>
                            </li>
                            <li>
                                <p class="pro_tab_description"><?php esc_html_e( 'Hidden field with Default value: ', 'contact-form-to-any-api' ); ?><strong>[hidden tracking-id default "12345"]</strong></p>
                            </li>
                            <li>
                                <p class="pro_tab_description"><?php esc_html_e( 'Hidden field with fix/static value: ', 'contact-form-to-any-api' ); ?><strong>[hidden tracking-id "12345"]</strong></p>
                            </li>
                            <li>
                                <p class="pro_tab_description"><?php esc_html_e( 'Hidden field is important part whenver we want to send data to API. Many API has parameter that need to send with static value in that case we can create hidden field and put static value and simply Map Hidden field with API mapping Key', 'contact-form-to-any-api' ); ?></p>
                            </li>
                        </ul>
                    </div>
                    <!-- contact us -->
                    <div class="tab-pane fade cf7anyapi_full_width" id="v-pills-contact-us" role="tabpanel" aria-labelledby="v-pills-contact-us-tab">
                        <h5 class="tab-title"><?php esc_html_e( 'Contact Us', 'contact-form-to-any-api' ); ?></h5>
                        <br>
                        <p><?php esc_html_e( "If you're facing any issues during integration or are unsure about any step, we are happy to help you resolve them in minutes.", 'contact-form-to-any-api' ); ?></p>
                        <p><a target="_blank" href="https://www.contactformtoapi.com/#contact_us"><?php esc_html_e( 'Talk to Support', 'contact-form-to-any-api' ); ?></a></p>
                        <p><?php echo wp_kses(__( 'You can even email us your query at <b><a target="_blank" href="mailto:support@contactformtoapi.com">support@contactformtoapi.com</a></b>', 'contact-form-to-any-api' ), array('b' => array(), 'a' => array('href' => array() ) ) ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>