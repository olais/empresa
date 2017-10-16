<?php

class Application_Model_Menu_Constructor {
   
    protected  $inicio;
    protected  $ordenes;
    protected  $catalogos;
    protected  $salir;
    protected  $produccion;
    protected  $entregas;
    protected  $calidad;
    protected  $usuarios;
    protected  $baseUrl;
    protected  $monitor;

   public  function __construct () 
    {
        $front = Zend_Controller_Front :: getInstance (); 
        $this->baseUrl = $front->getBaseUrl();
                   
    }
         
    function getinicio(){
        $this->inicio=" <li class='active'>
                            <a href='".$this->baseUrl."/index' >Inicio</a>
                         </li>";
    return $this->inicio;
    }
    
    function getcatalogos($submenus)
    {
            
           foreach ($submenus as $key => $value) {
                    switch ($key) {
                         case 'mnuCatalogos':
                        $this->catalogos.=($value==1) ? "<li class='dropdown'>
                                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Catalogos <span class='caret'></span></a>
                                <ul class='dropdown-menu'>" : '';
                        $habilita=($value==1) ? "true": '';
                                                        
                         break;
                         case 'mnuCatalogoClientes':
                         if($habilita=="true"){
                         $this->catalogos.=($value==1) ? " <li><a href='".$this->baseUrl."/consultas'>Clientes</a></li>":'';
                          }
                         break;
                         case 'mnuCatalogoUsuarios':
                          if($habilita=="true"){
                         $this->catalogos.=($value==1) ? "<li><a href='".$this->baseUrl."/usuarios'>Usuarios</a></li> ":''; 
                            }
                         break;                               
                         default: 
                         break;
                     } 
           }
       
                if(@$habilita=="true"){
                $this->catalogos.="</ul></li>"; 
                }

        
        return $this->catalogos;
    }
  
         
     function getordenes($submenus){
          foreach ($submenus as $key => $value) {
         switch ($key) {
             case 'mnuOrdenes':
                $this->ordenes=($value==1) ? "
                <li class='dropdown'>
                                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Ordenes<span class='caret'></span></a>
                                 <ul class='dropdown-menu'>
                <li><a href='".$this->baseUrl."/planeacion/registros'>Activas</a></li>
                <li><a href='".$this->baseUrl."/planeacion/finalizadas'>Finalizadas</a></li>
                </ul>" : '';
            break;
            default :
                break;
                }
         }         
        return $this->ordenes;
    }
    function getproduccion($submenus){
         foreach ($submenus as $key => $value) {
         switch ($key) {
                case 'mnuProduccion':
         $this->produccion.=($value==1) ?"<li class='dropdown'>
                                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Produccion<span class='caret'></span></a>
                                 <ul class='dropdown-menu'>":'';

                @$habilita=($value==1) ? "true": '';
                break;
                case 'mnuDiseno':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/diseno'>Diseño</a></li>":'';
                    }
                break;
                case 'mnuCorte':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/corte'>Corte - Laser</a></li>":'';
                    }
                break;
                case 'mnuDoblado':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/doblado'>Doblado</a></li>":'';
                }
                break;
                case 'mnuArmado':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/armado'>Armado</a></li>":'';
                }
                break;
                case 'mnuAhulado':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/anulado'>Ahulado</a></li>":'';
                 }
                break;
                case 'mnuRouter':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/router'>Router</a></li>":'';
                    } 
                break;
                case 'mnuCalidad':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/calidad'>Calidad</a></li>":'';
                    }
                break;
                case 'mnuEntregas':
                 if($habilita=="true"){
            $this->produccion.=($value==1) ?" <li><a href='".$this->baseUrl."/produccion/entregas'>Entregas</a></li>":'';
                    }
                break;
               default :
                break;

            }
        }     
             if(@$habilita=="true"){                     
            $this->produccion.="</ul></li> "; 
                }
        return $this->produccion;
    }
   
    function getmonitor($submenus)
    {
             foreach ($submenus as $key => $value) {
         switch ($key) {
                case 'mnuMonitor':
        $this->monitor=($value==1) ?"<li id='monitor'><a href='".$this->baseUrl."/monitor'>Monitor</a></li>":'';
            }
        }
                     
        return $this->monitor;
    }
    function  getsalir(){
       $this->salir="<li>
            <a href='".$this->baseUrl."/login/salir'>Salir</a></li>";
        return $this->salir;

    }
}
