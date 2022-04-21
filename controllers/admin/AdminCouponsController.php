<?php
require_once _PS_MODULE_DIR_ . 'coupons/classes/CouponsModel.php';
class AdminCouponsController extends ModuleAdminController
{        
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'coupons';
        $this->identifier = 'id_coupons';
        $this->className = 'CouponsModel';  

        parent::__construct();

        Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.$this->table);

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
            'supplier_logo'     => [
                'title' => $this->l('Logo'),
                'type'  => 'text',
            ],            
            'description'     => [
                'title' => $this->l('Description'),
                'type'  => 'text',
            ],
            'img_cover'     => [
                'title' => $this->l('Cover'),
                'type'  => 'text',
            ],
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

        //fields to add/edit form
        $this->fields_form = [
            'legend' => [
                'title' => $this->l('General Information'),
            ],
            'input'  => [
                'supplier_name'   => [
                    'type'     => 'text',
                    'label'    => $this->l('Supplier'),
                    'name'     => 'supplier_name',
                    'required' => true,                    
                ],
                'supplier_logo'   => [
                    'type'     => 'file',
                    'label'    => $this->l('Logo'),
                    'name'     => 'supplier_logo',
                    'required' => true,                    
                ],
                'description'   => [
                    'type'     => 'textarea',
                    'label'    => $this->l('Description'),
                    'name'     => 'description',
                    'required' => true,                    
                ],     
                'img_cover'   => [
                    'type'     => 'file',
                    'label'    => $this->l('Cover'),
                    'name'     => 'img_cover',
                    'required' => true,                    
                ],     
                'discount_rate'   => [
                    'type'     => 'text',
                    'label'    => $this->l('Discount Rate'),
                    'name'     => 'discount_rate',
                    'required' => true,                    
                ],      
                'discount_code'   => [
                    'type'     => 'text',
                    'label'    => $this->l('Discount Code'),
                    'name'     => 'discount_code',
                    'required' => true,                    
                ], 
                'active' => [
                    'type'   => 'switch',
                    'label'  => $this->l('Active'),
                    'name'   => 'active',
                    'values' => [
                        [
                            'id'    => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id'    => 'active_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
            ],
        ];
    }
   
    public function initContent()
    {
        parent::initContent();       
    }
}