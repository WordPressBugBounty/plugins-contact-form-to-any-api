<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$cf7anyapi_instance = new Cf7_To_Any_Api();
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$cf7anyapi_cf_id = filter_input(INPUT_GET, 'form_id', FILTER_VALIDATE_INT);
$cf7anyapi_cf_id = $cf7anyapi_cf_id !== null && $cf7anyapi_cf_id !== false ? intval($cf7anyapi_cf_id) : 0; ?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Contact Form Entries', 'contact-form-to-any-api' ); ?></h1> 
	<h2 class="screen-reader-text"><?php esc_html_e( 'Filter Contact Form Entries List', 'contact-form-to-any-api' ); ?></h2>
	<div class="cf_entries" id="cf_entries">
		<form name="form_entries" id="form_entries" class="cf7toanyapi_entries" method="get">
			<label for="form_id" class="cf7toanyapi_select_form"><?php esc_html_e( 'Choose a form:', 'contact-form-to-any-api' ); ?></label>
			<select name="form" id="form_id" class="form_id cf7toanyapi_forms">
				<option value=""><?php esc_html_e( 'Select Form', 'contact-form-to-any-api' ); ?></option>
				<?php
				$posts = get_posts(
	                array(
	                    'post_type'     => 'wpcf7_contact_form',
	                    'numberposts'   => -1,
	                    'suppress_filters' => false
	                )
	            );
	            $cf7anyapi_count = 0;
	            foreach($posts as $post){
	            	$cf7anyapi_is_selected = ( $cf7anyapi_cf_id === 0 && $cf7anyapi_count == 0 ) || ( $post->ID === $cf7anyapi_cf_id );
				    if ( $cf7anyapi_cf_id === 0 && $cf7anyapi_count == 0 ) {
				        $cf7anyapi_cf_id = $post->ID;
				    }?>
	                <option value="<?php echo esc_attr($post->ID); ?>" <?php selected( $cf7anyapi_is_selected, true ); ?>>
	                	<?php echo esc_html($post->post_title.'('.$post->ID.')'); ?> 
	                </option>
	                <?php $cf7anyapi_count++;
	            } ?>
			</select>
		</form>
		<?php
			if(isset($cf7anyapi_cf_id) && $cf7anyapi_cf_id != ''){
				// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
				$cf7anyapi_result = $wpdb->get_results($wpdb->prepare(
			        'SELECT * FROM ' . $wpdb->prefix . 'cf7anyapi_entries 
			        WHERE `form_id` = %d 
			        AND data_id IN( 
			            SELECT * FROM ( 
			                SELECT data_id FROM ' . $wpdb->prefix . 'cf7anyapi_entries 
			                WHERE 1 = 1 
			                AND `form_id` = %d 
			                GROUP BY `data_id` 
			                ORDER BY `data_id` DESC
			            ) temp_table
			        ) 
			        ORDER BY `data_id` DESC',
			        $cf7anyapi_cf_id,
			        $cf7anyapi_cf_id
			    ));

				if($cf7anyapi_result){
				$cf7anyapi_data_sorted = $cf7anyapi_instance->cf7toanyapi_sortdata($cf7anyapi_result);
				$cf7anyapi_fields = $cf7anyapi_instance->cf7toanyapi_get_db_fields($cf7anyapi_cf_id);
				$cf7anyapi_display_character = (int) apply_filters('cf7anyapi_display_character_count',500);
				$cf7anyapi_arr_field_type_info = $cf7anyapi_instance->cf7toanyapi_field_type_info($cf7anyapi_cf_id);
				?>				
					<div id="table_data">
						<table class="tbl table table-striped table-bordered cf7toanyapi_table" id="cf7toanyapi_table">
							<?php echo wp_kses_post( wp_nonce_field('cf_to_any_api_entrie_del_nonce','cf_to_any_api_entrie_del_nonce' ) ); ?>
							<thead>
								<tr class="cf7toanyapi_dataid_all">								
									<?php
									
											echo '<th class="manage-column">checkbox</th>';
										foreach ($cf7anyapi_fields as $cf7anyapi_key => $cf7anyapi_value){
											echo '<th class="manage-column" data-key="'.esc_attr($cf7anyapi_value).'">'.esc_html(ucfirst(str_replace('_',' ',$cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value)))).'</th>';
										}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
								
									if(!empty($cf7anyapi_data_sorted)){
										foreach ($cf7anyapi_data_sorted as $cf7anyapi_key => $cf7anyapi_value )   {					
											echo '<tr data-id="'.esc_attr($cf7anyapi_key).'" class="cf7toanyapi_dataid">';
											$cf7anyapi_key = (int)$cf7anyapi_key;
											echo '<td data-id="'.esc_attr($cf7anyapi_key).'" class="cf7toanyapi_dataid"></td>';
											foreach ($cf7anyapi_fields as $cf7anyapi_key2 => $cf7anyapi_value2) {
												//Get fields related values
												$cf7anyapi_inner_value = ((isset($cf7anyapi_value[$cf7anyapi_key2])) ? $cf7anyapi_value[$cf7anyapi_key2] : '&nbsp;');
												$cf7anyapi_inner_value_sanitized = filter_var($cf7anyapi_inner_value, FILTER_SANITIZE_URL);

												//Check value is URL or not
												if (!filter_var($cf7anyapi_inner_value_sanitized, FILTER_VALIDATE_URL) === false) {
													$cf7anyapi_inner_value = esc_url($cf7anyapi_inner_value);
													//If value is url then setup anchor tag with value
													if(!empty($cf7anyapi_arr_field_type_info) && array_key_exists($cf7anyapi_key2,$cf7anyapi_arr_field_type_info) && $cf7anyapi_arr_field_type_info[$cf7anyapi_key2] == 'file'){
														//Add download attributes in tag if field type is attachement
														?><td data-head="<?php echo esc_attr( $cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value2) ); ?>">
															<a href="<?php echo esc_url($cf7anyapi_inner_value); ?>" target="_blank" title="<?php echo esc_url($cf7anyapi_inner_value); ?>" download ><?php echo esc_html(basename($cf7anyapi_inner_value)); ?>
															</a>
														</td><?php
													}
													else{
														?><td data-head="<?php echo esc_attr( $cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value2) ); ?>">
															<a href="<?php echo esc_url($cf7anyapi_inner_value); ?>" target="_blank" title="<?php echo esc_url($cf7anyapi_inner_value); ?>" ><?php echo esc_html(basename($cf7anyapi_inner_value)); ?>
															</a>
														</td><?php
													}
												} else if($cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value2) == 'submitted_from'){
													echo '<td data-head="'.esc_attr( $cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value2) ).'"><a href="'.esc_url(get_the_permalink($cf7anyapi_inner_value)).'" target="_blank">'.esc_html(get_the_title($cf7anyapi_inner_value)).'</a></td>';
												} else{
													$cf7anyapi_inner_values_decoded = wp_kses_post(html_entity_decode($cf7anyapi_inner_value));
													if(strlen($cf7anyapi_inner_values_decoded) > $cf7anyapi_display_character){
														echo '<td data-head="'. esc_attr(  $cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value2) ).'">'.wp_kses_post(substr(html_entity_decode($cf7anyapi_inner_value), 0, $cf7anyapi_display_character)).'...</td>';
													}else{
														echo '<td data-head="'. esc_attr(  $cf7anyapi_instance->cf7toanyapi_admin_get_field_name($cf7anyapi_value2) ).'">'.wp_kses_post( htmlspecialchars_decode( $cf7anyapi_inner_value ) ).'</td>';
													}
												}
											}//Close foreach
											echo '</tr>';
										}//Close foreach							
									
									}
								?>
							</tbody>
						</table>
					</div>
				<?php
				}
				else{
					?>
						<div id="table_data">
							<h3 class="cf7toanyapi_data_not_found"><?php esc_html_e( 'No data Found...!!!', 'contact-form-to-any-api' ); ?></h3>
						</div>
					<?php
				}
			}
		?>
	</div>
</div>