# Google APIs Client Library for CakePHP #

## Description ##
The Google API Client Library enables you to work with Google APIs such as Google+, Drive, or YouTube on your server. And this plugin facilitates its integration into CakePHP.

The pull-request are accepted.
You can send me a e-mail or private message.

## Requirements ##
* For [Google API Client Library](https://github.com/google/google-api-php-client)
	* [PHP 5.2.1 or higher](http://www.php.net/)
	* [PHP JSON extension](http://php.net/manual/en/book.json.php)
* For my plugin
	* Nothing more

## Developer Documentation ##
http://developers.google.com/api-client-library/php
See the bottom of the page for the plugin documentation

## Installation ##
The plugin is pretty easy to set up, all you need to do is to copy it to you application plugins folder.
Be careful, it is important that the plugin is named GoogleAPI (app/Plugin/GoogleAPI)

## Configuration ##
Create the file Plugin/GoogleAPI/core.php use core.php.default as template.
The minimals options ares:
* client.ApplicationName: Your app name
* client.DeveloperKey: You developer key.
They are defined even if the configuration file is empty

You can define options in core.php and in controller when you add the component.
The priority is:
* Default configuration
* File core.php
* Components definition

## Basic Example ##
A basic use in a controller
```PHP
<?php
App::uses('AppController', 'Controller');
class TestsController extends AppController
{
	public $components = array(
		'GoogleAPI.GoogleAPI' => array(
			'Service' => array(
				'YouTube'
			)
		)
	);
	
	public function index() {
		$yt = & $this->GoogleAPI->Service['YouTube'];
		$results = $yt->videos->listVideos('snippet', array(
			'chart' => 'mostPopular'
		));
		foreach ($results['items'] as $item) {
			echo $item['snippet']['title'] . "<br /> \n";
		}
	}
}
```

## Documentation ##

### Basic uses ###
To load a service put this in your $components value.
```PHP
public $components = array(
	'GoogleAPI.GoogleAPI' => array(
		'Service' => array(
			'YouTube'
		)
	)
);
```
You can load multiple services at the same time, in this case the same client will be used.
Then use the array Service to use the API.
Use the google api documentation for list of available functions.
```PHP
$this->GoogleAPI->Service['YouTube'];
```

This is the basic exemple from google api github
```PHP
<?php
  require_once 'Google/Client.php';
  require_once 'Google/Service/Books.php';
  $client = new Google_Client();
  $client->setApplicationName("Client_Library_Examples");
  $client->setDeveloperKey("YOUR_APP_KEY");
  $service = new Google_Service_Books($client);
  $optParams = array('filter' => 'free-ebooks');
  $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

  foreach ($results as $item) {
    echo $item['volumeInfo']['title'], "<br /> \n";
  }
```
To get the same with my plugin (define Books service in components)
```PHP
$optParams = array('filter' => 'free-ebooks');
$results = $this->GoogleAPI->Service['Books']->volumes->listVolumes('Henry David Thoreau', $optParams);
foreach ($results as $item) {
	echo $item['volumeInfo']['title'], "<br /> \n";
}
```

### Advanced uses ###
If you want to manually load classes, use this function:
```PHP
GoogleAPI::import('Google/Client');
```
