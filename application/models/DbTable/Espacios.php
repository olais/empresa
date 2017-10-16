<?php
    class Application_Model_DbTable_Espacios extends Zend_Db_Table_Abstract
    {
        protected $_name = 'Espacios';
        protected $_primary='Id';

        public function guardar($datos)
        {   
            return $this->insert($datos);
        }

        public function consultar($idTienda)
        {
            $db = Zend_Db_Table_Abstract::getDefaultAdapter();
            $select =$db->select()
                        ->from ("Espacios")
                        ->where("Id_Tienda=?",$idTienda);
            $sql = $db->query($select);

            return  $row = $sql->fetchAll();
        }

        public function consultarEspacio($id)
        {
            $db = Zend_Db_Table_Abstract::getDefaultAdapter();
            $select = $db ->select()
                    ->from('Espacios')
                    ->where("Id =?",$id);
           
            $sql = $db->query($select);
            return  $rows = $sql->fetchAll();
        }

        public function actualizar($id,$datos)
        {
            $where = "Id=$id";
            return $this->update($datos, $where);
        }
    }

