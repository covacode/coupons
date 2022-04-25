<?php
if(!class_exists('CouponsModel'))
    require_once _PS_MODULE_DIR_ . 'coupons/classes/CouponsModel.php';
    
class CouponsCouponModuleFrontController extends ModuleFrontController
{ 
    public $display_column_left = false;
    
    public function initContent(){                       
        parent::initContent();

        $coupons = CouponsModel::getCouponsByPk($_GET['id_coupons'], true);          
        $this->context->smarty->assign(array(
            'coupons' => $coupons,
            'pathLogo' => 'http://localhost/PrestaShop/img/couponsLogo/',
            'pathCover' => 'http://localhost/PrestaShop/img/couponsCover/'
        ));

        $this->setTemplate('coupon.tpl');
    }
}