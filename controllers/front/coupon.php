<?php
if(!class_exists('CouponsModel'))
    require_once _PS_MODULE_DIR_ . 'coupons/classes/CouponsModel.php';
    
class CouponsCouponModuleFrontController extends ModuleFrontController
{ 
    public function initContent(){        
        $coupons = CouponsModel::getCouponsByPk($_GET['id_coupons'], true); 
        d($coupons);
        parent::initContent();
    }
}