Multiplayer
===========

A tiny library to build nice HTML embed codes for videos.

Example
-------

```php
$Multiplayer = new Multiplayer\Multiplayer();
$options = array(
	'autoPlay' => true,
	'foregroundColor' => 'BADA55'
);

echo $Multiplayer->html('http://www.dailymotion.com/video/xzn5qk', $options);
echo $Multiplayer->html('http://vimeo.com/47457051', $options);
echo $Multiplayer->html('http://www.youtube.com/watch?v=3qSMS4c5WAk', $options);
```

This code would produce:

```html
<iframe src="http://www.dailymotion.com/embed/video/xzn5qk?autoplay=1&foreground=#BADA55" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<iframe src="http://player.vimeo.com/video/47457051?autoplay=1&color=BADA55" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<iframe src="http://www.youtube-nocookie.com/embed/3qSMS4c5WAk?autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
```
 
Templating
----------

You can customize the generated HTML code by passing a templating function:

```php
echo $Multiplayer->html($url, $options, function($playerUrl) {
    return '<iframe src="' . $playerUrl . '" class="video-player">'
});
```

A default one can also be set on instanciation:

```php
new Multiplayer\Multiplayer($services, function($playerUrl) {
    return '<iframe src="' . $playerUrl . '" class="video-player">'
});
```
