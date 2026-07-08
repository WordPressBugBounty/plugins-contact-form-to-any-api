<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class cf7anyapi_List_Table extends WP_List_Table{

	public $logs_data;

    public function __construct(){
    	global $status, $page;
        parent::__construct(
        	array(
            	'singular'  => __( 'cf7anyapi_logs', 'contact-form-to-any-api' ),  
            	'plural'    => __( 'cf7anyapi_logs', 'contact-form-to-any-api' ), 
            	'ajax'      => false,
    		)
        );
    }

  	public function column_default($item, $column_name){
    	switch($column_name){ 
        	case 'form_id':
        		$form_title = get_the_title($item[$column_name]);
        		if ( empty( $form_title ) ) {
        			return esc_html( $item[ $column_name ] );
        		}
        		return '<a href="'.esc_url(site_url())."/wp-admin/admin.php?page=wpcf7&post=".esc_attr($item[ $column_name ])."&action=edit".'" target="_blank">'.esc_html( $form_title ).'</a>';
        	case 'post_id':
        		$edit_link = get_edit_post_link($item[$column_name]);
        		$post_title = get_the_title($item[$column_name]);
        		if ( empty( $edit_link ) ) {
        			if ( ! empty( $post_title ) ) {
        				return esc_html( $post_title );
        			}
        			/* translators: %d: original post ID of the deleted API integration */
        			return '<em>' . esc_html( sprintf( __( '(Deleted) #%d', 'contact-form-to-any-api' ), $item[ $column_name ] ) ) . '</em>';
        		}
        		return '<a href="'.esc_url( $edit_link ).'" target="_blank">'.esc_html( $post_title ).'</a>';
        	case 'form_data':
        	case 'log':
            	return '<pre>'.esc_html($item[$column_name]).'</pre><span class="view_more">Expand JSON</span>';
            case 'status':
            	$status = ! empty( $item[$column_name] ) ? intval($item[$column_name]) : null;
            	if ( is_null($status) ) {
			        $message = '';
			        $class   = 'status-na';
			    } else {
			        switch ($status) {
			            case 200:
			                $message = 'Success (200)';
			                $class   = 'status-success';
			                break;
			            case 201:
			                $message = 'Created (201)';
			                $class   = 'status-success';
			                break;
			            case 202:
			                $message = 'Accepted (202)';
			                $class   = 'status-success';
			                break;
			            case 204:
			                $message = 'No Content (204)';
			                $class   = 'status-success';
			                break;
			            case 400:
			                $message = 'Bad Request (400)';
			                $class   = 'status-error';
			                break;
			            case 401:
			                $message = 'Unauthorized (401)';
			                $class   = 'status-error';
			                break;
			            case 403:
			                $message = 'Forbidden (403)';
			                $class   = 'status-error';
			                break;
			            case 404:
			                $message = 'Not Found (404)';
			                $class   = 'status-error';
			                break;
			            case 500:
			                $message = 'Server Error (500)';
			                $class   = 'status-error';
			                break;
			            default:
			                $message = 'Unknown (' . $status . ')';
			                $class   = 'status-unknown';
			                break;
			        }
			    }
			    $status_html = '<div style="display: flex; flex-direction: column; align-items: flex-start; gap: 4px;">';
			    $status_html .= '<span class="' . esc_attr($class) . '">' . esc_html($message) . '</span>';
			    if ( is_null( $status ) || $status < 200 || $status >= 300 ) {
			    	$status_html .= '<a href="' . esc_url( CF7_CURL_DOMAIN . '/pricing/' ) . '" target="_blank" style="color: #2271b1; text-decoration: none; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 4px;">';
			    	$status_html .= '<span class="dashicons dashicons-update" style="font-size: 16px; width: 16px; height: 16px; color: #3b71ca; vertical-align: middle;"></span>';
			    	$status_html .= esc_html__( 'Retry (PRO)', 'contact-form-to-any-api' );
			    	$status_html .= ' <span class="dashicons dashicons-lock" style="font-size: 14px; width: 14px; height: 14px; color: #2271b1; vertical-align: middle;"></span>';
			    	$status_html .= '</a>';
			    	$status_html .= '<span style="font-size: 11px; color: #646970; margin-left: 20px; line-height: 1.2;">' . esc_html__( 'This is a PRO feature.', 'contact-form-to-any-api' ) . '</span>';
			    }
			    $status_html .= '</div>';
			    return $status_html;
            case 'created_date':
            	return esc_html($item[ $column_name ]);
        	default:
            	return esc_html( $item[ $column_name ] ); 
    	}
  	}

	public function get_columns(){
        $columns = array(
        	'cb' => '<input type="checkbox" />',
            'form_id' => __( 'Form Name', 'contact-form-to-any-api' ),
            'post_id' => __( 'API Name', 'contact-form-to-any-api' ),
            'form_data' => __( 'Submitted Data', 'contact-form-to-any-api' ),
            'log' => __( 'API Response', 'contact-form-to-any-api' ),
            'status' => __( 'API Status', 'contact-form-to-any-api' ),
            'created_date' => __( 'Created Date', 'contact-form-to-any-api' )
        );
        return $columns;
    }

    public static function default_logs_data($page_number = 1, $form_id = null){
		global $wpdb;
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if(!empty($_REQUEST['paged'])){
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$page_number = absint(wp_unslash($_REQUEST['paged']));
		}

		$sql = "SELECT * FROM {$wpdb->prefix}cf7anyapi_logs WHERE 1=1";
		$params = array();

		if ( $form_id ) {
            $sql .= " AND form_id = %d";
			$params[] = $form_id;
        }

        // Allow list for ordering
        $allowed_orderby = array( 'form_id', 'post_id', 'created_date' );
        $orderby = 'created_date';
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['orderby'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		    $orderby_raw = sanitize_text_field( wp_unslash( $_GET['orderby'] ) );
		    if ( in_array( $orderby_raw, $allowed_orderby, true ) ) {
		        $orderby = $orderby_raw;
		    }
		}

        $order = 'DESC';
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if ( isset( $_GET['order'] ) ) {
        	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		    $order_raw = sanitize_text_field( wp_unslash( $_GET['order'] ) );
		    if ( 'asc' === strtolower( $order_raw ) ) {
		        $order = 'ASC';
		    }
		}

        // We use literal strings for ORDER BY and limit variables to satisfy the Plugin Check
        if ( 'form_id' === $orderby ) {
            if ( 'ASC' === $order ) {
                $sql .= " ORDER BY form_id ASC";
            } else {
                $sql .= " ORDER BY form_id DESC";
            }
        } elseif ( 'post_id' === $orderby ) {
            if ( 'ASC' === $order ) {
                $sql .= " ORDER BY post_id ASC";
            } else {
                $sql .= " ORDER BY post_id DESC";
            }
        } else {
            if ( 'ASC' === $order ) {
                $sql .= " ORDER BY created_date ASC";
            } else {
                $sql .= " ORDER BY created_date DESC";
            }
        }

        // Limit and offset for pagination
        $limit  = 10;
        $offset = ( $page_number - 1 ) * $limit;

        $sql .= " LIMIT %d OFFSET %d";
        $params[] = $limit;
        $params[] = $offset;

        // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, PluginCheck.Security.DirectDB.UnescapedDBParameter
        return $wpdb->get_results( $wpdb->prepare( $sql, $params ), 'ARRAY_A' );
	}

	public static function get_logs_data( $form_id = null ){
		global $wpdb;
		if ( ! empty( $form_id ) ) {
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
            return $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM {$wpdb->prefix}cf7anyapi_logs WHERE form_id = %d",
					$form_id
				),
				'ARRAY_A'
			);
        }

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
        return $wpdb->get_results(
			"SELECT * FROM {$wpdb->prefix}cf7anyapi_logs WHERE 1=1",
			'ARRAY_A'
		);
    }

	public function prepare_items(){
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$form_id = !empty($_GET['cf7_form_filter']) ? absint($_GET['cf7_form_filter']) : null;
        $this->logs_data = $this->get_logs_data( $form_id );

        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );

        /* Pagination */
        $per_page     = 10;
        $current_page = $this->get_pagenum();
        $total_items  = count( $this->logs_data );

        $this->logs_data = array_slice( $this->logs_data, ( ( $current_page - 1 ) * $per_page ), $per_page );

        $this->set_pagination_args(
            array(
                'total_items' => $total_items,
                'per_page'    => $per_page,
            )
        );

        $this->items = self::default_logs_data( $this->get_pagenum(), $form_id );
	}

	public function get_sortable_columns(){
		$sortable_columns = array(
			'form_id' => array( 'form_id', true ),
			'post_id' => array( 'post_id', true ),
			'created_date' => array( 'created_date', true ),
		);

		return $sortable_columns;
	}

	public function usort_reorder($a, $b){
		$allowed_order   = array( 'asc', 'desc' );
        $allowed_orderby = array( 'form_id', 'post_id', 'created_date' );

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $orderby = ( ! empty( $_GET['orderby'] ) ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : 'form_id';
        $orderby = in_array( $orderby, $allowed_orderby, true ) ? $orderby : 'form_id';

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $order = ( ! empty( $_GET['order'] ) ) ? sanitize_text_field( wp_unslash( $_GET['order'] ) ) : 'asc';
        $order = in_array( $order, $allowed_order, true ) ? $order : 'asc';

        $result = strcmp( $a[ $orderby ], $b[ $orderby ] );

        return ( 'asc' === $order ) ? $result : -$result;
	}

	public function extra_tablenav( $which ) {
	    if ( $which === 'top' ) {
	    	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	        $selected_form = isset($_GET['cf7_form_filter']) ? absint($_GET['cf7_form_filter']) : '';
	        $cf7_forms = get_posts( array(
	            'post_type'      => 'wpcf7_contact_form',
	            'posts_per_page' => -1,
	        ) );
	        ?>
	        <div class="cf7log_filters alignleft actions">
		        <form id="cf7log-filter" method="get" action="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>">
		        	<input type="hidden" name="post_type" value="cf7_to_any_api">
    				<input type="hidden" name="page" value="cf7anyapi_logs">
		            <select name="cf7_form_filter" id="cf7_form_filter">
		                <option value=""><?php esc_html_e( 'All Contact Forms', 'contact-form-to-any-api' ); ?></option>
		                <?php foreach ( $cf7_forms as $form ) : ?>
		                    <option value="<?php echo esc_attr( $form->ID ); ?>" <?php selected( $selected_form, $form->ID ); ?>>
		                        <?php echo esc_html( $form->post_title ); ?>
		                    </option>
		                <?php endforeach; ?>
		            </select>
		            <input type="submit" class="button" value="<?php esc_attr_e( 'Filter', 'contact-form-to-any-api' ); ?>">
		            <div class="cf7anyapi_log_button">
			        	<button href="javascript:void(0);" class="cf7anyapi_bulk_log_delete button"><?php echo esc_html__( 'Delete Log', 'contact-form-to-any-api' );?></button>
			        </div>
			    </form>
	        </div>
	        <?php
	    }
	}

	public function column_cb($item){
	    return sprintf(
	        '<input type="checkbox" name="log_ids[]" value="%s" />',
	        esc_attr($item['id']) // assuming `id` is the primary key
	    );
	}
}