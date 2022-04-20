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

    public function hookDisplayTop(){
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

    /*
    public function  getContent()
    {
        return $this->postProcess() . $this->getForm();
    }

    public function getForm()
    {
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->languages = $this->context->controller->getLanguages();
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = $this->context->controller->default_form_language;
        $helper->allow_employee_form_lang = $this->context->controller->allow_employee_form_lang;
        $helper->title = $this->displayName;

        $helper->submit_action = 'couponsmodulo';
        $helper->fields_value['texto'] = Configuration::get('URI_MODULO_TEXTO_HOME');
        
        $options = array(
            array(
                'id_option' => 1,
                'name' => 'Supplier 1'
            ),
            array(
                'id_option' => 2,
                'name' => 'Supplier 2'
            ),
        );
        
        $this->form[0] = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->displayName
                 ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Title'),
                        'desc' => $this->l('Title for the discount coupon'),
                        'hint' => $this->l('Title for the discount coupon'),
                        'name' => 'title',
                        'lang' => false,
                        'required' => true, 
                     ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Supplier'),
                        'desc' => $this->l('Item Supplier'),
                        'hint' => $this->l('Item Supplier'),
                        'name' => 'supplier',
                        'lang' => false,
                        'required' => true,                          
                        'options' => array(
                            'query' => $options,
                            'id' => 'id_option',
                            'name' => 'name'
                        )                        
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Discount (%)'),
                        'desc' => $this->l('Discount rate'),
                        'hint' => $this->l('Discount rate'),
                        'name' => 'discountRate',
                        'lang' => false,
                        'required' => true, 
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Discount Code'),
                        'desc' => $this->l('Discount code'),
                        'hint' => $this->l('Discount code'),
                        'name' => 'discountCode',
                        'lang' => false,
                        'required' => true, 
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->l('Description'),
                        'desc' => $this->l('Description'),
                        'hint' => $this->l('Description'),
                        'name' => 'description',
                        'lang' => false,
                        'required' => true, 
                    ),
                    array(
                        'type' => 'file',
                        'label' => $this->l('Cover Image'),
                        'desc' => $this->l('Cover Image'),
                        'hint' => $this->l('Cover Image'),
                        'name' => 'image',
                        'lang' => false,
                        'required' => true, 
                    ),
                 ),
                'submit' => array(
                    'title' => $this->l('Save')
                 )
             )
         );
        return $helper->generateForm($this->form);
    }

    public function postProcess()
    {        
        if(Tools::isSubmit('couponsmodulo')){

        }
    }
    */
}