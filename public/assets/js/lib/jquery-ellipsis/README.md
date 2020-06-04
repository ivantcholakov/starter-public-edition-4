Ellipsis
========

Ellipsis is a set of JavaScript plugins I created to emulate `text-overflow: ellipsis;` before it was implemented in [modern browsers](https://developer.mozilla.org/en-US/docs/Web/CSS/text-overflow).

## Why would I use this now? ##

The benefits that this library still offers over simply using CSS (as of 4/4/2014) are:
* uses native (`text-overflow: ellipsis;`) support when possible
* offers a fallback if native support isn't available
* supports multi-line overflow handling (e.g. 3 lines then …)

## Demos ##

http://danbeam.org/ellipsis/jquery (jQuery)<br>
http://danbeam.org/ellipsis/yui (YUI)

## Configuration ##

You can pass a few things to the plugin to change how it behaves.  Here are the parameters and their defaults:

```js
.ellipsis({
  'lines'    : 1,         // the number of lines before truncating
  'ellipsis' : '\u2026',  // the truncation character to use
  'fudge'    : 0,         // the number of extra characters to remove
  'remember' : true,      // whether or not to save the text before truncating (useful when resizing)
  'native'   : true       // whether to use native browser support when it exists
});
```

## Examples ##

### jQuery ###

```html
<span class=ellipsis>Lots and lots of text!</span>
<script src=jquery.js></script>
<script src=jquery.ellipsis.js>
  function ellipsize() { $('.ellipsis').ellipsis(); }
  $(ellipsize);  // when document is ready
  $(window).on('resize', ellipsize);  // on resize
</script>
```

### YUI ###

```html
<span class=ellipsis>Lots and lots of text!</span>
<script src=yui-loader.js></script>
<script>
  // there's already a gallery module, so you can juse use 'gallery-ellipsis'.
  YUI().use('gallery-ellipsis', function(Y) {
    function ellipsize() { Y.all('.ellipsis').ellipsis(); }
    Y.on(['domready', 'windowresize'], ellipsize);
  });
</script>
```

There's a few more examples on the [YUI gallery page](http://yuilibrary.com/gallery/show/ellipsis) as well.
