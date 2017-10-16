<?php
    class Application_Model_DbTable_Tiendas extends Zend_Db_Table_Abstract
    {
        protected $_name = 'Tiendas';
        protected $_primary='Id_Tienda';

        public function guardar($datos)
        {   
            //print_r($datos);
            return $this->insert($datos);
        }

        public function consultar()
        {
            $db = Zend_Db_Table_Abstract::getDefaultAdapter();
            $select =$db->select()
                        ->from ("Tiendas");
            $sql = $db->query($select);

            return  $row = $sql->fetchAll();
        }

        public function consultarTienda($tienda)
        {
            $db = Zend_Db_Table_Abstract::getDefaultAdapter();
            $select = $db ->select()
                    ->from('Tiendas')
                    ->where("Id_Tienda LIKE '$tienda%'")
                    ->order("Id_Tienda DESC");
            
            //$sql = $select->__toString();
            //echo "$sql\n";
            
            $sql = $db->query($select);
            return  $rows = $sql->fetchAll();
        }

        public function actualizar($id,$datos)
        {
            $where = "Id=$id";
            return $this->update($datos, $where);
        }

        public function Estatus($Estatus,$Tienda){

             $datos=array("Activo"=>$Estatus);
             $where = "Id_Tienda='$Tienda'";
            return $this->update($datos, $where);


        }



    }

