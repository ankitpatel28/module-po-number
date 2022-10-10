<?php
/**
* Copyright © 2019 Magenest. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Ankitdev\PoNumber\Setup\Patch\Schema;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class AddColumn implements SchemaPatchInterface
{
   private $moduleDataSetup;


   public function __construct(
       ModuleDataSetupInterface $moduleDataSetup
   ) {
       $this->moduleDataSetup = $moduleDataSetup;
   }


   public static function getDependencies()
   {
       return [];
   }


   public function getAliases()
   {
       return [];
   }


   public function apply()
   {
       $this->moduleDataSetup->startSetup();


       $this->moduleDataSetup->getConnection()->addColumn(
           $this->moduleDataSetup->getTable('quote'),
           'checkout_purchase_order_no',
           [
               'type' => Table::TYPE_TEXT,
               'length' => 255,
               'nullable' => true,
               'comment'  => 'Checkout Purchase Order No',
           ]
       );
       $this->moduleDataSetup->getConnection()->addColumn(
           $this->moduleDataSetup->getTable('sales_order'),
           'checkout_purchase_order_no',
           [
               'type' => Table::TYPE_TEXT,
               'length' => 255,
               'nullable' => true,
               'comment'  => 'Checkout Purchase Order No',
           ]
       );


       $this->moduleDataSetup->endSetup();
   }
}