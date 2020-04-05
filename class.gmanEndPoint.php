<?php

class gmanEndPoint {
	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	
	private static function init_hooks() {
		self::$initiated = true;
		
		add_action('init', 'add_endpoint');
		
	}


 /**
 * @param null
 * @return null
 * @description Create a independent endpoint
 */
	public static function endpoint() {

		global $wp;

    	$endpoint_vars = $wp->query_vars;

    	// if endpoint
    	if ($wp->request == 'exercise/inpsyde') {

        	// Your own function to process endpoint
        	self::processEndPoint();
        	exit;
    	} elseif (isset($endpoint_vars['tracking']) && !empty($endpoint_vars['tracking'])) {
        	$request = [
            'tracking_id' => $endpoint_vars['tracking']
        	];

        	self::processEndPoint($request);
    	} elseif (isset($_GET['utm_source']) && !empty($_GET['utm_source'])){
        	self::processGoogleTracking($_GET);
    	}


	}

 /**
 * @param null
 * @return null
 * @description Create a permalink endpoint for projects tracking
 */
 private static function add_endpoint()
 {

    add_rewrite_endpoint('tracking', EP_PERMALINK | EP_PAGES, true);

 }	


 /**
 * @param null
 * @return null
 * @description process API request and serve json response to HTML Table
 */
 public static function processEndPoint(){
    $request = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );

    if( is_wp_error( $request ) ) {
        return false; // Bail early
    }

  $body = wp_remote_retrieve_body( $request );

  $data = json_decode( $body );
   processRequest::process($data);
 }

}	