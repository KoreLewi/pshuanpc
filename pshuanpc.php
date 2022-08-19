<?php
/**
 * PrestaHU
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Commercial License
 * you can't distribute, modify or sell this code
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file
 * If you need help please contact info@presta.hu
 *
 * @author    PrestaHU <info@presta.hu>
 * @copyright PrestaHU
 * @license   free
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Pshuanpc extends Module
{
    public function __construct()
    {
        $this->name = 'pshuanpc';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'PrestaHU';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Display ANPC pictograms');
        $this->description = $this->l('Display ANPC pictograms Display ANPC pictograms');

        $this->confirmUninstall = $this->l('Are you sure you want uninstall this module?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('displayFooter');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }


    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayFooter()
    {
        $this->context->smarty->assign([
            'anpc_sal' => Media::getMediaPath(_PS_MODULE_DIR_ . $this->name . '/views/img/anpc-sal.png'),
            'anpc_sol' => Media::getMediaPath(_PS_MODULE_DIR_ . $this->name . '/views/img/anpc-sol.png'),
        ]);
        return $this->display(__FILE__, 'views/templates/front/_footer.tpl');
    }
}
