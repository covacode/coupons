<?php

class AdminCouponsController extends ModuleAdminController
{        
    public function init()
    {
        parent::init();
        $this->bootstrap = true;
    }

    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign(array(
            'myvar' => 'hello'
        ));
        $this->setTemplate('coupons.tpl');
    }
}