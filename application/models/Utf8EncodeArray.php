<?php

class Application_Model_Utf8EncodeArray
{
    public function encode($dat){
          if (is_string($dat)) return utf8_encode($dat);
          if (!is_array($dat)) return $dat;
          $ret = array();
          foreach($dat as $i=>$d) $ret[$i] = $this->encode($d);
          return $ret;
    }

    public function decode($dat){
          if (is_string($dat)) return utf8_decode($dat);
          if (!is_array($dat)) return $dat;
          $ret = array();
          foreach($dat as $i=>$d) $ret[$i] = $this->decode($d);
          return $ret;
    }
}

