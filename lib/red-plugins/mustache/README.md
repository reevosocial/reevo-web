Mustache templating for Elgg
============================
![Elgg 2.0](https://img.shields.io/badge/Elgg-2.0.x-orange.svg?style=flat-square)


## Features

* Templates can be rendered both client and server side
* Compatible with Elgg's view system
* AMD-friendly


## Usage

1. Create a new template as an Elgg view

```html

// /my_plugin/views/default/path/to/template.html
<div class="mustache-template">
	<h3>Hello, <b>{{name}}</b></h3>
</div>
```

You can also use PHP views, e.g. `template.html.php`. This allows you
to call other views and do stuff with PHP. If you use this approach, be
sure to register the template views in simplecache, so that they are
accessible with AMD.

```php

// /start.php
elgg_register_simplecache_view('path/to/template.html.php');
```

```html

// /my_plugin/views/default/path/to/template.html.php
<div class="mustache-template">
	<h3>Hello, <b>{{name}}</b></h3>
	<?= elgg_view('path/to/other/template.html') ?>
</div>
```

2. Render server-side

```php

	echo mustache()->render(elgg_view('mustache/template.html'), array(
		'name' => elgg_get_logged_in_user_entity()->name,
	));
```

3. Render client-side

```js

define(function(require) {

	var elgg = require('elgg');
	var mustache = require('mustache');
	var template = require('text!mustache/template.html');

	var view = mustache.render(template, {
		name: elgg.get_logged_in_user_entity().name
	});

	$('body').html(view);

});
```


## Docs

* mustache.js https://github.com/janl/mustache.js
* PHP Mustache https://github.com/bobthecow/mustache.php