<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	public function _initDataBase()
	{
		//- Get adapter -//
		$db = $this -> getPluginResource( 'db' ) -> getDbAdapter();
	
		//- Set default adapter -//
		//Zend_Db_Table :: setDefaultAdapter( $db );
	
		//- Registry adapter -//
		Zend_Registry :: set( 'db', $db );
			
		Zend_Db_Table::setDefaultAdapter($db);
	}
}

