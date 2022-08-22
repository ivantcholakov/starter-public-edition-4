[![PHPUnit](https://github.com/salesforce/handlebars-php/actions/workflows/ci.yml/badge.svg)](https://github.com/salesforce/handlebars-php/actions/workflows/ci.yml)

---

#handlebars-php

---

#### A simple, logic-less, yet powerful templating engine for PHP

---

Name: **handlebars-php**

License: MIT

Requirements: PHP >= 5.4

---


## About Handlebars

Handlebars provides the power necessary to let you build semantic templates effectively with no frustration,
that keep the view and the code separated like we all know they should be.


Fork of: [Handlebars.php by XaminProject](https://github.com/mardix/Handlebars)

Handlebars, is the PHP port of [Handlebars.js](http://handlebarsjs.com/)

---

## Install Handlebars


You can just download Handlebars.php as is, or with Composer.

To install with composer, add the following in the require key in your **composer.json** file

`"salesforce/handlebars-php": "1.*"`

composer.json

```json
{
    "name": "myapp/name",
    "description": "My awesome app name",
    "require": {
        "salesforce/handlebars-php": "1.*"
    }
}
```

-----

## Getting Started

At the minimum, we are required to have an array model and a template string. Alternatively we can have a file containing handlebars (or html, text, etc) expression.



#### Template

Handlebars templates look like regular HTML, with embedded handlebars expressions.

Handlebars HTML-escapes values returned by a {{expression}}.

```html
<div class="entry">
  <h1>{{title}}</h1>
  <div class="body">
    Hello, my name is {{name}}
  </div>
</div>
```

The string above can be used as is in your PHP file, or be put in a file (ie: */templates/main.tpl*), to be called upon rendering.

#### PHP file

Now the we've created our template file, in a php file (index.php) we'll create the data to passed to the model. The model is a key/value array.

Below we are going to create the Handlebars object, set the partials loader, and put some data in the model.

**/index.php**

```php
<?php

# With composer we can autoload the Handlebars package
require_once ("./vendor/autoload.php");

# If not using composer, you can still load it manually.
# require 'src/Handlebars/Autoloader.php';
# Handlebars\Autoloader::register();

use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;

# Set the partials files
$partialsDir = __DIR__."/templates";
$partialsLoader = new FilesystemLoader($partialsDir,
    [
        "extension" => "html"
    ]
);

# We'll use $handlebars throughout this the examples, assuming the will be all set this way
$handlebars = new Handlebars([
    "loader" => $partialsLoader,
    "partials_loader" => $partialsLoader
]);

# Will render the model to the templates/main.tpl template
$model = [...];
echo $handlebars->render("main", $model);
```

#### Assign Data

The simplest way to assign data is to create an Array model. The model will contain all the data that will be passed to the template.
```php
<?php

$model = [
    "name" => "Yolo Baggins",
    "title" => "I'm Title",
    "permalink" => "blog/",
    "foo" => "bar",
    "article" => [
        "title" => "My Article Title"
    ],
    "posts" => [
        [
            "title" => "Post #1",
            "id" => 1,
            "content" => "Content"
        ],
        [
            "title" => "Post 2",
            "id" => 2,
            "content" => "Content"
        ]
    ]
];
```

#### Render Template

Use the method `Handlebars\Handlebars::render($template, $model)` to render you template once everything is created.

***$template*** : Template can be the name of the file or a string containing the handlebars/html.

***$model*** : Is the array that we will pass into the template

The code below will render the model to the *templates/main.tpl* template

```php
echo $handlebars->render("main", $model);
```


Alternatively you can use $handlebars itself without invoking the render method

```php
echo $handlebars("main", $model);
```

---

## Expressions

Let's use this simple model for the following examples, assuming everything is already set like above.

```php
<?php

$model = [
    "title" => "I'm Title",
    "permalink" => "/blog/",
    "foo" => "bar",
    "article" => [
        "title" => "My Article Title"
    ],
    "posts" => [
        [
            "title" => "Post #1",
            "id" => 1,
            "content" => "Content"
        ],
        [
            "title" => "Post 2",
            "id" => 2,
            "content" => "Content"
        ]
    ]
];
```

Let's work with the template.

Handlebars expressions are the basic unit of a Handlebars template. You can use them alone in a {{mustache}}, pass them to a Handlebars helper, or use them as values in hash arguments.


The simplest Handlebars expression is a simple identifier:

```html
{{title}}

-> I'm Title
```

Handlebars nested expressions which are dot-separated paths.

```html
{{article.title}}

-> My Article Title
```

Handlebars nested expressions in an array.

```html
{{posts.0.title}}

-> Post #1
```

Handlebars also allows for name conflict resolution between helpers and data fields via a this reference:

```html
{{./name}} or {{this/name}} or {{this.name}}
```

Handlebars expressions with a helper. In this case we're using the upper helper

```html
{{#upper title}}

-> I'M TITLE
```

Nested handlebars paths can also include ../ segments, which evaluate their paths against a parent context.

```html
{{#each posts}}
    <a href="/posts/{{../permalink}}/{{id}}">{{title}}</a>
    {{content}}
{{/each}}
```

Handlebars HTML-escapes values returned by a {{expression}}. If you don't want Handlebars to escape a value, use the "triple-stash", {{{ }}}

```html
{{{foo}}}
```

---


## Control Structures

`if/else` and `unless` control structures are implemented as regular Handlebars helpers

### IF/ELSE

You can use the if helper to conditionally render a block. If its argument returns false, null, "" or [] (a "falsy" value), Handlebars will not render the block.

**Example**

```html
{{#if isActive}}
    This part will be shown if it is active
{{else}}
    This part will not show if isActive is true
{{/if}}
```

```php
<?php

$model = [
    "isActive" => true
];

echo $handlebars->render($template, $model);
```

### UNLESS

You can use the unless helper as the inverse of the if helper. Its block will be rendered if the expression returns a falsy value.

```html
{{#unless isActive}}
    This part will not show if isActive is true
{{/unless}}
```

---
##Iterators: EACH

You can iterate over a list using the built-in each helper. Inside the block, you can use {{this}} or {{.}} to reference the element being iterated over.

**Example**

```html
<h2>All genres:</h2>
{{#each genres}}
    {{.}}
{{/each}}


{{#each cars}}
    <h3>{{category}}</h3>
    Total: {{count}}
    <ul>
    {{#each list}}
        {{.}}
    {{/each}}
    </ul>
{{/each}}
```

```php
<?php

$model = [
    "genres" => [
        "Hip-Hop",
        "Rap",
        "Techno",
        "Country"
    ],
    "cars" => [
        "category" => "Foreign",
        "count" => 4,
        "list" => [
            "Toyota",
            "Kia",
            "Honda",
            "Mazda"
        ],
        "category" => "WTF",
        "count" => 1,
        "list" => [
            "Fiat"
        ],
        "category" => "Luxury",
        "count" => 2,
        "list" => [
            "Mercedes Benz",
            "BMW"
        ]
    ],
];

    echo $engine->render($template, $model);    
```

### EACH/ELSE

You can optionally provide an {{else}} section which will display only when the list is empty.

```html
<h2>All genres:</h2>
{{#each genres}}
    {{.}}
{{else}}
    No genres found!
{{/each}}
```

### Slice EACH Array[start:end]

The #each helper (php only) also has the ability to slice the data

 * {{#each Array[start:end]}} = starts at start through end -1
 * {{#each Array[start:]}} = Starts at start though the rest of the array
 * {{#each Array[:end]}} = Starts at the beginning through end -1
 * {{#each Array[:]}} = A copy of the whole array
 * {{#each Array[-1]}}
 * {{#each Array[-2:]}} = Last two items
 * {{#each Array[:-2]}} = Everything except last two items

```html
<h2>All genres:</h2>
{{#each genres[0:10]}}
    {{.}}
{{else}}
    No genres found!
{{/each}}
```

#### {{@INDEX}} and {{@KEY}}

When looping through items in each, you can optionally reference the current loop index via {{@index}}

```html
{{#each array}}
  {{@index}}: {{this}}
{{/each}}


{{#each object}}
  {{@key}}: {{this}}
{{/each}}
```

---

## Change Context: WITH

You can shift the context for a section of a template by using the built-in with block helper.

```php
<?php

$model = [
    "genres" => [
        "Hip-Hop",
        "Rap",
        "Techno",
        "Country"
    ],
    "other_genres" => [
        "genres" => [
        "Hip-Hop",
        "Rap",
        "Techno",
        "Country"
        ]
]
];
```

```html
<h2>All genres:</h2>
{{#with other_genres}}
{{#each genres}}
    {{.}}
{{/each}}
{{/with}}
```

---

## Handlebars Built-in Helpers

### If
```html
{{#if isActive}}
    This part will be shown if it is active
{{else}}
    This part will not show if isActive is true
{{/if}}
```

### Unless
```html
{{#unless isActive}}
    This part will show when isActive is false
{{else}}
    Otherwise this one will show
{{/unless}}
```

### Each
```html
{{#each genres[0:10]}}
    {{.}}
{{else}}
    No genres found!
{{/each}}
```

### With
```html
{{#with other_genres}}
{{#each genres}}
    {{.}}
{{/each}}
{{/with}}
```

---

## Other Helpers

#### For convenience, Voodoo\Handlebars added some extra helpers.

---

### Upper

To format string to uppercase
```html
{{#upper title}}
```

### Lower

To format string to lowercase
```html
{{#lower title}}
```


### Capitalize

To capitalize the first letter
```html
{{#capitalize title}}
```

### Capitalize_Words

To capitalize each words in a string
```html
{{#capitalize_words title}}
```

### Reverse

To reverse the order of string
```html
{{#reverse title}}
```

### Format_Date

To format date: `{{#format_date date '$format'}}`
```html
{{#format_date date 'Y-m-d H:i:s'}}
```

### Inflect

To singularize or plurialize words based on count `{{#inflect count $singular $plurial}}`
```html
{{#inflect count '%d book' '%d books'}}
```

### Truncate

To truncate a string: `{{#truncate title $length $ellipsis}}`
```html
{{#truncate title 21 '...'}}
```

### Default

To use a default value if  the string is empty: `{{#default title $defaultValue}}`
```html
{{#default title 'No title'}}
```

### Raw

This helper return handlebars expression as is. The expression will not be parsed
```html
{{#raw}}
    {{#each cars}}
        {{model}}
    {{/each}}
{{/raw}}

->

{{#each cars}}
    {{model}}
{{/each}}
```


### Repeat

To truncate a string: `{{#repeat $count}}{{/repeat}}`
```html
{{#repeat 5}}
    Hello World!
{{/repeat}}
```

Variable and blocks can still be used
```html
{{#repeat 5}}
    Hello {{name}}!
{{/repeat}}
```


### Define/Invoke

Allow to define a block of content and use it later. It helps follow the DRY (Don't repeat yourself) principle.


Define
```html
{{#define $definedName}}
    content
{{/define}}
```

Invoke
```html
{{#invoke $definedName}}
```


Example:
```html
{{#define hello}}
    Hello World! How do you do?
{{/define}}

{{#invoke hello}}

->

Hello World! How do you do?
```

---

### Template Comments
You can use comments in your handlebars code just as you would in your code. Since there is generally some level of logic, this is a good practice.

```html
{{!-- only output this author names if an author exists --}}
```

---

### Partials

Partials are other templates you can include inside of the main template.

To do so:

```html
{{> my_partial}}
```

which is a file under /templates/my_partial.html

---

## Writing your own helpers

Block helpers make it possible to define custom iterators and other helpers that can invoke the passed block with a new context.

To create your own helper, use the method: `Handlebars::addHelper($name, $callback)`

The following helper will UPPERCASE a string

```php
$handlebars->addHelper("upper",
    function($template, $context, $args, $source){
        return strtoupper($context->get($args));
    }
);
```

And now we can use the helper like this:

```html
{{#upper title}}
```

---

## Data Variables for #each

In Handlebars JS v1.1, data variables `@first` and `@last` were added for the #each helper. Due to the these variables
not being backwards compatible, these data variables are disabled by default and must be enabled manually.

To enable the new data variables, set the `enableDataVariables` option to `true` when instantiating the Handlebars
instance.

```php
$handlebars = new Handlebars([
    "loader" => $partialsLoader,
    "partials_loader" => $partialsLoader,
    "enableDataVariables" => true
]);
``` 

Given the following template and data:
```
{{#each data}}{{#if @first}}FIRST: {{/if}}{{this}}<br>{{/each}}
```
```php
'data' => ['apple', 'banana', 'carrot', 'zucchini']
```
The output will be
```html
FIRST: apple<br>banana<br>carrot<br>zucchini<br>
```

Given the following template and the data above:
```
{{#each data}}{{@first}}: {{this}}<br>{{/each}}
```
The output will be
```html
true: apple<br>banana<br>carrot<br>zucchini<br>
```

Data variables also support relative referencing within multiple #each statements.
Given
```
{{#each data}}{{#each this}}outer: {{@../first}},inner: {{@first}};{{/each}}{{/each}}
```
```php
'data' => [['apple', 'banana'], ['carrot', 'zucchini']]
```
The output will be 
```
outer: true,inner: true;outer: true,inner: false;outer: false,inner: true;outer: false,inner: false;
```

Be aware that when data variables are enabled, variables starting with `@` are considered restricted and will override
values specified in the data.

For example, given the following template and the following data, the output will be different depending on if data
variables are enabled.

```
{{#each objects}}{{@first}}, {{@last}}, {{@index}}, {{@unknown}}{{/each}}
```

```php
$object = new stdClass;
$object->{'@first'} = 'apple';
$object->{'@last'} = 'banana';
$object->{'@index'} = 'carrot';
$object->{'@unknown'} = 'zucchini';
$data = ['objects' => [$object]];

$engine = new \Handlebars\Handlebars(array(
    'loader' => new \Handlebars\Loader\StringLoader(),
    'helpers' => new \Handlebars\Helpers(),
    'enableDataVariables'=> $enabled,
));
$engine->render($template, $data)
``` 

When `enableDataVariables` is `false`, existing behavior is not changed where some variables will be return. 

```
apple, banana, 0, zucchini
```


When `enableDataVariables` is `true`, the behavior matches HandlebarsJS 1.1 behavior, where all data variables replace
variables defined in the data and any data variable prefixed with `@` that is unknown will be blank.

```
true, true, 0,
```


#### Credits

* Fork of [Handlebars.php by XaminProject](https://github.com/XaminProject/handlebars.php)
* The documentation was edited by [Mardix](http://github.com/mardix).

#### Contribution

Contributions are more than welcome!