<?php

class Application_Model_Sesion extends Zend_Db_Table_Abstract
{
    const IDENTITY_NOT_FOUND = "El usuario no existe en el sistema";
    const CREDENTIAL_INVALID = "Password incorrecto";
    const IDENTITY_AMBIGUOUS = "Indentidad de usuario es ambigua";
    const UNCATEGORIZED = "Error por razones desconocidas";
    
    function login($user, $pass)
    {
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter
            ->setTableName('usuarios')
            ->setIdentityColumn('Usuario')
            ->setCredentialColumn('Password')
            ->setIdentity($user)
            ->setCredential($pass)
            ->setCredentialTreatment('? AND Id_estatus = 10');
        $result = Zend_Auth::getInstance()->authenticate($authAdapter);
        if ($result->isValid())
        {
           // los datos del usuario son correctos
            $storage = Zend_Auth::getInstance()->getStorage();
            $bddResultRow = $authAdapter->getResultRowObject(); 
            $storage->write($bddResultRow);
          // $this->_redirect("index");
        }
        else
        {
            switch ($result->getCode())
            {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    // usuario inexistente
                    throw new Exception(self::IDENTITY_NOT_FOUND);
                    break;
                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    // password erroneo
                    throw new Exception(self::CREDENTIAL_INVALID);
                    break;
                case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS:
                    // password erroneo
                    throw new Exception(self::IDENTITY_AMBIGUOUS);
                    break;
                case Zend_Auth_Result::FAILURE_UNCATEGORIZED:
                    // password erroneo
                    throw new Exception(self::UNCATEGORIZED);
                    break; 
                default:
                    /* otro error */
                    throw new Exception(self::FAILURE);
                    break;
            }
            return $this;
        }
    }
}