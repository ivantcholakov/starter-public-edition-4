<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Parser Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Parser
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/parser.html
 */
class CI_Parser extends CI_Driver_Library {

	/**
	 * Initialization parameters
	 *
	 * @var	array
	 */
	public $params = array();

	/**
	 * Valid parser drivers
	 *
	 * @var array
	 */
	protected $valid_drivers = array(
		'parser'
	);

	/**
	 * Reference to the driver
	 *
	 * @var mixed
	 */
	protected $driver;


	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct(array $params = array())
	{
		$CI = &get_instance();

		if ($CI->config->load('parser', TRUE, TRUE))
		{
			$config = $CI->config->item('parser');
		}
		else
		{
			$config = array();
		}

		$tmp_vdrivers = array_map('strtolower', $this->valid_drivers);

		// load up the valid drivers
		$drivers = isset($params['parser_valid_drivers'])
			? $params['parser_valid_drivers']
			: (isset($config['parser_valid_drivers'])
				? $config['parser_valid_drivers']
				: array());

		if ($drivers)
		{
			// Add driver names to valid list
			foreach ((array) $drivers as $driver)
			{
				if ( ! in_array(strtolower($driver), $tmp_vdrivers))
				{
					$this->valid_drivers[] = $driver;
				}
			}
		}

		// Get driver to load
		$driver = isset($params['parser_driver'])
			? $params['parser_driver']
			: (isset($config['parser_driver'])
				? $config['parser_driver']
				: null);

		if ( ! $driver)
		{
			$driver = 'parser';
		}

		// if the driver isn't already in the valid_drivers then we add it here
		if ( ! in_array(strtolower($driver), array_map('strtolower', $tmp_vdrivers)))
		{
			$this->valid_drivers[] = $driver;
		}

		// Save a copy of parameters in case drivers need access
		$this->params = $params;

		// Load driver and get array reference
		$this->driver = $this->load_driver($driver);
	}

