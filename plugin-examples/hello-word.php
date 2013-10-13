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
