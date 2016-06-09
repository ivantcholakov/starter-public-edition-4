# Material Design Icons 
[mervick.github.io/material-design-icons](http://mervick.github.io/material-design-icons/)

Material design icons are the official [icon set](http://www.google.com/design/spec/style/icons.html#icons-system-icons) 
from Google that are designed under the [material design guidelines](http://www.google.com/design/spec).

In the official package the icons uses a typographic feature called [ligatures](http://alistapart.com/article/the-era-of-symbol-fonts), 
which allows rendering of an icon glyph simply by using its textual name.

In this repository also implemented the ability to use the icons in the bootstrap-style, 
like in `glyphicon`, `font-awesome` or `ionicons`.

## Installation

You may install this package using Component, Composer, Bower or npm:
- Component: `component install mervick/material-design-icons`
- Composer: `composer require mervick/material-design-icons`
- Bower: `bower install bootstrap-material-design-icons`
- npm: `npm install bootstrap-material-design-icons`

## Usage 

Add to your html page in the `head` area
```html
<link rel="stylesheet" href="css/material-icons.css">
```

#### There are two ways to use:

- Ligature, this one is awesome but have some troubles
```html
<i class="material-icons">accessibility</i>
<i class="material-icons">3d_rotation</i>
<i class="material-icons">airline_seat_legroom_reduced</i>
```

- Bootstrap-style, 
```html
<i class="mdi mdi-accessibility"></i>
<i class="mdi mdi-3d-rotation"></i>
<i class="mdi mdi-airline-seat-legroom-reduced"></i>
```

Using bootstrap-style, you can also use additional features such as in Font Awesome:
```html
<!-- Inverse -->
<i class="mdi mdi-attachment mdi-inverse"></i>

<!-- Animated --> 
<i class="mdi mdi-attachment mdi-spin"></i>
<i class="mdi mdi-attachment mdi-pulse"></i>

<!-- Fixed width -->
<i class="mdi mdi-attachment mdi-fw"></i>

<!-- Bordered -->
<i class="mdi mdi-attachment mdi-border"></i>

<!-- Pulled -->
<i class="mdi mdi-attachment pull-left"></i>
<i class="mdi mdi-attachment pull-right"></i>

<!-- Sizes -->
<i class="mdi mdi-attachment mdi-lg"></i>
<i class="mdi mdi-attachment mdi-2x"></i>
<i class="mdi mdi-attachment mdi-3x"></i>
<i class="mdi mdi-attachment mdi-4x"></i>
<i class="mdi mdi-attachment mdi-5x"></i>

<!-- Rotations -->
<i class="mdi mdi-attachment mdi-rotate-90"></i>
<i class="mdi mdi-attachment mdi-rotate-180"></i>
<i class="mdi mdi-attachment mdi-rotate-270"></i>

<!-- Flips -->
<i class="mdi mdi-attachment mdi-flip-horizontal"></i>
<i class="mdi mdi-attachment mdi-flip-vertical"></i>

<!-- In lists -->
<ul class="mdi-ul">
    <li><i class="mdi-li mdi mdi-keyboard-arrow-right"></i>Lorem ipsum dolor ...</li>
</ul>
```


##License

- Google Material Design Icons fonts are licensed under the CC-BY-4.0:
  - https://github.com/google/material-design-icons/blob/master/LICENSE
- Bootstrap Material Icons CSS and Sass files are licensed under the MIT License:
  - http://opensource.org/licenses/mit-license.html
