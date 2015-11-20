<?php
namespace DenDev\Plpadaptability;
use DenDev\Plpadaptability\AdaptabilityInterface;


/**
 *  Fait le lien entre le service et le kernel ou son absence.
 *
 *  Si un kernel existe la class utiliserat les services du kernel pour le log, error, config.
 *  Instancie un kernel par defaut dans le cas contraire.
 *  Cette classe assure de pouvoir utiliser un service avec ou sans kernel.
 */
abstract class Adaptability implements AdaptabilityInterface
{
    /** @var object kernel offrant les services */
    private $_krl;
    /** @var array tableau associatif nom service, version, ... */
    protected $_service_metas;


    /**
     * Set le kernel pour l'object enfant ou cree un kernel minimal.
     *
     * @param object $krl la ref du kernel auquel appartient le service ou false par defaut.
     *
     * @return void
     */
    public function __construct( $krl = false )
    {
        $this->_set_kernel( $krl );
        $this->set_service_metas();
    }

    /**
     * Delegue au kernel la recuperation d'une valeur de configuration.
     *
     * @param string $config_name nom de l'option
     * @param mixed $default_value valeur si l'option n'existe pas, false par default
     *
     * @return mixed|false la valeur ou false si rien trouver
     */
    public function get_config_value( $config_name, $default_value = false )
    {
        return $this->_krl->get_config_value( $config_name, $default_value );
    }

    /**
     * Ecriture de log basique ou via service du kernel
     *
     * @param string $log_name nom du logger, si service de base alors non fichier
     * @param string $level niveau du message ( info, debug, ... )
     * @param string $message message a logger
     * @param array $context informations supplementaires
     *
     * @return bool true si ecriture ok
     */
    public function log( $log_name, $level, $message, $context )
    {
        $service_name = $this->get_service_metas( 'service_name' );
        return $this->_krl->log( $service_name, $log_name, $level, $message, $context );
    }

    /**
     * Recolte l'inforation sur le(s) services existant.
     *
     * @param bool $meta_name pour recuperer une valeur specifique, renvoi tout si false.
     *
     * @return string|array renvoi une meta_value specifique ou toutes
     */
	public function get_service_metas( $meta_name = false )
	{
        $meta_value = false;
        if( $meta_name &&  array_key_exists( $meta_name, $this->_service_metas ) )
        {
            $meta_value = $this->_service_metas[$meta_name];
        }

        return ( $meta_value ) ? $meta_value : $this->_service_metas;
    }

    // -
    private function _set_kernel( $krl )
    {
        // create kernel
        if( ! $krl )
        {
            $krl = new NoKernel();
        }

        // merge config
        $default_service_configs= array();
        if( method_exists( $this, 'get_default_configs' ) )
        {
            $default_service_configs = $this->get_default_configs();
        }
        $krl->merge_configs( $default_service_configs );

        // end
        $this->_krl = $krl;
    }
}
