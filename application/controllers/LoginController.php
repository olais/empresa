<?php
    class LoginController extends Zend_Controller_Action
    {

        public function init()
        {

        }

        public function indexAction()
        {
            $this->view->layout()->metaDescription  = "Login";
            $this->view->layout()->metaTags         = "Login";
            $this->view->layout()->pageTitle        = "Login";
        }
    }