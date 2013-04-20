<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	//- Routes -//
	public function _initRoute()
	{
		$router = Zend_Controller_Front :: getInstance() 
					-> getRouter();

		//- Get routes -//
		$config = new Zend_Config_Ini( 
			APPLICATION_PATH . '/configs/routes.ini', 
			'production' 
		);

		//- Add routes to system -//
		$router -> addConfig( $config, 'routes' );
	}
	
	//- Data Base -//
	public function _initDataBase()
	{
		//- Get adapter -//
		$db = $this -> getPluginResource( 'db' ) -> getDbAdapter();
	
		//- Set default adapter -//
		Zend_Db_Table :: setDefaultAdapter( $db );
	
		//- Registry adapter -//
		Zend_Registry :: set( 'db', $db );
	}
}