	/**
	 * Parse a template
	 *
	 * Parses pseudo-variables contained in the specified template view,
	 * replacing them with the data in the second param. Returns the loaded view
	 * as string
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	// Modified by Ivan Tcholakov, 27-DEC-2013.
	//public function parse($template, $data = array(), $return = FALSE)
	public function parse($template, $data = array(), $return = FALSE, $options = array())
	//
	{
		// Added by Ivan Tcholakov, 28-DEC-2013.
		// Processing an alternative chain of drivers.

		if ($this->is_parser_chain($options))
		{
			$CI = &get_instance();

			$options = $this->parse_options($options);

			if (!empty($options))
			{
				$i = 0;

				foreach ($options as $driver)
				{
					$CI->load->parser($driver['parser']);

					if ($i == 0)
					{
						$template = $CI->{$driver['parser']}->parse($template, $data, true, $driver['options']);
					}
					else
					{
						$template = $CI->{$driver['parser']}->parse_string($template, $data, true, $driver['options']);
					}

					$i++;
				}

				$is_mx = false;

				if (!$return)
				{
					list($CI, $is_mx) = $this->detect_mx();
				}

				return $this->output($template, $return, $CI, $is_mx);
			}
		}

		//

		// Modified by Ivan Tcholakov, 27-DEC-2013.
		//return $this->driver->parse($template, $data, $return);
		return $this->driver->parse($template, $data, $return, $options);
		//
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a String
	 *
	 * Parses pseudo-variables contained in the specified string,
	 * replacing them with the data in the second param
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	// Modified by Ivan Tcholakov, 27-DEC-2013.
	//public function parse_string($template, $data = array(), $return = FALSE)
	public function parse_string($template, $data = array(), $return = FALSE, $options = array())
	//
	{
		// Added by Ivan Tcholakov, 28-DEC-2013.
		// Processing an alternative chain of drivers.

		if ($this->is_parser_chain($options))
		{
			$CI = &get_instance();

			$options = $this->parse_options($options);

			if (!empty($options))
			{
				foreach ($options as $driver)
				{
					$CI->load->parser($driver['parser']);
					$template = $CI->{$driver['parser']}->parse_string($template, $data, true, $driver['options']);
				}

				$is_mx = false;

				if (!$return)
				{
					list($CI, $is_mx) = $this->detect_mx();
				}

				return $this->output($template, $return, $CI, $is_mx);
			}
		}

		//

		// Modified by Ivan Tcholakov, 27-DEC-2013.
		//return $this->driver->parse_string($template, $data, $return);
		return $this->driver->parse_string($template, $data, $return, $options);
		//
	}

	// Added by Ivan Tcholakov, 28-DEC-2013.
	// Renamed by Ivan Tcholakov, 16-JAN-2016.
	public function parse_options($options, $force_return_parser_chain = FALSE)
	{
		if (!is_array($options))
		{
			$options = (string) $options;

			if ($options != '')
			{
				$options = array($options);
			}
			else
			{
				$options = array();
			}
		}

		if ($force_return_parser_chain || $this->is_parser_chain($options))
		{
			return $this->get_parser_chain($options);
		}

		return $options;
	}

	// Added by Ivan Tcholakov, 29-DEC-2013.
	// Renamed by Ivan Tcholakov, 16-JAN-2016.
	public function is_parser_chain($options)
	{
		if (!is_array($options))
		{
			$options = (string) $options;

			if ($options != '')
			{
				$options = array($options);
			}
			else
			{
				$options = array();
			}
		}

		if (empty($options))
		{
			return false;
		}

		foreach ($options as $key => $value)
		{
			if (is_string($key))
			{
				if (!in_array($key, $this->valid_drivers))
				{
					return false;
				}
			}
			elseif (is_string($value))
			{
				if (!in_array($value, $this->valid_drivers))
				{
					return false;
				}
			}
			elseif (!is_array($value))
			{
				return false;
			}
		}

		return true;
	}

	// Added by Ivan Tcholakov, 29-DEC-2013.
	// Renamed by Ivan Tcholakov, 16-JAN-2016.
	protected function get_parser_chain($options)
	{
		$result = array();

		foreach ($options as $driver => $driver_options)
		{
			if (is_string($driver))
			{
				$result[] = array('parser' => $driver, 'options' => $driver_options);
			}
			elseif (is_string($driver_options))
			{
				$result[] = array('parser' => $driver_options, 'options' => array());
			}
		}

		return $result;
	}

	// Added by Ivan Tcholakov, 28-DEC-2013.
	// Adaptation for HMVC by wiredesignz.
	protected function detect_mx()
	{
		$ci = get_instance();
		$is_mx = false;

		foreach (debug_backtrace() as $item)
		{
			$object = isset($item['object']) ? $item['object'] : null;

			if (is_object($object) && @ is_a($object, 'MX_Controller'))
			{
				$ci = $object;
				$is_mx = true;

				break;
			}
		}

		return array($ci, $is_mx);
	}

	// Added by Ivan Tcholakov, 28-DEC-2013.
	// Adaptation for HMVC by wiredesignz.
	protected function output(& $result, $return, $ci, $is_mx)
	{
		if ($return)
		{
			return $result;
		}
		elseif (!$is_mx)
		{
			$ci->output->append_output($result);
		}
		else
		{
			ob_start();

			echo $result;

			if (ob_get_level() > $ci->load->get_ob_level() + 1)
			{
				ob_end_flush();
			}
			else
			{
				$ci->output->append_output(ob_get_clean());
			}
		}
	}

	// Added by Ivan Tcholakov, 12-JAN-2016.
	public function & get_file_extensions($parser_name = null)
	{
		static $extensions = null;

		if ($extensions === null)
		{
			$extensions = array();

			$CI = & get_instance();

			if ($CI->config->load('parser', TRUE, TRUE))
			{
				$config = $CI->config->item('parser');
			}
			else
			{
				$config = array();
			}

			if (!empty($config['parser_file_extensions']) && is_array($config['parser_file_extensions']))
			{
				foreach ($config['parser_file_extensions'] as $key => $value)
				{
					if (!is_array($value))
					{
						$value = (array) $value;
					}

					foreach ($value as & $item)
					{
						$item = ltrim($item, '.');
					}

					unset($item);

					$extensions[$key] = $value;
				}
			}
		}

		$parser_name = (string) $parser_name;

		if ($parser_name == '')
		{
			return $extensions;
		}

		return isset($extensions[$parser_name]) ? $extensions[$parser_name] : array();
	}

	// Added by Ivan Tcholakov, 12-JAN-2016.
	public function & get_parsers_by_file_extensions()
	{
		static $result = null;

		if ($result === null)
		{
			$result = array();
			$all_extensions = & $this->get_file_extensions();

			foreach ($all_extensions as $parser_name => $extensions)
			{
				foreach ($extensions as $extension)
				{
					$result[$extension] = $parser_name;
				}
			}

			// Sort by keys, move the longer extensions to top.
			// This is for ensuring correct extension detection later.
			uksort($result, array($this, '_compare_file_extensions'));
		}

		return $result;
	}

	// Added by Ivan Tcholakov, 15-JAN-2016.
	protected function _compare_file_extensions($a, $b)
	{
		return strlen($b) - strlen($a);
	}

	// Added by Ivan Tcholakov, 12-JAN-2016.
	public function has_file_extension($parser_name)
	{
		$parser_name = (string) $parser_name;
		$all_extensions = & $this->get_file_extensions();

		return !empty($all_extensions[$parser_name]);
	}

	// Added by Ivan Tcholakov, 12-JAN-2016.
	public function detect($file_name, & $detected_extension = null)
	{
		$file_name = (string) $file_name;
		$detected_extension = null;

		$qpos = strpos($file_name, '?');

		if ($qpos !== false) {

			// Eliminate query string.
			$file_name = substr($file_name, 0, $qpos);
		}

		$parsers = & $this->get_parsers_by_file_extensions();

		// Test whether a pure extension was given.
		if (isset($parsers[$file_name]))
		{
			$detected_extension = $file_name;

			return $parsers[$file_name];
		}

		foreach ($parsers as $key => $value)
		{
			if (preg_match('/.*\.('.preg_quote($key).')$/', $file_name, $matches))
			{
				$detected_extension = $matches[1];

				return $value;
			}
		}

		return null;
	}

	// Added by Ivan Tcholakov, 15-JAN-2016.
	public function find_file($file_name, & $detected_parser, & $detected_extension = null)
	{
		$file_name = (string) $file_name;
		$detected_parser = null;
		$detected_extension = null;

		if (is_file($file_name))
		{
			$detected_parser = detect($file_name, $detected_extension);

			if ($detected_parser == '')
			{
				$detected_extension = pathinfo($file_name, PATHINFO_EXTENSION);
			}

			return $file_name;
		}

		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$file_name = pathinfo($file_name, PATHINFO_FILENAME);

		if ($ext === null)
		{
			$parsers = & $this->get_parsers_by_file_extensions();

			foreach ($parsers as $key => $value)
			{
				$f = $file_name.'.'.$key;

				if (is_file($f))
				{
					$detected_parser = $value;
					$detected_extension = $key;

					return $f;
				}
			}

			$f = $file_name.'.php';

			if (is_file($f))
			{
				$detected_extension = 'php';

				return $f;
			}
		}

		return null;
	}

	/**
	 * __get magic method
	 *
	 * Any property references to the parser driver will default to calling the specified
	 * adapter
	 *
	 * @param	string
	 * @return	mixed
	 */
	public function __get($name)
	{
		if (property_exists($this->driver, $name))
		{
			return $this->driver->{$name};
		}

		return NULL;
	}

