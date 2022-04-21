<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

if(!class_exists('CouponsModel'))
    require_once _PS_MODULE_DIR_ . 'coupons/classes/CouponsModel.php';

class Coupons extends Module
{
    /**
     * The models should extends CouponsObjectModel.
     * When installing, the module will create the relative to each model
     * in the database. If the table already exists, any missing coluns
     * in it will be added.
     */
    public $models = ['CouponsModel'];
    
    /**
    * Module __construct
    */
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

    /**
    * Module install
    */
    public function install()
    {        
        $this->_clearCache('*');

        foreach ($this->models as $model)
        {
            require_once $this->local_path.'classes/' . $model . '.php';
            $modelInstance = new $model();
            $modelInstance->createDatabase();
            $modelInstance->createMissingColumns();
        }

        if(!parent::install() ||             
            !$this->registerHook('displayHomeTab') ||
            !$this->registerHook('displayHomeTabContent') ||
            !$this->registerHook('displayHeader') ||            
            !$this->installFolderLogo()||
            !$this->installFolderCover())
            return false;
        $this->installModuleTab();            
        return true;
    }
          
    /**
    * Module uninstall
    */
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

    /**
    * Module hookDisplayHomeTab
    */
    public function hookDisplayHomeTab()
    {             
        return $this->context->smarty->fetch($this->local_path.'views/templates/hook/couponsTab.tpl');              
    }

    /**
    * Module hookDisplayHomeTabContent
    */
    public function hookDisplayHomeTabContent()
    {     
        $texto = 'Hola Mundo';
        $this->context->smarty->assign(array(
            'texto_variable' => $texto,
        ));
        return $this->context->smarty->fetch($this->local_path.'views/templates/hook/couponsTabContent.tpl');              
    }

    /**
    * Module hookDisplayHeader
    */
    public function hookDisplayHeader()
    {     
        $this->context->controller->addCSS($this->local_path.'views/css/estilos.css');
    }

    /**
    * Module installModuleTab
    */
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

    /**
    * Module uninstallModuleTab
    */
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

    /**
    * Module installFolders
    */    
    public function installFolderLogo()
    {
        if(!file_exists(CouponsModel::$folder_logo_dir))
            return mkdir(CouponsModel::$folder_logo_dir, '0777');
        return true;
    }

    public function installFolderCover()
    {
        if(!file_exists(CouponsModel::$folder_cover_dir))
            return mkdir(CouponsModel::$folder_cover_dir, '0777');
        return true;
    }
}