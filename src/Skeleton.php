<?php
namespace DenDev\Plpskeleton;
use DenDev\Plpskeleton\SkeletonInterface;
use DenDev\Plpadaptability\Adaptability;


/**
 *  Skeleton 
 */
class Skeleton extends Adaptability implements SkeletonInterface
{
    /**
     * Set le kernel du servie 
     *
     * @param object $krl la ref du kernel auquel appartient le service ou false par defaut.
     *
     * @return void
     */
    public function __construct( $krl = false )
    {
        parent::__construct( $krl );
    }

    /**
     * Configuration par defaut du service
     *
     * @return array tableau associatif option value.
     */
    public function get_default_configs()
    {
        return array();
    }

    /**
     * Set les informations de base au sujet du service.
     *
     * son nom sous forme slugifier ( mon_serice et non Mon service )
     * son numero de version 
     *
     * @return void
     */
    public function set_service_metas()
    {
		$this->_service_metas = array( 
			'service_name' => 'skeleton',
			'service_version' => '0.0.0',
			);
    }
}
