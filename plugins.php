<?php
/**
 * This is a simple library to add plugin support to your PHP application
 * 
 * Copyright (c) 2013 Steven Williams
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the 
 * Software is furnished to do so, subject to the following conditions:
 *  
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *  
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING 
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
 * DEALINGS IN THE SOFTWARE.
 * 
 * @package    Php-Plugins
 * @author     Steven Williams <https://github.com/StevenWilliams>
 * @license    http://opensource.org/licenses/MIT  Mit License
 * @version    1.0
 * @link       https://github.com/StevenWilliams/php-plugins
 */
<?php
class Plugins
{
    private $hooks;
    
    public function addToHook($hookname, $callback, $priority=10)
    {
		if(function_exists($callback))
		{	
			if(is_callable($callback))
			{
				$this->hooks[$hookname][] = array("callback"=>$callback, "priority"=>$priority);
			} else {
				trigger_error("Function '$callback' attempted to be defined for hook '$hookname' cannot be called!", E_USER_WARNING);
			}
		} else {
			trigger_error("Function '$callback' attempted to be defined for hook '$hookname' does not exist!", E_USER_WARNING);
		}
    }
    
    public function callHook($hookname, $args = null)
    {
		$callbacks = $this->sortPriority($hookname);
        $returns = array();
        if(isset($callbacks))
        {
			foreach ($callbacks as $val) {
				if(function_exists($val))
				{
					if(is_callable($val))
					{
					$returns[] = call_user_func($val, $args);
					} else {
						trigger_error("Function '$val' defined for hook '$hookname' cannot be called!", E_USER_WARNING);
					}
				} else {
					trigger_error("Function '$val' defined for hook '$hookname' does not exist!", E_USER_WARNING);
				}
			}
			return $returns;
		} else {
			trigger_error("No callbacks defined for hook '$hookname'!", E_USER_NOTICE);
		}
    }
	private function sortPriority($hookname)
	{
		$prio = array();
		$callb = array();
		foreach ($this->hooks[$hookname] as $val) {
			$prio[] = $val["priority"];
			$callb[] = $val["callback"];
		}
			array_multisort($prio,$callb);
			return $callb;
	}
    public function loadPlugins($plugindir)
    {
		if(file_exists($plugindir))
		{
			$files = glob($plugindir . '/*.{php}', GLOB_BRACE);
			if(count($files) != 0)
			{
				foreach ($files as $file) {
					require_once($file);
				}
			} else {
				trigger_error("No plugins found in plugin directory '$plugindir'!", E_USER_NOTICE);
			}
		} else {
			trigger_error("Plugin directory '$plugindir' does not exists!", E_USER_WARNING);
		}
    }
}

?>
