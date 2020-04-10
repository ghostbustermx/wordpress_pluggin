<?php
/**
 * Class SampleTest
 *
 * @package Gman_End_Point
 */

/**
 * Sample test case.
 */

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;


class test_sample extends TestCase {
    use MockeryPHPUnitIntegration;


    protected function setUp(): void {
        parent::setUp();
        Monkey\setUp();
    }


	public function test_sample() {
        $MyClass = new MyClass();
        $MyClass->addHooks();
		self::assertTrue( has_action('init', [ MyClass::class, 'init' ]) );
	}

	
}
