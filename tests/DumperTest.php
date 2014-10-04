<?php

use \Ionut\Dumper\Dumper;

class DumperTest extends PHPUnit_Framework_TestCase {

	public function testBasicDump()
	{
		$dumper = new Dumper(['echo' => false, 'exit' => false, 'clear' => false]);

		$dump_me = 'adasdsadaljkahnsdasjdasjdjdb';

		$dumped = $dumper->dump($dump_me);
		$this->assertContains($dump_me, $dumped);
	}
}
 