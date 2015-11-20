<?php
namespace DenDev\Plpadaptability;


interface AdaptabilityInterface
{
    /**
     * Oblige la presence d'une configuration de base.
     */
    public function get_default_configs();

    /**
     * Chaque service doit avoir un identifiant.
     *
     * Ajoute quelques infos comme la version, etc
     */
    public function set_service_metas();
}