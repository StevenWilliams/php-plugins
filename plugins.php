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
 
class Plugins
{
    public $hooks = array(array());
    
    function addToHook($hookname, $callback, $priority)
    {
        $this->hooks[$hookname][] = $callback;
    }
    
    function callHook($hookname, $args = null)
    {
        $returns = array();
        asort($this->hooks[$hookname]);
        foreach ($this->hooks[$hookname] as $val) {
            $returns[] = call_user_func($val, $args);
        }
        return $returns;
    }
    
    function loadPlugins($plugindir)
    {
        $files = glob($plugindir . '/*.{php}', GLOB_BRACE);
        foreach ($files as $file) {
            require_once($file);
        }
    }
}
?>
