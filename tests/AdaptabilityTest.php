<?php
namespace DenDev\Plpadaptability\Test;
use DenDev\Plpadaptability\Adaptability;


class AdaptabilityTest extends \PHPUnit_Framework_TestCase 
{
	public function test_instanciate_form_child()
	{
		$object = new ChildAdaptability();
		$this->assertInstanceOf( "DenDev\Plpadaptability\Adaptability", $object );
		$this->assertInstanceOf( "DenDev\Plpadaptability\Test\ChildAdaptability", $object );
	}

	public function test_get_service_metas()
	{
		$object = new ChildAdaptability();
		$this->assertEquals( 'fake_service', $object->get_service_metas( 'service_name' ) );

		$metas = array( 
			'service_name' => 'fake_service',
			'service_version' => '111',
		);
		$this->assertEquals( $metas, $object->get_service_metas() );
	}

	public function test_get_config_value()
	{
		$object = new ChildAdaptability();
		$this->assertEquals( 'defaut value 1', $object->get_config_value( 'test1' ) );
	}
}

class ChildAdaptability extends Adaptability
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_default_configs()
	{
		return array( 'test1' => 'defaut value 1' );
	}
	
	public function set_service_metas()
	{
		$this->_service_metas = array( 
			'service_name' => 'fake_service',
			'service_version' => '111',
			);
	}

}
