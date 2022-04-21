<?php
if(!class_exists('CouponsModel'))
    require_once _PS_MODULE_DIR_ . 'coupons/classes/CouponsModel.php';
class AdminCouponsController extends ModuleAdminController
{        
    public function __construct()
    {
        $this->lang = false;
        $this->bootstrap = true;
        $this->table = 'coupons';
        $this->identifier = 'id_coupons';
        $this->className = 'CouponsModel';          

        Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.$this->table);

        $this->fieldImageSettings =
        array (
            array(
                'name' => 'supplier_logo',
                'dir' => 'couponsLogo'
            ),
            array(
                'name' => 'img_cover',
                'dir' => 'couponsCover'
            )
        );        

        $this->fields_list = [
            'id_coupons'       => [
                'title' => $this->l('ID'),
                'type'  => 'text',
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ],
            'supplier_name'     => [
                'title' => $this->l('Supplier'),
                'type'  => 'text',
            ],
            'supplier_logo' => [
                'title' => $this->l('Logo'),
                'image' => 'couponsLogo',
                'orderby' => false,
                'search' => false,
                'align' => 'center',
            ],                       
            'description'     => [
                'title' => $this->l('Description'),
                'type'  => 'text',
            ],
            /*
            'img_cover' => [
                'title' => $this->l('Cover'),
                'image' => 'couponsCover',
                'orderby' => false,
                'search' => false,
                'align' => 'center',
            ],       
            */      
            'discount_rate'     => [
                'title' => $this->l('Discount Rate'),
                'type'  => 'text',
            ],
            'discount_code'     => [
                'title' => $this->l('Discount Code'),
                'type'  => 'text',
            ],            
            'date_add' => [
                'title' => $this->l('Created'),
                'type'  => 'datetime',
            ],
            'date_upd' => [
                'title' => $this->l('Updated'),
                'type'  => 'datetime',
            ],
            'active'   => [
                'title'  => $this->l('Status'),
                'active' => 'status',
                'align'  => 'text-center',
                'class'  => 'fixed-width-sm'
            ],
        ];

        $this->actions = ['edit', 'delete'];
        
        $this->bulk_actions = array(
            'delete' => array(
                'text'    => $this->l('Delete selected'),
                'icon'    => 'icon-trash',
                'confirm' => $this->l('Delete selected items?'),
            ),
        );
        
        parent::__construct();
    }

    public function renderForm(){

        if (!($coupons = $this->loadObject(true))) {
            return;
        }

        $cover = CouponsModel::$folder_cover_dir.'/'.$coupons->id.'.jpg';
        $cover_url = ImageManager::thumbnail($cover, $this->table.'_cover_'.(int)$coupons->id.'.'.$this->imageType, 350,
            $this->imageType, false, false);
        $cover_size = file_exists($cover) ? filesize($cover) / 1000 : false;

        $logo = CouponsModel::$folder_logo_dir.'/'.$coupons->id.'.jpg';
        $logo_url = ImageManager::thumbnail($logo, $this->table.'_logo_'.(int)$coupons->id.'.'.$this->imageType, 350,
            $this->imageType, false, false);
        $logo_size = file_exists($logo) ? filesize($logo) / 1000 : false;
                        
        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('Coupons'),
                'icon' => 'icon-certificate'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Supplier'),
                    'name' => 'supplier_name',
                    'col' => 4,
                    'required' => true,
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Logo'),
                    'name' => 'supplier_logo',
                    'image' => $logo_url ? $logo_url : false,
                    'size' => $logo_size,
                    'display_image' => true,
                    'col' => 6,
                    'hint' => $this->l('Upload a supplier logo from your computer.')
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Description'),
                    'name' => 'description',                    
                    'cols' => 60,
                    'rows' => 10,
                    'col' => 6,                    
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Cover'),
                    'name' => 'img_cover',
                    'image' => $cover_url ? $cover_url : false,
                    'size' => $cover_size,
                    'display_image' => true,
                    'col' => 6,
                    'hint' => $this->l('Upload a coupon cover from your computer.')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Discount Rate'),
                    'name' => 'discount_rate',
                    'col' => 4,
                    'required' => true,
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Discount Code'),
                    'name' => 'discount_code',
                    'col' => 4,
                    'required' => true,
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),                
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enable'),
                    'name' => 'active',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    )
                )
            )
        );

        $this->fields_form['submit'] = array(
            'title' => $this->l('Save')
        );

        return parent::renderForm();
    }
   
    public function initContent()
    {
        parent::initContent();       
    }    
}