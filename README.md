php-plugins
===========

A simple php plugin library. Use this to extend your php application. 
You can use this to make your application modular or allow third-party plugins.

Licensed under the MIT License

Usage
------

To get started require the library file, create a plugin manager object, and load the plugins.
 ```php
//Load the library
require_once('plugins.php');

//Creates a plugin manager object
$PluginManager = new Plugins();

//Tells the plugin manager to load plugins in the directory "plugin-examples"
$PluginManager->loadPlugins('plugin-examples');
 ```

Functions can be defined to hooks. The functions are run when hooks are called.

To add a function to a hook
 ```php
 $PluginManager->addToHook($hookname, $function);
 ```
 
To call a hook:
 ```php
 $PluginManager->callHook($hookname);
 ```


Example
------

Program extended using plugins:
 ```php
<?php
//Load the library
require_once('plugins.php');

//Creates a plugin manager object
$PluginManager = new Plugins();

//Tells the plugin manager to load plugins in the directory "plugin-examples"
$PluginManager->loadPlugins('plugin-examples');

//Calls functions hooked to hook 'start'
$PluginManager->callHook('start');

//Your program here
echo "My Program";

//Calls functions hooked to hook 'end'
$PluginManager->callHook('end');
?>
 ```


Plugin example:
 ```php
 <?php
//Add helloworld() function to 'start' hook in the pluginmanager loading this plugin
$this->addToHook("start", "helloworld");

//Add byeworld() function to 'end' hook
$this->addToHook("end", "byeworld");

function helloworld()
{
	echo "Hello World!";
}

function byeworld() {
	echo "Bye World";
}
?>
 ```
 
 License
------
 
 Licensed under the MIT License.

Copyright (c) 2013 Steven Williams

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
