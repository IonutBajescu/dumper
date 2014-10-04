<?php

if(!class_exists('Ionut\\Dumper\Dumper')){
	require __DIR__.'/Dumper.php';
}

function vd()
{
	static $dumper;
	if(!$dumper){
		$dumper = new \Ionut\Dumper\Dumper();
	}

	return call_user_func_array([$dumper, 'dump'], func_get_args());
}