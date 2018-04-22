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
// 	    print_r($dataSimulacro);
	    $graficaSimulacro = $this->getGraficasModel()->tiempo($dataSimulacro);
	    
	    return $graficaSimulacro;
	}
	
}
?>