<?php namespace Ionut\Dumper;

/**
 * Class Dumper
 *
 * @package Ionut\Dumper
 */
class Dumper {

	/**
	 * @var int
	 */
	protected $callNumber = 0;

	/**
	 * @var array
	 */
	protected $config;

	/**
	 * @var array
	 */
	protected $default_config = [
		'clear'     => true,
		'backtrace' => true,
		'exit'      => true
	];

	/**
	 * @param $config
	 */
	function __construct($config = [])
	{
		$this->config = $config + $this->default_config;
	}


	/**
	 * @param $k
	 *
	 * @return array
	 */
	public function config($k)
	{
		return $this->config[$k];
	}

	/**
	 * Dump parameters in pretty format.
	 *
	 * @param mixed $var,... unlimited Variables to be dumped.
	 * @return string
	 */
	public function dump()
	{
		$this->callNumber++;
		$output = '';

		if ($this->config('clear')) {
			$this->clearAllBuffers();
		}

		foreach (func_get_args() as $k => $var) {
			$output .= '<pre>' . var_export($var, true) . '</pre>';
		}

		if ($this->config('backtrace')) {
			$output .= $this->getBacktraceHtml();
		}

		if($this->config['echo']){
			echo $output;
		}

		if ($this->config('exit')) {
			exit;
		}

		return $output;
	}

	protected function clearAllBuffers()
	{
		while (@ob_end_clean()) {};
	}

	/**
	 * Generate backtrace with clickable show-hide button.
	 *
	 * @return string
	 */
	public function getBacktraceHtml()
	{
		$export = $this->getBacktrace();

		return <<<HTML
	<button
		onclick="el=document.getElementById('backtrace{$this->callNumber}'); el.style.display = (el.style.display != 'none' ? 'none' : '' );"
	>
		Backtrace
	</button>
	<div id="backtrace{$this->callNumber}" style="display:none">
		<pre>{$export}</pre>
	</div>
HTML;
	}

	/**
	 * @return mixed
	 */
	protected function getBacktrace()
	{
		$error  = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		$export = var_export($error, true);

		return $export;
	}
}