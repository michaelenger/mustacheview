# Mustache View

Tiny bundle for [Laravel](http://laravel.com/) which allows you to use the [mustache template language](http://mustache.github.com/) for your views. It uses the mustache.php class built by [bobthecow](https://github.com/bobthecow/mustache.php) and renders files with the extension ".mustache".

## Installaton

Installing the bundle is done in 3 easy steps:

 1. Download the source
 2. Copy `Mustache` into `/bundles`
 3. Register the bundle
 4. Change the view alias
 5. Bind Event listener

### Download

Download/clone the source into your __bundles__ directory.

### Bundle Registration

Register the bundle in your __application/bundles.php__ file.

	'Mustache' => array(
	    'autoloads' => array(
	        'namespaces' => array(
	            'Mustache' => '(:bundle)'
	        )
	    )

### Change View Alias

This view extends the Laravel\View class and replaces it to provide mustache functionality, so you'll need to modify your __application/config/application.php__ file, replacing the 'View' alias with one that points to the mustache view.

	'aliases' => array(
		...
		'View' => 'Mustache\\View',
	)

### Bind Event Listener

In order to avoid modifying laravel's default view class more than necessary, Mustache will bind the the laravel.composing event. This also preserves support for blade.php files. Add the following to the end of your __application/start.php__ file.

	Mustache\Mustache::Comb();

## Usage

The view should work like any other view, other than the fact that you use mustache files (with the file extension '.mustache') to build your templates rather than PHP files. This does mean that none of the helper functions are available, so build your controllers accordingly.

For information about the mustache syntax, see the manual: [mustache(5)](http://mustache.github.com/mustache.5.html)

## License

Copyright (c) 2012 The Lonely Coder

This software is provided 'as-is', without any express or implied warranty. In no event will the authors be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial applications, and to alter it and redistribute it freely, subject to the following restrictions:

 * The origin of this software must not be misrepresented; you must not claim that you wrote the original software. If you use this software in a product, an acknowledgment in the product documentation would be appreciated but is not required.
 * Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.
 * This notice may not be removed or altered from any source distribution.
