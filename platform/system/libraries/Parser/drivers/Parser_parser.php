<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
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
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
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
class CI_Parser_parser extends CI_Parser_driver {

	/**
	 * Left delimiter character for pseudo vars
	 *
	 * @var string
	 */
	public $l_delim = '{';

	/**
	 * Right delimiter character for pseudo vars
	 *
	 * @var string
	 */
	public $r_delim = '}';

	/**
	 * Reference to CodeIgniter instance
	 *
	 * @var object
	 */
	protected $ci;

	protected $config;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->ci =& get_instance();

		// Default configuration options.

		$this->config = array(
			'l_delim' => '{',
			'r_delim' => '}',
			'full_path' => FALSE,
		);

		if ($this->ci->config->load('parser_parser', TRUE, TRUE))
		{
			$this->config = array_merge($this->config, $this->ci->config->item('parser_parser'));
		}

		// Injecting configuration options directly.

		if (isset($this->_parent) && !empty($this->_parent->params) && is_array($this->_parent->params))
		{
			$this->config = array_merge($this->config, $this->_parent->params);

			if (array_key_exists('parser_driver', $this->config))
			{
				unset($this->config['parser_driver']);
			}
		}

		$this->set_delimiters($this->config['l_delim'], $this->config['r_delim']);

		log_message('info', 'CI_Parser_parser Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a template
	 *
	 * Parses pseudo-variables contained in the specified template view,
	 * replacing them with the data in the second param
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	// Modified by Ivan Tcholakov, 27-DEC-2013, JAN-2016.
	public function parse($template, $data = array(), $return = FALSE, $options = array())
	{
		if (!is_array($options))
		{
			$options = array();
		}

		$options = array_merge($this->config, $options);

		if (is_object($data))
		{
			$data = get_object_vars($data);
		}

		if (!is_array($data))
		{
			$data = array();
		}

		$ci = $this->ci;
		$is_mx = false;

		if (!$return)
		{
			list($ci, $is_mx) = $this->detect_mx();
		}

		if (!$options['full_path'])
		{
			$template = $ci->load->path($template);
		}

		$template = $ci->load->_ci_load(array('_ci_vars' => $data, '_ci_return' => true, '_ci_template_content' => (@ file_get_contents($template))));

		$options['ci'] = $ci;
		$options['is_mx'] = $is_mx;

		return $this->_parse($template, $data, $return, $options);
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
	// Modified by Ivan Tcholakov, 27-DEC-2013, JAN-2016.
	public function parse_string($template, $data = array(), $return = FALSE, $options = array())
	{
		if (!is_array($options))
		{
			$options = array();
		}

		$options = array_merge($this->config, $options);

		if (is_object($data))
		{
			$data = get_object_vars($data);
		}

		if (!is_array($data))
		{
			$data = array();
		}

		$ci = $this->ci;
		$is_mx = false;

		if (!$return)
		{
			list($ci, $is_mx) = $this->detect_mx();
		}

		$options['ci'] = $ci;
		$options['is_mx'] = $is_mx;

		return $this->_parse($template, $data, $return, $options);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a template
	 *
	 * Parses pseudo-variables contained in the specified template,
	 * replacing them with the data in the second param
	 *
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	// Modified by Ivan Tcholakov, 27-DEC-2013, JAN-2016.
	protected function _parse($template, $data, $return = FALSE, $options = array())
	{
		$ci = $options['ci'];
		$is_mx = $options['is_mx'];

		$this->set_delimiters($options['l_delim'], $options['r_delim']);

		if ($template === '')
		{
			return FALSE;
		}

		$replace = array();
		foreach ($data as $key => $val)
		{
			$replace = array_merge(
				$replace,
				is_array($val)
					? $this->_parse_pair($key, $val, $template)
					: $this->_parse_single($key, (string) $val, $template)
			);
		}

		unset($data);
		$template = strtr($template, $replace);

		return $this->output($template, $return, $ci, $is_mx);
	}

	// --------------------------------------------------------------------

	/**
	 * Set the left/right variable delimiters
	 *
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	public function set_delimiters($l = '{', $r = '}')
	{
		$this->l_delim = $l;
		$this->r_delim = $r;
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a single key/value
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	protected function _parse_single($key, $val, $string)
	{
		return array($this->l_delim.$key.$this->r_delim => (string) $val);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse a tag pair
	 *
	 * Parses tag pairs: {some_tag} string... {/some_tag}
	 *
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	protected function _parse_pair($variable, $data, $string)
	{
		$replace = array();
		preg_match_all(
			'#'.preg_quote($this->l_delim.$variable.$this->r_delim).'(.+?)'.preg_quote($this->l_delim.'/'.$variable.$this->r_delim).'#s',
			$string,
			$matches,
			PREG_SET_ORDER
		);

		foreach ($matches as $match)
		{
			$str = '';
			foreach ($data as $row)
			{
				$temp = array();
				foreach ($row as $key => $val)
				{
					if (is_array($val))
					{
						$pair = $this->_parse_pair($key, $val, $match[1]);
						if ( ! empty($pair))
						{
							$temp = array_merge($temp, $pair);
						}

						continue;
					}

					$temp[$this->l_delim.$key.$this->r_delim] = $val;
				}

				$str .= strtr($match[1], $temp);
			}

			$replace[$match[0]] = $str;
		}

		return $replace;
	}

}
