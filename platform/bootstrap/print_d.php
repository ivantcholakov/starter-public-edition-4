<?php

/*

Kratt Tools PRINT_D
Written by Pertti Soomann, 2014
https://github.com/vikerlane

Check for latest version and report issues at
https://github.com/CesiumComputer/print_d

Copyright (c) 2014, Pertti Soomann @ Vikerlane
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this
   list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright notice,
   this list of conditions and the following disclaimer in the documentation
   and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

The views and conclusions contained in the software and documentation are those
of the authors and should not be interpreted as representing official policies,
either expressed or implied, of the FreeBSD Project.

*/

function print_d($var, $options = false)
{
	if (is_bool($options))
	{
		$options = array('methods' => $options);
	}

	$options['recursive'] = isset($options['recursive']) ? $options['recursive'] : false;

	$ret = '';

	$css = array(
		'holder' => 'border: 1px solid #ddd; padding: 6px; background: #fff; float: left; margin: 3px; font-size: 11px; font-family:Lucida Console, Monaco, monospace;',
		'table' => 'border: 1px solid #ddd; border-collapse:collapse;',
		'table-methods' => 'margin-top: 4px; width: 100%;',
		'td' => 'border: 1px solid #ddd; font-size: 11px; vertical-align: top; padding: 2px 4px 2px 4px; word-wrap: break-word;',
		'method' => 'color: #00d;',
		'attributes' => 'padding: 2px;',
		'table-attributes' => 'width: 100%; border-collapse:collapse;',
		'required' => 'text-align: center; color: #d00; width: 16px;',
		'attribute' => 'width:120px;',
		'pre' => 'font-size: 11px !important; margin: 0; padding: 0; background: none; border: 0;',
		'type' => 'color: #bbb;',
		'type-array' => '',
		'type-object' => '',
		'type-' => '',
		'type-integer' => 'font-weight: bold; max-width: 250px; color: #00d; text-align: right;',
		'type-float' => 'font-weight: bold; max-width: 250px; color: #00d; text-align: right;',
		'type-double' => 'font-weight: bold; max-width: 250px; color: #00d; text-align: right;',
		'type-string' => 'font-weight: bold; max-width: 250px; color: #d00;',
		'type-boolean' => 'font-weight: bold; max-width: 250px; color: #bbb;',
		'type-null' => 'font-weight: bold; max-width: 250px; color: #bbb;',
		'type-resource' => 'font-weight: bold; max-width: 250px; color: #bbb;',
		'void' => 'font-style: italic; color: #bbb;',
		'emptystring' => 'color: #bbb; font-style: italic; font-weight: normal;'
	);

	if (!$options['recursive'])
	{
		$t = defined('DEBUG_BACKTRACE_IGNORE_ARGS') ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) : debug_backtrace();
		if (file_exists($t[0]['file']))
		{
			$s = file($t[0]['file']);
			$s = $s[$t[0]['line']-1];
			$t = explode('print_d(', $s, 2);
			if (count($t) > 1)
			{
				$t = trim(preg_replace('/\s+/', ' ', $t[1]));

				$t2 = '';
				$len = strlen($t);
				$prev = false;
				$quotes_open = false;
				$brackets = 0;
				for($i=0; $i<$len; ++$i)
				{
					$c = $t[$i];
					if ($quotes_open)
					{
						if ($c === $quotes_open && $prev !== '\\')
						{
							$quotes_open = false;
						}
					}
					else if ($c === '\'' || $c === '"')
					{
						$quotes_open = $c;
					}
					else if ($c === '(')
					{
						++$brackets;
					}
					else if ($brackets > 0 && $c === ')')
					{
						--$brackets;
					}
					else if ($brackets === 0 && ($c === ',' || $c === ')'))
					{
						break;
					}
					$t2 .= $t[$i];
					$prev = $t[$i];
				}

				$t = trim(preg_replace('/\s+/', ' ', $t2));

				if (strpos($t, '('))
				{
					if (strtolower(substr($t, 0, 6)) !== 'array(')
						$func_name = $t;
				}
				else if ($t[0] === '$')
				{
					$name = $t;
						$name = trim(preg_replace('/\s+/', '', $name));
				}
			}
		}
	}

	$type = strtolower(gettype($var));

	if (!$options['recursive'])
		$ret .= '<div style="'.$css['holder'].'">';

	if ($type === 'array' || $type === 'object' || isset($func_name))
	{
		if (isset($name))
			$ret .= '<strong>'.$name.'</strong>';
		else if (isset($func_name))
			$ret .= '<strong>'.$func_name.'</strong>';

		if ($type === 'object')
			$ret .= ' '.get_class($var);
	}

	$ret .= '<table style="'.$css['table'].'">';
	switch($type)
	{
	 	case 'array':
	 	case 'object':

	 		$count = 0;
	 		if ($var)
	 		{
		 		foreach($var as $i => $v)
		 		{
		 			++$count;
		 			$v_type = strtolower(gettype($v));

		 			if ($v_type === 'object' || $v_type === 'array')
		 				$v = print_d($v, array('recursive' => true));
		 			else if ($v_type === 'boolean')
		 				$v = $v ? 'TRUE' : 'FALSE';
		 			else if ($v_type === 'string' && $v === '')
		 				$v = '<span style="'.$css['emptystring'].'">empty string</span>';
		 			else if ($v_type === 'null')
		 				$v = 'NULL';

		 			$ret .= '<tr>';
		 			$ret .= '<td style="'.$css['td'].$css['type'].'">'.$v_type.'</td>';
		 			$ret .= '<td style="'.$css['td'].'">'.$i.'</td>';
		 			$ret .= '<td style="'.$css['td'].$css['type-'.$v_type].'">'.$v.'</td>';
		 			$ret .= '</tr>';
		 		}
		 	}

		 	if ($count === 0)
	 		{
				$ret .= '<tr>';
	 			$ret .= '<td style="'.$css['td'].'"><span style="'.$css['emptystring'].'">empty '.($type === 'array' ? 'array' : 'class').'</span></td>';
	 			$ret .= '</tr>';
	 		}

	 		if ($type === 'object' && ($options === true || (isset($options['methods']) && $options['methods'] === true)))
	 		{
	 			$methods = get_class_methods($var);
	 			if ($methods)
	 			{
	 				$ret .= '</table>';
	 				$ret .= '<table style="'.$css['table'].$css['table-methods'].'">';

	 				foreach($methods as $m)
	 				{
	 					$r = new ReflectionMethod($var, $m);
	 					$params = $r->getParameters();

	 					$ret .= '<tr>';
	 					$ret .= '<td style="'.$css['td'].$css['method'].'">'.$m.'</td>';
	 					$ret .= '<td style="'.$css['td'].$css['attributes'].'">';
	 					if ($params)
	 					{
	 						$ret .= '<table style="'.$css['table-attributes'].'">';
							foreach ($params as $p)
							{
								if ($p->isDefaultValueAvailable())
								{
									$value = $p->getDefaultValue();
									$v_type = strtolower(gettype($value));

									if ($v_type === 'string' && $value === '')
										$value = '<span style="'.$css['emptystring'].'">empty string</span>';
									else if ($v_type === 'boolean')
										$value = $value ? 'TRUE' : 'FALSE';
									else if ($v_type === 'null')
										$value = 'NULL';
								}
								else
								{
									$value = '<span style="'.$css['emptystring'].'">n/a</span>';
									$v_type = '';
								}

								$ret .= '<tr>';
								$ret .= '<td style="'.$css['td'].$css['required'].'">'.($p->isOptional() ? '' : '*').'</td>';
								$ret .= '<td style="'.$css['td'].$css['attribute'].'">'.$p->getName().'</td>';
								$ret .= '<td style="'.$css['td'].$css['type-'.$v_type].'">'.$value.'</td>';
								$ret .= '</tr>';
							}
							$ret .= '</table>';
						}
						else
						{
							$ret .= '<span style="'.$css['void'].'">void</span>';
						}
	 					$ret .= '</td>';
	 					$ret .= '</tr>';
	 				}
	 			}
	 		}
 		break;
 		default:

 			if ($type === 'boolean')
	 			$var = $var ? 'TRUE' : 'FALSE';
	 		else if ($type === 'null')
 				$var = 'NULL';


 			$ret .= '<tr>';
 			$ret .= '<td style="'.$css['td'].$css['type'].'">'.$type.'</td>';
 			if (isset($name))
	 			$ret .= '<td style="'.$css['td'].'">'.$name.'</td>';
	 		$ret .= '<td style="'.$css['td'].$css['type-'.$type].'">'.$var.'</td>';
	 		$ret .= '</tr>';
 		break;
	}
	$ret .= '</table>';

	if (!$options['recursive'])
		$ret .= '</div>';

	return $ret;
}
