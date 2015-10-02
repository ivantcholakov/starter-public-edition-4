<?php
/**
  * This files contains the main TSCompiler class.
	* @license See LICENSE file
	* @copyright Copyright 2012 ComFreek
	*/

/**
  * Encapsulates helper functions for calling the TypeScript compiler on the command line.
	*
	* @todo Should we check whether the file exists in compileToStr()? file_exists() is currently used
	* for determining whether realpath() should be applied.
	* @todo Should we a namespace instead of a "class" with static properties/functions?
  */
class TSCompiler {
	/**
	  * The temporary directory used by TSCompiler::compileToStr()
	  * @var string
	  * @see TSCompiler::compileToStr()
	  */
	// Modified by Ivan Tcholakov, 02-OCT-2015.
	//public static $TMP_DIR = 'tmp';
	public static $TMP_DIR = TMP_PATH;
	//

	/**
	  * Default options which shall be used in TSCompiler::buildCommand().
	  * @see TSCompiler::buildCommand()
	  */
	protected static $DEFAULT_OPTIONS = array(
	);

	/**
	  * Hide constructor because it's a static class
	  */
	private function __construct() {
	}

	/**
	  * Builds the command string.
	  *
	  * @param array $options Options. They do not conform to TypeScript's CLI options!
	  * Valid options are:
	  *  - inputFile: input *.ts file
	  *  - outputFile: output *.js file
	  * @return string The command string
	  */
	protected static function buildCommand(Array $options) {
		$cmd = 'tsc ';
		if (isset($options['outputFile'])) {
			$cmd .= '--out ' . escapeshellarg($options['outputFile']) . ' ';
		}
		$cmd .= escapeshellarg($options['inputFile']);
		return $cmd;
	}

	/**
	  * Compiles a given file.
	  * @param array $options Options. See TSCompiler::buildCommand() for available options.
	  * These will also be merged with TSCompiler::DEFAULT_OPTIONS
	  * @param array $errorInfo This array will receive the stdin and stderr streams if the error stream was not empty.
	  * @return Returns TRUE on success and FALSE if the error stream was not empty, i.e. when an error occured.
	  * @see TSCompiler::buildCommand()
	  */
	public static function compile(Array $options, &$errorInfo=array()) {
		$options = array_merge(self::$DEFAULT_OPTIONS, $options);

		$descriptorspec = array(
			0 => array("pipe", "r"), // stdin
			1 => array("pipe", "w"), // stdout
			2 => array("pipe", "w")  // stderr
		);

		$process = proc_open(self::buildCommand($options), $descriptorspec, $pipes, dirname(__FILE__), null);

		$stdout = stream_get_contents($pipes[1]);
		fclose($pipes[1]);

		$stderr = stream_get_contents($pipes[2]);
		fclose($pipes[2]);

		proc_close($process);
		if (empty($stderr)) {
			return true;
		}
		else {
			// Modified by Ivan Tcholakov, 02-OCT-2015;
			//$errorInfo = array('stdout' => $stdout, 'stdin' => $stderr);
			$errorInfo = array('stdout' => $stdout, 'stderr' => $stderr);
			//
			return false;
		}
	}

	/**
	  * Compiles a given file and returns the result as a string.
	  * @param string $file The input file
	  * @param array $errorInfo This array will receive the stdin and stderr streams if the error stream was not empty.
	  * @return Returns TRUE on success and FALSE if the error stream was not empty, i.e. when an error occured.
	  * @see TSCompiler::compile()
	  */
	public static function compileToStr($file, $options=array(), &$errorInfo=array()) {
		if (file_exists($file)) {
			$file = realpath($file);
		}

		if (!isset($options['outputFile'])) {
			$options['outputFile'] = tempnam(self::$TMP_DIR, 'TS_');
		}
		$options['inputFile'] = $file;


		if (self::compile($options, $errorInfo)) {
			$data = file_get_contents($options['outputFile']);
			unlink($options['outputFile']);
			return $data;
		}
		else {
			unlink($options['outputFile']);
			return false;
		}
	}

	public static function compileStr($str, $options=array(), &$errorInfo=array()) {
		// Modified by Ivan Tcholakov, 02-OCT-2015.
		//$tmpFile = tempnam(self::$TMP_DIR, 'TS_') . '.ts';
		//file_put_contents($tmpFile, $str);
		//
		//$compiledCode = self::compileToStr($tmpFile, $options, $errorInfo);
		//unlink($tmpFile);
		$tmpFile = tempnam(self::$TMP_DIR, 'TS_');
		$file = $tmpFile . '.ts';
		file_put_contents($file, $str);
		$compiledCode = self::compileToStr($file, $options, $errorInfo);
		unlink($file);
		unlink($tmpFile);
		//
		return $compiledCode;
	}
}