	/**
	 * __call magic method
	 *
	 * Any call to the parser driver will default to calling the specified adapter
	 *
	 * @param	string
	 * @param	array
	 * @return	mixed
	 */
	public function __call($method, $args = array())
	{
		if (method_exists($this->driver, $method))
		{
			return call_user_func_array(array($this->driver, $method), $args);
		}

		return NULL;
	}
}

/**
 * CI_Parser_driver Class
 *
 * Extend this class to make a new CI_Parser driver
 * Making a new driver is fairly simple, the only two methods required are parse and parse_string.
 *
 * The parse method will parse the specified file with the given data and will either
 * return the parsed data or output data to the browser (using echo, print, printf, by appending
 * the output to the CI output class, etc...)
 *
 * The parse_string method does the same thing the parse method does except that it parses
 * a given string and not a file.
 *
 * Due to the nature of how CI drivers are loaded, you can't access the "parent" drivers
 * properties in the constructor of your driver. However, if you overload the initialize
 * method then you can init your class AND use the "parent" drivers properties.
 *
 * Parse and parse_string MUST be defined in the new driver or else a php fatal error will be
 * thrown due to the nature of abstract methods. If it's not feasible for your parser driver
 * to support this functionality, then define each method to return true.
 * e.g.
 * public function parse($template, $data = array(), $return = FALSE){return TRUE;}
 * public function parse_string($template, $data = array(), $return = FALSE){return TRUE;}
 *
 * @package     CodeIgniter
 * @author      EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license     http://opensource.org/licenses/MIT    MIT License
 * @link        https://codeigniter.com
 */
