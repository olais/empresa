<?php


class Application_Model_Menu_Menu extends Zend_Db_Table_Abstract
{

    function llenarmenu(){
                    $select = $this->select()
                                ->from ('PerModRol');
                    $sql = $this->query($select);
                    $rows = $sql->fetchAll();
                    $con=count($rows);
                    $p=$rows[0]['ModuloID']; 
                   
                    
                   return $this->crearmenu($p);
           
                }
                
      function crearmenu($p){
                    
                    return "<li>".$p;
                 
                    
                }
    
               
   
    
}