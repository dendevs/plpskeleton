<?php
namespace DenDev\Plpskeleton\Test;
use DenDev\Plpskeleton\Skeleton;


class SkeletonTest extends \PHPUnit_Framework_TestCase 
{
	public function test_instanciate()
	{
		$object = new Skeleton();
		$this->assertInstanceOf( "DenDev\Plpskeleton\Skeleton", $object );
	}

	public function test_get_config()
	{
		$object = new Skeleton();
		$this->assertContains( '/', $object->get_config_value( 'root_path' ) );
		$this->assertContains( '/logs/', $object->get_config_value( 'log_path' ) );
		$this->assertContains( '/configs/', $object->get_config_value( 'config_path' ) );
		$config_path = $object->get_config_value( 'config_path' );

		$object = new Skeleton( false, $config_path . 'default.php' );
		$this->assertContains( '/configs/', $object->get_config_value( 'config_path' ) );
	}

	public function test_get_service()
	{
		$object = new Skeleton();
		$this->assertFalse( $object->get_service( 'jkljkl' ) );
	}

	public function test_write_log()
	{
		$object = new Skeleton();
		$this->assertEquals( 2, $object->write_log( 'test', 'test ecriture log', 'warning', array( 'test' => 'valeur' ) ) );
	}
}

