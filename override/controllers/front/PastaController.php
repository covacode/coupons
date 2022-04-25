<?php
if(!class_exists('CouponsModel'))
    require_once _PS_MODULE_DIR_ . 'coupons/classes/CouponsModel.php';

class PastaController extends FrontController 
{
    public function initContent(){
        die('This is working!!');
    }
}