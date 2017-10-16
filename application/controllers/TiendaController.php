<?php
    class TiendaController extends Zend_Controller_Action
    {
        public function init()
        {
            
        }

        public function indexAction()
        {
            $this->view->layout()->metaDescription  = "Tienda";
            $this->view->layout()->metaTags         = "Tienda";
            $this->view->layout()->pageTitle        = "Tienda";
        }

        public function insertaAction()
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            
            $response=new stdClass();
            $objRegistro=new Application_Model_DbTable_Tiendas();

            foreach($_POST as $nombre_campo => $valor)
            { 
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
                eval($asignacion); 
            }
            //obtenemos las variables
            
            $datos=array(
                    "Id_Tienda"=>$IdTienda,
                    "Nombre"=>$Nombre,
                    "Ciudad"=>$Ciudad,
                    "Region"=>$Region
                );
            
            $result=$objRegistro->guardar($datos);
            
            if($result)
            {
                //$response->id=$result;
                $response->validacion="true";
            }
            else
            {
                $response->validacion="false";
            }

            echo json_encode($response);
        }
        
        public function consultartiendaAction()
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            $model=new Application_Model_DbTable_Tiendas();
            $tienda=$model->consultar();

            $datos=array();
            $response=new stdClass();

            foreach ($tienda as $valor)
            {
                $checked=($valor['Activo']==1)? 'checked' :'';

                $datos[]=array(
                    "Id"=>$valor['Id'],
                    "Tienda"=>$valor['Id_Tienda'],
                    "Nombre"=>$valor['Nombre'],
                    "Ciudad"=>utf8_encode($valor['Ciudad']),
                    "Region"=>$valor['Region'],
                    "Activo"=>"<button type='button' id='ButtonEditar' class='editar edit-modal btn btn-primary botonEditar' style='top: 0;float: left;margin-right: 5px;'><span class='fa fa-edit'></span><span class='glyphicon glyphicon-edit'></span></button><label class='switch' style='padding: 13px;top: 0;float: left;margin-right: 5px;'><input type='checkbox' $checked class='Estatus' id='".$valor['Id']."'><span class='slider round'></span></label><button type='button' id='ButtonDetalle' style='top: 0;float: left;margin-right: 5px;' class='detalle edit-modal btn btn-warning botonDetalle'><span class='fa fa-edit'></span><span class='glyphicon glyphicon-list-alt'></span></button>"//$valor['Activo'],

                    );
            }
            
            $response->data=$datos;
            echo json_encode($response);
        }

        public function actualizatiendaAction()
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            foreach($_POST as $nombre_campo => $valor)
            { 
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
                eval($asignacion); 
            }

            $model=new Application_Model_DbTable_Tiendas();

            $datos=array(
                "Id_Tienda"=>$IdTiendaEditar,
                "Nombre"=>$NombreEditar,
                "Ciudad"=>$CiudadEditar,
                "Region"=>$RegionEditar
            );

            $tienda=$model->actualizar($IdTiendaInterno,$datos);

            echo json_encode("true");
        }

        public function selecttiendaAction()
        {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            
            $response=new stdClass();
            $objRegistro = new Application_Model_DbTable_Tiendas();

            $tienda =$this->_request->getParam('tienda');
            
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


    public function activadesactivaAction(){

            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();

            foreach($_POST as $nombre_campo => $valor)
            { 
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
                eval($asignacion); 
            }

             $model=new Application_Model_DbTable_Tiendas();
             $tienda=$model->Estatus($Estatus,$Tienda);

             echo json_encode("true");


    }
    public function activadesactivaespaciosAction(){

            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();

            foreach($_POST as $nombre_campo => $valor)
            { 
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
                eval($asignacion); 
            }
            $datos=array("Activo"=>$Estatus);

             $model=new Application_Model_DbTable_Espacios();
             $espacio=$model->actualizar($espacio,$datos);

             echo json_encode("true");


    }



    

        public function insertaespaciosAction()
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
                "Activo"=>1,
                "Id_Tienda"=>$TiendaEspacio
                 );

            $model=new Application_Model_DbTable_Espacios($datos);
            $tienda=$model->guardar($datos);

            $response->validacion="true";

            echo json_encode($response);

       }


       public function consultaespaciosAction(){

            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();
            
            $response=new stdClass();
          
           
            $idTienda=$_REQUEST['id'];
            
            $model=new Application_Model_DbTable_Espacios();
            $espacios=$model->consultar($idTienda);


            $datos=array();
            $response=new stdClass();

            foreach ($espacios as $valor)
            {
                $checked=($valor['Activo']==1)? 'checked' :'';

                $datos[]=array(
                    "Id"=>$valor['Id'],
                    "Nombre"=>$valor['Nombre'],
                    "Alto"=>$valor['Alto'],
                    "Ancho"=>$valor['Ancho'],
                    "Descripcion"=>$valor['Descripcion'],
                    "Activo"=>"<button type='button' id='ButtonEditar' class='editarEspacio edit-modal btn btn-primary botonEditar' style='top: 0;float: left;margin-right: 5px;'><span class='fa fa-edit'></span><span class='glyphicon glyphicon-edit'></span></button><label class='switch' style='padding: 13px;top: 0;float: left;margin-right: 5px;'><input type='checkbox' $checked class='EstatusEspacio' id='E".$valor['Id']."'><span class='slider round'></span></label>"//$valor['Activo'],

                    );
            }
            
            $response->data=$datos;
            echo json_encode($response);
     }

     public function actualizaespacioAction(){

            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender();

            foreach($_POST as $nombre_campo => $valor)
            { 
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
                eval($asignacion); 
            }
            $datos=array(

                "Nombre"=>$NombreEditarEspacio,
                "Alto"=>$AltoEditarEspacio,
                "Ancho"=>$AnchoEditarEspacio,
                "Descripcion"=>$DescripcionEspacio
             
                );

             $model=new Application_Model_DbTable_Espacios();
             $espacio=$model->actualizar($IdEspacioInterno,$datos);

             echo json_encode("true");

     }

    }