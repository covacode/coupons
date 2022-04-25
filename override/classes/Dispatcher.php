<?php

class Dispatcher extends DispatcherCore 
{
  public function __construct(){
    $this->default_routes['use-a-unique-id-here'] = [
      'controller' => 'pasta', // will be linked to PastaController (see next section)
      'rule' => 'my-pasta', //  the actual URL without trailing slash
      'keywords' => [],
    ];
    parent::__construct();
  }
}