abstract class CI_Parser_driver extends CI_Driver {

	/**
	 * Parse a template file
	 *
	 * Parses pseudo-variables contained in the specified template view,
	 * replacing them with the data in the second param. Thrid param specifies
	 * wheter or not to return data or echo for output.
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	// Modified by Ivan Tcholakov, 27-DEC-2013.
	//abstract public function parse($template, $data = array(), $return = FALSE);
	abstract public function parse($template, $data = array(), $return = FALSE, $options = array());
	//

	/**
	 * Parse a template string
	 *
	 * Parses pseudo-variables contained in the specified template string,
	 * replacing them with the data in the second param. Thrid param specifies
	 * wheter or not to return data or echo for output. Can be very useful for templates
	 * stored in a database
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	// Modified by Ivan Tcholakov, 27-DEC-2013.
	// abstract public function parse_string($template, $data = array(), $return = FALSE);
	abstract public function parse_string($template, $data = array(), $return = FALSE, $options = array());
	//

	/**
	 * Initialize driver
	 *
	 * @return	void
	 */
	protected function initialize()
	{
		// Overload this method to implement initialization
	}

	/**
	 * Decorate
	 *
	 * Decorates the child with the parent driver lib's methods and properties
	 *
	 * @param	object	Parent library object
	 * @return	void
	 */
	public function decorate($parent)
	{
		// Call base class decorate first
		parent::decorate($parent);

		// Call initialize method now that driver has access to $this->_parent
		$this->initialize();
	}

	// Added by Ivan Tcholakov, 28-DEC-2013.
	// Adaptation for HMVC by wiredesignz.
	protected function detect_mx()
	{
		$ci = get_instance();
		$is_mx = false;

		foreach (debug_backtrace() as $item)
		{
			$object = isset($item['object']) ? $item['object'] : null;

			if (is_object($object) && @ is_a($object, 'MX_Controller'))
			{
				$ci = $object;
				$is_mx = true;

				break;
			}
		}

		return array($ci, $is_mx);
	}

	// Added by Ivan Tcholakov, 28-DEC-2013.
	// Adaptation for HMVC by wiredesignz.
	protected function output(& $result, $return, $ci, $is_mx)
	{
		if ($return)
		{
			return $result;
		}
		elseif (!$is_mx)
		{
			$ci->output->append_output($result);
		}
		else
		{
			ob_start();

			echo $result;

			if (ob_get_level() > $ci->load->get_ob_level() + 1)
			{
				ob_end_flush();
			}
			else
			{
				$ci->output->append_output(ob_get_clean());
			}
		}
	}

}
