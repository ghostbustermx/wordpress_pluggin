=== Gman Custom Endpoint ===
Contributors: (German Villegas)
Author URI: https://www.venadoblanco.com
Tags: wordpress, plugin
Requires at least: wordpress 5
Tested up to: 5.3.2
Stable tag: 5.4
Requires PHP: 7.2.4 or later
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Create and make available a custom NOT A REST endpoint "http://localhost/wordpress/exercise/inpsyde". When a visitor navigates to that endpoint, the plugin send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.The plugin will parse the JSON response and will use it to build and display an HTML table.

== Installation ==

This section describes how to install the plugin and get it working.

1. Just upload the plugin files to the `/wp-content/plugins/gman-end-point` directory, or install the plugin through the composer with "composer require german/gman-end-point" command.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. (When installed, the plugin has to make available a custom endpoint on the WordPress site "/exercise/inpsyde". With “custom endpoint” we mean an arbitrary URL not recognized by WP as a standard URL, like a permalink or so.
Note that this is not a REST endpoint. When a visitor navigates to that endpoint, the plugin has to send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.
The plugin will parse the JSON response and will use it to build and display an HTML table. Each row in the HTML table will show the details for a user. The column's id, name, and username are mandatory.
The content of three mandatory columns must be a link (<a> tag). When a visitor clicks any of these links, the details of that user must be shown. For that, the plugin will do another API request to the user-details endpoint.
See https://jsonplaceholder.typicode.com/guide.html for documentation.
These details fetching requests must be asynchronous (AJAX) and the user details will be shown without reloading the page.
At any time, the page will show details for at max one user. In fact, at every link click, a new user detail will load, replacing the one currently shown.
)


== INFO section ==
About to request  HTTP cache, the "function get_api_info()" store in database for up to 12 hours Then, you just need to call get_api_info() anywhere in your code to retrieve the data you need. If you call the function multiple times in the same request/script, it will still only yell out to the database once. If you call the function in multiple requests within a 12 hour period, it will only send the API request once.
Talk about efficiency!.Of course I'd also recommend having a class implementation for this, so you can use instance variables rather than globals to store data; 

For the "user details request" I use fetch to default cache.

The plugin has been testing on browser with a real WP installation: https://www.venadoblanco.com/Barnett_Conwell/exercise/inpsyde, and it's simple, it works!, and it has attention to details.

I use Git to version my code: https://github.com/ghostbustermx/wordpress_pluggin with 3 branches; 
Packagist: https://packagist.org/packages/german/gman-end-point.
Bitbucket: https://bitbucket.org/ghostbustermx/wordpress_pluggin/src/master/.
Youtube video demo: https://www.youtube.com/watch?v=01DC9isS5Mo&feature=youtu.be 
 
It is a simple plugin and has not third party dependences.

Phpunit in wordpress was challenging, I am not familiar with unit tests in wordpress, I hope it is enough to start and continue learning unit tests to wordpress with you.

I really enjoyed this development.

== Markdown ==

Ordered list:

1. The plugin will parse the JSON response and will use it to build and display an HTML table
2. The content of three mandatory columns must be a link (<a> tag)
3. When a visitor clicks any of these links, the details of that user must be shown. For that, the plugin will do another API request to the user-details endpoint.
4. These details fetching requests must be asynchronous (AJAX) and the user details will be shown without reloading the page.


Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: https://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`