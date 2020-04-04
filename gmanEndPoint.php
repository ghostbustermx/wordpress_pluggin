<?php
/*
Plugin Name: Gman Custom Endpoint
Plugin URI: https://www.venadoblanco.com
Description: Create and make available a custom NOT A REST endpoint "http://localhost/wordpress/exercise/inpsyde". When a visitor navigates to that endpoint, the plugin send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.The plugin will parse the JSON response and will use it to build and display an HTML table.
Version: 0.1.0
Author: German Villegas
Author URI: https://www.venadoblanco.com
License:     GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This progrm is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or  any later version.

This program is distribuited in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. see the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.

Copyright 2005-2015 automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!defined ('ABSPATH')) {
    die;
}



// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define ( 'WP_DEBUG', true);
define ( 'WP_DEBUG_LOG', true);
define ( 'WP_DEBUG_DISPLAY', false);


add_action('parse_request', 'endpoint', 0);
add_action('init', 'add_endpoint');


/**
 * @param null
 * @return null
 * @description Create a independent endpoint
 */
function endpoint()
{
    global $wp;

    $endpoint_vars = $wp->query_vars;

    // if endpoint
    if ($wp->request == 'exercise/inpsyde') {

        // Your own function to process endpoint
        processEndPoint();
        exit;
    } elseif (isset($endpoint_vars['tracking']) && !empty($endpoint_vars['tracking'])) {
        $request = [
            'tracking_id' => $endpoint_vars['tracking']
        ];

        $this->processEndPoint($request);
    } elseif (isset($_GET['utm_source']) && !empty($_GET['utm_source'])){
        $this->processGoogleTracking($_GET);
    }
}

/**
 * @param null
 * @return null
 * @description Create a permalink endpoint for projects tracking
 */
function add_endpoint()
{

    add_rewrite_endpoint('tracking', EP_PERMALINK | EP_PAGES, true);

}

function processEndPoint(){
$request = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );

if( is_wp_error( $request ) ) {
	return false; // Bail early
}

$body = wp_remote_retrieve_body( $request );

$data = json_decode( $body );

//print_r($data);
if( ! empty( $data ) ) {
?>
<style>
#users {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#users td, #users th {
  border: 1px solid #ddd;
  padding: 8px;
}

#users tr:nth-child(even){background-color: #f2f2f2;}

#users tr:hover {background-color: #ddd;}

#users th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
        <table border="1" id="users">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>UserName</th>
            <th>Email</th>
        </tr>
        </thead>    
        <tbody>
        <?php
        foreach($data as $obj){
        ?>
        <tr>
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->id ?> </a> </td> 
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->name ?> </a> </td> 
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->username ?> </a> </td> 
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->email ?> </a> </td> 
        </tr>
        <?php   
        }
        ?>
        </tbody>
        </table>

<style>
#details {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#details td, #details th {
  border: 1px solid #ddd;
  padding: 8px;
}

#details tr:nth-child(even){background-color: #f2f2f2;}

#details tr:hover {background-color: #ddd;}

#details th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4cca50;
  color: white;
}
</style>
<br>
        <table id="details">
				<thead>
					<tr>
						<th>id</th>
						<th>name</th>
						<th>username</th>
						<th>email</th>
						<th>address.street</th>
						<th>address.suite</th>
						<th>address.city</th>
						<th>address.zipcode</th>
						<th>address.geo.lat</th>
						<th>address.geo.lng</th>
						<th>phone</th>
						<th>website</th>
						<th>company.name</th>
					</tr>
				</thead>
				<tbody id="contenido">
					<tr>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
					</tr>
				</tbody>
			</table>

        <script>
        	document.getElementById("details").style.display = "none";
        	var contenido = document.getElementById('contenido');
        	

        	function theApiRequest (param) {

        		var url = 'https://jsonplaceholder.typicode.com/users/'+param;
				var data = {username: 'courseya'};
				fetch(url, {cache: "force-cache"},{
  				method: 'GET', 
  				headers:{
    				'Content-Type': 'application/json'
  				}
				}).then(res => res.json())
				.then( datos => {
					tabla(datos)
				})	 
				;        		
    		}

    		function tabla(datos){

    			var datosJson = JSON.stringify(datos);
    			var x = document.getElementById("details");
    			if (x.style.display === "none") {
        			x.style.display = "block";
    			} else {
        		x.style.display = "block";
    			}

    			for(let valor of datosJson){
    				contenido.innerHTML = '';
    				contenido.innerHTML = `
    				<tr>
						<td>${JSON.stringify(datos.id)}</td>
						<td>${JSON.stringify(datos.name)}</td>
						<td>${JSON.stringify(datos.username)}</td>
						<td>${JSON.stringify(datos.email)}</td>
						<td>${JSON.stringify(datos.address.street)}</td>
						<td>${JSON.stringify(datos.address.suite)}</td>
						<td>${JSON.stringify(datos.address.city)}</td>
						<td>${JSON.stringify(datos.address.zipcode)}</td>
						<td>${JSON.stringify(datos.address.geo.lat)}</td>
						<td>${JSON.stringify(datos.address.geo.lng)}</td>
						<td>${JSON.stringify(datos.phone)}</td>
						<td>${JSON.stringify(datos.website)}</td>
						<td>${JSON.stringify(datos.company.name)}</td>
					</tr>
    			`
    			}
    	}
        </script>	
<?php       
}
}



