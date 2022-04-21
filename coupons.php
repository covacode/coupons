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
        $this->_clearCache('*');
        if(!parent::install() || 
            !$this->registerHook('displayHomeTab') ||
            !$this->registerHook('displayHomeTabContent') ||
            !$this->registerHook('displayHeader'))
            return false;
        $this->installModuleTab();
        return true;
    }
               
    public function uninstall()
    {
        if(!parent::uninstall() || 
            !$this->unregisterHook('displayHomeTab') ||
            !$this->unregisterHook('displayHomeTabContent') ||
            !$this->unregisterHook('displayHeader'))
            return false;
        $this->uninstallModuleTab();
        $this->_clearCache('*');
        return true;
    }       

    public function hookDisplayHomeTab()
    {             
        return $this->context->smarty->fetch($this->local_path.'views/templates/hook/couponsTab.tpl');              
    }

    public function hookDisplayHomeTabContent()
    {     
        $texto = 'Hola Mundo';
        $this->context->smarty->assign(array(
            'texto_variable' => $texto,
        ));
        return $this->context->smarty->fetch($this->local_path.'views/templates/hook/couponsTabContent.tpl');              
    }

    public function hookDisplayHeader()
    {     
        $this->context->controller->addCSS($this->local_path.'views/css/estilos.css');
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