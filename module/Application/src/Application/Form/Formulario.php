<?php 
namespace Application\Form;

use Application\Model\GraficasModel;
use Prophecy\Comparator\Factory;
use Zend\Form\Form;
use Zend\Form\Element;


class Formulario extends Form
{
    private $graficasModel;
    
    
    private function getGraficasModel()
    {
        return $this->graficasModel = new GraficasModel();
    }
    
    
    public function __construct($name = null)
    {
//         parent::__construct($name);
//         $factory = new Factory();
        
//         $graficaSimulacro = $this->getGraficasModel()->busqueda();
        
// //         print_r("llegue");
// //         print_r($graficaSimulacro[]['id']);
        
//         $select = new Element\Select('nombreSimulacro');
//         $select->setLabel('Simulacro ');
// //         $select->setAttribute('multiple', true);
//         $select->setEmptyOption('Seleccione...');
//         $i="";
//         $array= array();
        
//         foreach($graficaSimulacro as $row){
// //             $i .= $row['tagGrupal'];
//             array_push($array,$row['tagGrupal']);
//             $select->setValueOptions($array);
            
//         }
// //         print_r($select->getValueOptions($array[0][0]));
// //         exit;
//         $this->add($select);
        
        
//         *******************************
        parent::__construct($name);
        $factory = new Factory();
        
        $graficaSimulacro = $this->getGraficasModel()->busqueda();
        
        //         print_r("llegue");
        //         print_r($graficaSimulacro);exit;
        
        $select = new Element\Select('nombreSimulacro');
        $select->setLabel('Simulacro ');
        //         $select->setAttribute('multiple', true);
        $select->setEmptyOption('Seleccione...');
        //         $select->setValueOptions(array(
        //                     'simulacro' => $graficaSimulacro
        //                 ));
        
        $valor=array();
//         print_r(count($graficaSimulacro));exit;
        foreach($graficaSimulacro as $row){
        
            //array_push($valor,$row['tagGrupal']);
//             $valor = array(
//                 $row['id'] => $row['tagGrupal'],
//             );
            $valor[$row['id']] = $row['tagGrupal'];
        }
        
        $select->setValueOptions($valor);
        $this->add($select);
        

//         *******************************
        
        $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Enviar',
                'title' => 'Enviar'
            ),
        ));
    }
}



?>