<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView (){
        $view = new Zend_View();
        $view->doctype('HTML5');
    }
    function _initCache() {

        $frontendDriver = 'Core';
        $frontendOptions = array(
            'lifetime' => 7200, // cache lifetime of 2 hours
            'automatic_serialization' => true
        );

        $backendDriver = extension_loaded('memcache') ? 'Memcached' : 'File';
        $backendOptions = array();
        $cache = Zend_Cache::factory($frontendDriver, $backendDriver, $frontendOptions, $backendOptions);

        Zend_Registry::set('Zend_Cache', $cache);
    }

}

