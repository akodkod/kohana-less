<?php defined('SYSPATH') or die('No direct script access.');

/**
 * [Less](http://lesscss.org/) The dynamic stylesheet language.
 * LESS extends CSS with dynamic behavior such as variables, mixins,
 * operations and functions. LESS runs on both the client-side (Chrome, Safari, Firefox)
 * and server-side, with Node.js and Rhino.
 *
 * @see        http://lesscss.org/
 * @version    0.1.0
 * @author     emelyanenko.web@gmail.com
 * @copyright  (c) 2012 Andrew Emelianenko
 * @license    http://kohanaframework.org/license
 */

abstract class Kohana_Less {


	public static function compile($file = FALSE)
	{
		if ( ! $file)
		{
			throw new Kohana_Exception('Specify the file to compile');
		}

		$config = Kohana::$config->load('less');
		$input = $config->less_dir.DIRECTORY_SEPARATOR.$file.'.less';
		$output = $config->css_dir.DIRECTORY_SEPARATOR.$file.'.css';

		if ( ! Kohana::find_file('..', $input, FALSE))
		{
			throw new Kohana_Exception('The file could not be found: :file',
				array(':file' => $input));
		}

		if ( ! class_exists('lessc', FALSE))
		{
			require Kohana::find_file('vendor', 'lessphp/lessc.inc');
		}

		$environment = Kohana::$environment == Kohana::DEVELOPMENT;

		if ( ! $config->only_development OR ($config->only_development AND ($environment OR ! Kohana::find_file('..', $output, FALSE))))
		{
			lessc::ccompile($input, $output);
		}

		return str_replace('\\', '/', $output);
	}

} // End Less
