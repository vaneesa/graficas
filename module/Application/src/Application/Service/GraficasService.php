<?php

namespace Application\Service;

use Application\Model\GraficasModel;

class GraficasService
{
	private $graficasModel;
	
	
	private function getGraficasModel()
	{
		return $this->graficasModel = new GraficasModel();
	}
	
	public function tiempoGrafica($dataSimulacro)
	{
// 	    print_r("Service ");
	    
	    $datos = explode('=', $dataSimulacro, 4);
// 	   print_r($datos);exit;
// 	   print_r("    ");
// 	   print_r($datos[1]);
	   $datos1 = explode('&', $datos[1], 4);
// 	   $folioExtrae = substr($datos[1], 6,0);
// 	   print_r("    ");
// 	   print_r($datos1);
// 	   print_r("    ");
// 	   print_r($datos1[0]);
// 	   exit;
	   
	   $graficaSimulacro = $this->getGraficasModel()->tiempo($datos1);
	   
	    
	    return $graficaSimulacro;
	}
	
	public function graficados($dataSimulacro)
	{
	    
	    $datos = explode('=', $dataSimulacro, 4);
	    // 	   print_r($datos);exit;
	    // 	   print_r("    ");
	    // 	   print_r($datos[1]);
	    $datos1 = explode('&', $datos[1], 4);
	    // 	   $folioExtrae = substr($datos[1], 6,0);
	    // 	   print_r("    ");
	    // 	   print_r($datos1);
	    // 	   print_r("    ");
// 	    	   print_r($datos1[0]);
// 	    	   exit;
	    
	    $graficados = $this->getGraficasModel()->graficados($datos1);
	    
	    
	    return $graficados;
	}
	
}
?>