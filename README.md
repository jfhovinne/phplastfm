# phplastfm
Last.fm PHP client

## Install

```
$ composer install
```

## Usage

First get a Last.fm API key, see http://www.last.fm/api

Then, instantiate the client by passing the API key:

```
<?php
require __DIR__ . '/../vendor/autoload.php';

use Lastfm\Client as LastfmClient;

$lastfmclient = new LastfmClient('your_secret_api_key');
```

To call a Last.fm API method and get the results in JSON, use `callMethod($methodName, $parameters)`.

```
$json = $lastfmclient->callMethod('user.getTopTracks', ['user' => 'lastfm_username', 'limit' => '20']);

if (isset($json->error)) {
  echo($json->message);
} else {
  foreach($json->toptracks->track as $track) {
    echo($track->artist->name . ' - ' . $track->name . "\n");
  }
}
```
