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
//         print_r("hola de nuevo ");
//         print_r($dataSimulacro[0]);
//         $id=$dataSimulacro[0];
        // $consulta=$this->dbAdapter->query("select id , folio FROM usuarios where nombre = '" . $dataUser['nombre']."' and correo = '".$dataUser['correo']. "'" ,Adapter::QUERY_MODE_EXECUTE);
        $query = "SELECT
                    aa.tiempo_estoy_listo,
                    aa.idVoluntario,
                    bb.nombre
                  FROM
                    voluntario_simulacro_grupo aa
                    INNER JOIN voluntarioCreador bb ON aa.idVoluntario = bb.id
                  where 
                        aa.idSimulacro='" . $dataSimulacro[0]."'
                  ORDER BY tiempo_estoy_listo";
//         $query = 'select REPLACE(aa.tiempo_estoy_listo, ":",",") as tiempo_estoy_listo,
//     aa.idVoluntario,bb.nombre from voluntario_simulacro_grupo aa inner join voluntariocreador bb
//      on aa.idVoluntario=bb.id where aa.idSimulacro='. $dataSimulacro[0] . ' order by tiempo_estoy_listo';
       
        $consulta = $this->dbAdapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        
        $res = $consulta->toArray();
        
//         print_r($res);exit;
  
        return $res;
    }
    
    public function busqueda()
    {
        // print_r("hola de nuevo ");
        // $consulta=$this->dbAdapter->query("select id , folio FROM usuarios where nombre = '" . $dataUser['nombre']."' and correo = '".$dataUser['correo']. "'" ,Adapter::QUERY_MODE_EXECUTE);
        $query = "SELECT
                        id,
                       tagGrupal 
                    FROM
                       simulacrogrupo
                    
                    ";
        $consulta = $this->dbAdapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        
        $res = $consulta->toArray();
       
        return $res;
    }
    
    
    public function graficados($dataSimulacro)
    {
//         print_r("hola de nuevo ");
//         print_r($dataSimulacro);
       
//         exit;
        // $consulta=$this->dbAdapter->query("select id , folio FROM usuarios where nombre = '" . $dataUser['nombre']."' and correo = '".$dataUser['correo']. "'" ,Adapter::QUERY_MODE_EXECUTE);
        $query ="SELECT 
                    s.tiempo_estoy_listo,
                    v.nombre
                    FROM
                      voluntario_simulacro_grupo s
                    INNER JOIN
                      voluntarioCreador v ON s.idvoluntario = v.id
                    INNER JOIN
                      (
                      SELECT
                          MIN(tiempo_estoy_listo) AS minimo,
                        MAX(tiempo_estoy_listo) AS maximo
                      FROM
                        voluntario_simulacro_grupo
                      WHERE
                        idSimulacro = '" . $dataSimulacro[0]."'
                    ) m ON s.tiempo_estoy_listo = m.minimo OR s.tiempo_estoy_listo = m.maximo AND s.idSimulacro = '" . $dataSimulacro[0]."'";
        
              $consulta = $this->dbAdapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        
        $res = $consulta->toArray();
        
//         print_r($res);exit;
        
        return $res;
    }
    
    public function graficaPromedio($dataSimulacro)
    {
//                 print_r("hola de nuevo ");
//                 print_r($dataSimulacro);
        
//                 exit;
        // $consulta=$this->dbAdapter->query("select id , folio FROM usuarios where nombre = '" . $dataUser['nombre']."' and correo = '".$dataUser['correo']. "'" ,Adapter::QUERY_MODE_EXECUTE);
        $query ="SELECT
                          SEC_TO_TIME(
                            ROUND(
                              AVG(
                                TIME_TO_SEC(aa.tiempo_estoy_listo)
                              )
                           )
                          ) AS promedio,
                    bb.ubicacion
                    FROM
                      voluntario_simulacro_grupo aa INNER join simulacrogrupo bb ON aa.idSimulacro = bb.id
                    WHERE
                    	aa.idSimulacro='" . $dataSimulacro[0]."'
                    GROUP BY
                      aa.idSimulacro";
     
        $consulta = $this->dbAdapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        
        $res = $consulta->toArray();
        
        //         print_r($res);exit;
        
        return $res;
    }
}
?>