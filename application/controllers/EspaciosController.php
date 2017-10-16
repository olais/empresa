<?php
    class EspaciosController extends Zend_Controller_Action
    {
        public function init()
        {

        }

        public function insertarespaciosAction()
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            
            $response=new stdClass();
            $objRegistro=new Application_Model_DbTable_Espacios();

            foreach($_POST as $nombre_campo => $valor)
            { 
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
                eval($asignacion); 
            }
            //obtenemos las variables
            
            $datos=array(
                    "Nombre"=>$Nombre,
                    "Alto"=>$Alto,
                    "Ancho"=>$Ancho,
                    "Descripcion"=>$Descripcion,
                    "Id_Tienda"=>$Id_Tienda
                );
            
            $result=$objRegistro->guardar($datos);
            
            if($result)
            {
                $response->id=$result;
                $response->validacion="true";
            }
            else
            {
                $response->validacion="false";
            }

            echo json_encode($response);
        }

        public function consultarespaciosAction()
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            
            $response=new stdClass();
            $objRegistro = new Application_Model_DbTable_Tiendas();

            //$tienda =$this->_request->getParam('tienda');
            $tienda = 1;
            
            $result=$objRegistro->consultarTienda($tienda);

            if($result)
            {
                $response->rows=$result;
                $response->validacion="true";
            }
            else
            {
                $response->validacion="false";
            }

            echo json_encode($response);
        }
    }