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
