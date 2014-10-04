<?php

use \Ionut\Dumper\Dumper;
class HelperTest extends PHPUnit_Framework_TestCase {

	public function testHelper(){
		require __DIR__.'/../src/helper.php';
		$dump_me = ['some lorem ipsum'];

		Dumper::$default_config = [
			'clear'     => false,
			'backtrace' => false,
			'exit'      => false
		];

		$dumper = new Dumper();
		$this->assertSame(
			$dumper->dump($dump_me),
			vd($dump_me)
		);
	}
}
