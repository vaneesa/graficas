<?php
namespace Application\Controller;

use Application\Form\Formulario;
use Application\Service\GraficasService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\GraficasModel;

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

    public function graficasAction()
    {
        $form = new Formulario("form");
        
        // return new ViewModel(
        // array(
        // //"simulacro"=>$result,
        // "form"=>$form,
        // // "numeroTotal"=>count($result),
        // 'url'=>$this->getRequest()->getBaseUrl()
        // ));
        
        $request = $this->getRequest();
        $postData = $this->getRequest()->getContent();
        $decodePostData = json_decode($postData, true);
        // print_r("hola entre ");
//         print_r($postData);
        $result="";
        $resultdos="";
        if ($this->request->getPost("send")) {
            $result = $this->getGraficasService()->tiempoGrafica($postData);
//             print_r($result);
            $resultdos = $this->getGraficasService()->graficados($postData);
//             print_r(" ************ hola entre *****************");
//             print_r($resultdos);
        }
        
        // print_r("hola entre ");
        // print_r($result);
        
        return new ViewModel(array(
            "form" => $form,
            'url' => $this->getRequest()->getBaseUrl(),
            "simulacro" => $result,
            "numeroTotal" => count($result),
            "graficados" => $resultdos,
            "graficadosTotal" => count($resultdos)
            
        ));
    }

    public function recibeAction()
    {
        
        // if($this->request->getPost("send")){
        // $datos=$this->request->getPost();
        // print_r($datos);
        // $result = $this->getGraficasService()->tiempoGrafica($datos);
        // return new ViewModel(array("titulo"=>"Recibir datos via POST en ZF2","datos"=>$datos));
        // }
        // exit;
        $request = $this->getRequest();
        $postData = $this->getRequest()->getContent();
        $decodePostData = json_decode($postData, true);
        // print_r("hola entre ");
        // print_r($postData);
        $result = $this->getGraficasService()->tiempoGrafica($postData);
        // print_r("hola entre ");
        // print_r($result);
        
        return new ViewModel(array(
            "simulacro" => $result,
            "numeroTotal" => count($result)
        ));
        
        // else{
        // return $this->redirect()->toUrl(
        // $this->getRequest()->getBaseUrl().'/application/graficas'
        // );
        // }
        
        // $data = $this->request->getPost();
        
        // $procesa=new GraficasModel($data);
        // $datos=$procesa->getData();
        // return new ViewModel(array('datos'=>$datos));
    }
}
?>