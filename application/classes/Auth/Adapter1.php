<?php

class Auth_Adapter
	implements
		Zend_Auth_Adapter_Interface
{
	///	***	Constants	***	///
	const AUTH = 
	"SELECT 
		user.id, 
		role.title AS role, 
		email.contact 
	FROM 
		(user 
			LEFT JOIN 
		email 
			ON( user.id = email.id_user )
		)
			LEFT JOIN 
		role 
			ON( role.id = user.id_role ) 
	WHERE 
		email.contact = '%s' 
		AND 
		user.password = MD5( '%s' ) 
	LIMIT 
		1
	";
		
	///	***	Properties	***	///
	protected $link;
	protected $userData;
	
	///	***	Methods		***	///
	public function __construct( /*string*/$UserName, /*string*/$Password )
	{
		//- Set properties -//
		$this -> username = $UserName;
		$this -> password = $Password;
		
/*		$param = new Zend_Config_Ini( 'configs/application.ini', 'production' );
	
		$params = array(
			'host'		=> $param -> resources -> db -> params -> host, 
			'username'	=> $param -> resources -> db -> params -> username, 
			'password'	=> $param -> resources -> db -> params -> password, 
			'dbname'	=> $param -> resources -> db -> params -> dbname
		);
		
		$this -> link = Zend_Db :: factory( $param  -> resources -> db -> adapter, $params );
		*/
		$this -> link = Zend_Registry :: get( 'db' );
	}
	
	public function authenticate()
	{		
		$res = $this -> link -> query(
			sprintf(
				self :: AUTH, 
				//- Params -//
				$this -> username, 
				$this -> password
			)
		) -> fetch( PDO :: FETCH_OBJ );
		
		//- Test response from DB -//
		if( $res )
		{
			//- Set properties -//
			$this -> userData = $res;
			
			return new Zend_Auth_Result(
				Zend_Auth_Result :: SUCCESS, $res -> id, array()
			);
		}else
			{
				return new Zend_Auth_Result(
					Zend_Auth_Result :: FAILURE, 
					null, 
					array( 'Authentification is unsuccessfull' )
				);
			}
	}
	
	public function getUserData()// : array
	{
		return $this -> userData;
	}
}