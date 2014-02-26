<?php

/**
 * Store Module class file.
 *
 * @author Syed Ekram Uddin Emon <ekram.syed@gmail.com>
 * @copyright Copyright &copy; 2014 jebmarket.com
 * @version 1.0.0
 *
 * DO NOT CHANGE THE DEFAULT CONFIGURATION VALUES!
 *
 * You may overload the module configuration values in your configuration like so:
 *
 * 'modules'=>array(
 *     'store'=>array(
 *         'debug' => 'true',
 *         'install'   => 'true',
 *     ),
 * ),
 *
 */
class StoreModule extends CWebModule {

    public $version = '0.1';

    public $description = 'Yii Module that adds online store capability to any Yii application';

    public $layout = 'store.views.layouts.main';

    public $debug = false;

    public $install = false;

    public $transactionType = array();

    public $transactionPeriod = array();


	public function init() {
        $this->setImport(array(
			'store.models.*',
			'store.components.*',
		));

        if( empty($this->transactionType) ) $this->transactionType = $this->getStoreTransactionFeeType();

        if( empty($this->transactionPeriod) ) $this->transactionPeriod = $this->getStoreTransactionPeriod();

        if(!Yii::app()->getModule('rights')) {
            //TODO: flash warning to superuser to use store module along with rights module to maximum security
        }

        $this->defaultController = 'store';
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
            return true;
		}
		else {
			return false;
        }
	}

    public function getStoreTransactionFeeType(){
        return array(
            '1' => 'Free',
            '2' => 'Percentage Share',
            '3' => 'Fixed'
        );
    }

    public function getStoreTransactionPeriod(){
        return array(
            '1' => 'On every transaction',
            '2' => 'Weekly',
            '3' => 'Monthly',
            '4' => 'Half Yearly',
            '5' => 'Yearly'
        );
    }

    /**
     * @override
     * @return string|void
     */
    public function getDescription() {
        return $this->description;
    }
}
