<?php
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\GraficasService;

class GraficasController extends AbstractActionController
{

    private $graficasService;

    /**
     * Instanciamos el servicio de participantes
     */
    public function getGraficasService()
    {
        return $this->graficasService = new GraficasService();
    }

    public function graficasAction(){
        
        $request = $this->getRequest();
                  
            
            $postData       = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
//             print_r("hola entre ");
            $result = $this->getGraficasService()->tiempoGrafica($decodePostData);
            
            
//             $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
//                 "response" => $result,
//             )));
//             print_r($response);exit;
//             return $response;
            return new ViewModel(
                array(
                    "simulacro"=>$result
                ));
        
    }

   
}
?>