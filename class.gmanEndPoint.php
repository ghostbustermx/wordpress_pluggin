<?php
define( 'HOURS', 60 * 60 );

class gmanEndPoint {
	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	
	public static function init_hooks() {
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

	 $response = self::get_api_info();
	 processRequest::process($response);


 }

	private static function get_api_info() {
		global $apiInfo; // Check if it's in the runtime cache (saves database calls)
		if( empty($apiInfo) ) $apiInfo = get_transient('api_info'); // Check database (saves expensive HTTP requests)
		if( !empty($apiInfo) ) return $apiInfo;

		$response = wp_remote_get('https://jsonplaceholder.typicode.com/users');
		$data = wp_remote_retrieve_body($response);

		if( empty($data) ) return false;

		$apiInfo = json_decode($data); // Load data into runtime cache
		set_transient( 'api_info', $apiInfo, 12 * HOURS ); // Store in database for up to 12 hours

		return $apiInfo;
	}

}	