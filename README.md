=== Gman Custom Endpoint ===
Contributors: (German Villegas)
Author URI: https://www.venadoblanco.com
Tags: comments, spam
Requires at least: wordpress 5.3
Tested up to: 5.3.2
Stable tag: 5.4
Requires PHP: 7.2.4 or later
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Create and make available a custom NOT A REST endpoint "http://localhost:8888/wordpress/exercise/inpsyde". When a visitor navigates to that endpoint, the plugin send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.The plugin will parse the JSON response and will use it to build and display an HTML table.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/gman-end-point` directory, or install the plugin through the composer with "composer require german/gman-end-point" command.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. (When installed, the plugin has to make available a custom endpoint on the WordPress site. With “custom endpoint” we mean an arbitrary URL not recognized by WP as a standard URL, like a permalink or so.
Note that this is not a REST endpoint. When a visitor navigates to that endpoint, the plugin has to send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.
The plugin will parse the JSON response and will use it to build and display an HTML table. Each row in the HTML table will show the details for a user. The column's id, name, and username are mandatory.
The content of three mandatory columns must be a link (<a> tag). When a visitor clicks any of these links, the details of that user must be shown. For that, the plugin will do another API request to the user-details endpoint.
See https://jsonplaceholder.typicode.com/guide.html for documentation.
These details fetching requests must be asynchronous (AJAX) and the user details will be shown without reloading the page.
At any time, the page will show details for at max one user. In fact, at every link click, a new user detail will load, replacing the one currently shown.
)



== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

Git to version my code is: https://github.com/ghostbustermx/wordpress_pluggin; Packagist is: https://packagist.org/packages/german/gman-end-point 

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