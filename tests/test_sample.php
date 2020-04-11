<?php

// define fake ABSPATH
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', sys_get_temp_dir() );
}
// define fake PLUGIN_ABSPATH
if ( ! defined( 'PLUGIN_ABSPATH' ) ) {
    define( 'PLUGIN_ABSPATH', sys_get_temp_dir() . '/wp-content/plugins/gman-end-point/' );
}
require dirname( dirname( __FILE__ ) ) . '/gmanEndPoint.php';


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
        ( new MyClass() )->addHooks();
		self::assertTrue( has_action('init', [ MyClass::class, 'init' ]) );
	}

	
}
