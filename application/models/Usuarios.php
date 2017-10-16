<?php
class Application_Model_Usuarios extends Zend_Db_Table_Abstract
{
    protected $_name = 'usuarios';
    protected $_primary='Id_usuario';
    
    public function consultar($letra)
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select = $db->select()
            ->from ("usuarios")
            ->where("Nombre LIKE '$letra%'")
            ->order('Id_usuario DESC');
        $sql = $db->query($select);
        
        return  $row = $sql->fetchAll();

    }
    
    public function consultarCliente($id){
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select = $db->select()
            ->from ("clientes")
            ->where("Id_cliente=?",$id);
        $sql = $db->query($select);
    return  $row = $sql->fetchAll();

    }



    public function guardar($datos)
    {
        return $this->insert($datos);

    }
    public function actualizar($datos,$id){
      //$datos=array("Id_stComponente"=>20, "Fecha_Inicio"=>date("Y-m-d H:i:S"));
      $where = "Id_cliente=$id";
      return $this->update($datos, $where);
    }
    
    
}