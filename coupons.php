<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Coupons extends Module
{
    public function __construct()
    {
        $this->name = 'coupons';        
        $this->version = '1.0.0';
        $this->author = 'Sergio Cova';        
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;        
        $this->displayName = $this->l('Coupons');
        $this->description = $this->l('This is a discount coupon management module');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        $this->tab = 'administration';
        $this->controller = array('coupons');
        parent::__construct();
    }

    public function install()
    {        
        return parent::install() && $this->installModuleTab();
    }

    public function uninstall()
    {
        return $this->uninstallModuleTab() && parent::uninstall();
    }

    public function installModuleTab()
    {
        $tab = new Tab;
        $langs = language::getLanguages();
        foreach ($langs as $lang)
            $tab->name[$lang['id_lang']] = 'Coupons';
        $tab->module = $this->name;
        $tab->id_parent = 0;
        $tab->class_name = 'AdminCoupons';
        return $tab->save();
    }

    public function uninstallModuleTab()
    {
        $id_tab = Tab::getIdFromClassName('AdminCoupons');

        if($id_tab)
        {
            $tab = new Tab($id_tab);
            return $tab->delete();
        }
        return true;
    }
}