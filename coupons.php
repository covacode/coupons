<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Coupons extends Module
{
    public function __construct()
    {
        $this->name = 'coupons';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Sergio Cova';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '1.6','max' => '1.7.0'];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Coupons');
        $this->description = $this->l('This is a discount coupon management module');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        if(!parent::install() || !$this->registerHook('displayTop'))
            return false;
        $this->installModuleTab();
        return true;
    }
               
    public function uninstall()
    {
        if(!parent::uninstall() || !$this->unregisterHook('displayTop'))
            return false;
        $this->uninstallModuleTab();
        return true;
    }       

    public function hookDisplayTop()
    {        
        return $this->display(__FILE__, 'views/templates/hook/coupons.tpl');        
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