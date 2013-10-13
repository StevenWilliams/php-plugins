php-plugins
===========

A simple php plugin library. Use this to extend your php application. 
You can use this to make your application modular or allow third-party plugins.

Licensed under the MIT License

Usage
=======

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
========

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
