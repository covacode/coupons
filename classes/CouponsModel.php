<?php
require_once 'CouponsObjectModel.php';

class CouponsModel extends CouponsObjectModel
{
    public $id_coupons;
    public $supplier_name;
    public $supplier_logo;
    public $description;
    public $img_cover;
    public $discount_rate;
    public $discount_code;    
    public $date_add;
    public $date_upd; 
    public $active = true;

    public static $definition = [
        'table'     => 'coupons',
        'primary'   => 'id_coupons',
        'multilang' => false,
        'fields'    => [
            'id_coupons'   => ['type' => self::TYPE_INT, 'validate' => 'isInt'],
            'supplier_name'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(50)', 'lang' => false],
            'supplier_logo'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => false],
            'description'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(100)', 'lang' => false],
            'img_cover'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => false],
            'discount_rate'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(10)', 'lang' => false],
            'discount_code'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(10)', 'lang' => false],            
            'date_add'      => [
                'type'     => self::TYPE_DATE,
                'validate' => 'isDate',
                'db_type'  => 'datetime',
            ],
            'date_upd'      => [
                'type'     => self::TYPE_DATE,
                'validate' => 'isDate',
                'db_type'  => 'datetime',
            ],
            'active'       => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'db_type' => 'int(1)'],
        ],
    ];       
}
