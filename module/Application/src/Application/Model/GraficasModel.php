<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class GraficasModel extends TableGateway
{

    private $dbAdapter;

    public function __construct()
    {
        $this->dbAdapter = \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
        $this->table = 'voluntario_simulacro_grupo';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->initialize();
    }

    public function tiempo($dataSimulacro)
    {
        // print_r("hola de nuevo ");
        // $consulta=$this->dbAdapter->query("select id , folio FROM usuarios where nombre = '" . $dataUser['nombre']."' and correo = '".$dataUser['correo']. "'" ,Adapter::QUERY_MODE_EXECUTE);
        $query = "SELECT
                    aa.tiempo_estoy_listo,
                    aa.idVoluntario,
                    bb.nombre
                  FROM
                    voluntario_simulacro_grupo aa
                    INNER JOIN voluntarioCreador bb ON aa.idVoluntario = bb.id
                  
                  ORDER BY tiempo_estoy_listo";
        $consulta = $this->dbAdapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        
        $res = $consulta->toArray();
      
        return $res;
    }
}
?>