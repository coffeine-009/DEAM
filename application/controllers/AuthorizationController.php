<?php

require_once APPLICATION_PATH . '/controllers/BaseController.php';

class AuthorizationController
	extends
		//Zend_Controller_Action
		BaseController
{

    public function init()
    {
		parent :: init();
//    	$this -> view -> errors = array();
    }

    public function indexAction()
    {
    	//- Send activation letter -//
        $letter = new Coffeine_Messenger_Mail_Main(
			"vitalij-bass@meta.ua",
	    	'Registration. deam.if.ua'
	    );
	    $letter -> setTemplate(
	    	APPLICATION_PATH . '/templates/',
	    	'LetterActivation_uk_UA.phtml', // . Zend_Registry :: get( 'Zend_Locale' ) . '.phtml',
	    	array(
		    	'user'	=> (object)array(
			    	//'id'	=> $this -> id, 
			    	'secureHash'	=> 'developer'
	    		)
	    	)
	    );
    	$letter -> setAddressSrc( 'DEAM' );
    	$letter -> init();
	    		 
    	if( !$letter -> send() )
    	{
    		//- ERROR -//
    		throw new Zend_Controller_Action_Exception( 'Email not sent' );
    	}
    	echo 'ok';
    }

	//- Sign In -//
    public function loginAction()
    {
	    //- Create form -//
		$formAuth = new Application_Form_Authorization();
		
		//- Get input data -//
		if( $this -> getRequest() -> isPost() )
		{
			//- Validate -//
			if( $formAuth -> isValid( $this -> getRequest() -> getPost() ) )
			{
				//- Get Params -//
				$data = $formAuth -> getValues();				
					$login 		= $data[ 'login' ];
					$password 	= $data[ 'password' ];
						
				//- Create adapter for authenticate -//
				Zend_Loader :: loadFile( 'Auth/Adapter.php' );
				
				$adapter = new Auth_Adapter( $login, $password );
							 
				//- Authenticate -//
				$auth = Zend_Auth :: getInstance();
							
				if( $auth -> authenticate( $adapter ) -> isValid() )
				{
					//- User is authenticate -//
					$this -> session = new Zend_Session_Namespace( 'system.user' );
					
					//- Save data about current user in session -//
					$this -> session -> user = $adapter -> getUserData();
					
					//- Redirect to default -//
					$this -> _redirect( 
						'/' . strtolower( $this -> session -> user[ 'role' ][ 'title' ] ) 
					);
				}else
					{
						//- Display message: Error, authenticate -//
						array_push( 
	    					$this -> errors, 
	    					'Error, Can not authentificate user. Repeat, please!'
	    				);
					}
			}else
				{
					//- Data is not valid -//
					array_push( 
    					$this -> view -> errors, 
    					'Error, data is not valid. Repeat, please!'
    				);
				}
		}
		
		//- Init view -//
		$this -> view -> form = $formAuth;
	
    }

    //- Sign out -//
    public function logoutAction()
    {
    	$this -> view -> user = null;
    	$this -> view -> userFirstName = $this -> session -> user[ 'first_name' ];
    	
		//- Destroy user session -//
		Zend_Auth :: getInstance() -> clearIdentity();
		Zend_Session :: destroy();
    }

    
    //- Forgot -//
    public function forgotAction()
    {
    	//- Validation -//
    	$input = new Application_Form_Forgot();
    	
    	//- Init view -//
    	$this -> view -> form = $input;
    	
    	if( $this -> getRequest() -> isPost() )
    	{
    		//- Test -//
    		if( $input -> isValid( $this -> getRequest() -> getPost() ) )
    		{
    			//- Test -//
    			$q = Doctrine_Query :: create()
    				-> select( 'e.contact contact, u.id id' )
    				-> from( 'DEAM_Email e' )
    				-> addFrom( "e.User u" )
    				-> where( "e.contact = '{$input -> getValue( 'email' )}'" )
    				-> limit( 1 );
    				
    			$data = $q -> fetchArray();
    			
    			if( count( $data ) === 0 )
    			{
    				throw new Zend_Controller_Action_Exception( 'User not found' );
    			}

    			//- Generate secure hash -//
    			$sh = new Coffeine_Crypt_PassGenerator( 8 );
    				$sh -> generate();
    				
    			//- Save secure hash to DB -//
    			$forgot = Doctrine :: getTable( 'DEAM_User' )
    				-> find( (int)$data[ 0 ][ 'id' ] );
    				
    				$forgot -> password = md5( $sh -> getPassword() );
    				
    			$forgot -> save();
    			
    			//- Send email: secure hash -//
    			//- Send activation letter -//
        		$letter = new Coffeine_Messenger_Mail_Main(
					$data[ 0 ][ 'contact' ],
			    	'Registration. deam.if.ua'
			    );
			    $letter -> setTemplate(
			    	APPLICATION_PATH . '/templates/',
			    	'LetterForgot_uk_UA.phtml', // . Zend_Registry :: get( 'Zend_Locale' ) . '.phtml',
			    	array(				    	 
					    'password'	=> $sh -> getPassword()			    		
			    	)
			    );
	    		$letter -> setAddressSrc( 'DEAM' );
	    		$letter -> init();
			    		 
	    		if( !$letter -> send() )
	    		{
	    			//- ERROR -//
	    			throw new Zend_Controller_Action_Exception( 'Email not sent' );
	    		}
			    		 
	    		//- Add message -//
	    		$this -> _helper -> flashMessenger -> addMessage(
		    		'Recovery access is successfull. Pass was sent'
	    		);//TODO: Other msg
	    		
        		//- Registration success -//
        		return $this -> _redirect( '/forgot/success' );
    		}else
    			{
    				//- ERROR :: Invalid input -//
    				$this -> errors[] = 'Email is not valid';
    			}
    	}
    }
    
    //- Forgot success -//
    public function forgotsuccessAction()
    {
    	$this -> view -> msg = $this -> _helper -> flashMessenger -> getMessages();
    }
    
       
    //- Registration -//
    public function registrationAction()
    {
    	//- Include css -//
    	$this -> view -> headLink() -> appendStylesheet(
    		'/client/application/views/styles/authorization/registration.css'
    	);
    	
    	//- Include JS -//
    	/*$this -> view -> headScript() -> appendFile(
    		'/client/application/views/scripts/authorization/registration.js'
    	);*/
    	
    	//- Create form of registration -//
        $form = new Application_Form_Registration();
        
        //- Test submit of form -//
        if( $this -> getRequest() -> isPost() )
        {
        	//- Validation submited form -//
        	if( $form -> isValid( $this -> getRequest() -> getPost() ) )
        	{
        		//- Get data -//
        		$data = $form -> getValues();
        		
        		if( $data[ 'password' ] != $data[ 'password_r' ] || !$data[ 'license' ] )
        		{
        			$form -> addErrorMessage( 'Passwords not equal' );
        		}else
        			{        		
		        		//- Create new user -//
		        		$user = new DEAM_User();
		        			$user -> id_role = 2;//TODO: Get role from DB
		        			$user -> password = md5( $data[ 'password' ] );
		        			$user -> first_name = $data[ 'first_name' ];
		        			$user -> second_name = $data[ 'second_name' ];
		        			$user -> father_name = $data[ 'father_name' ];
		        			
		        		$user -> save();
		        		
		        		//- Add contacts -//
		        		//- Email -//
		        		$email = new DEAM_Email();
		        			$email -> id_user = (int)$user -> id;
		        			$email -> contact = $data[ 'email' ];
		        			
		        		$email -> save();
		        		
		        		//- Phone -//
		        		$phone = new DEAM_Phone();
		        			$phone -> id_user = (int)$user -> id;
		        			$phone -> contact = $data[ 'phone' ];
		        			
		        		$phone -> save();
		        		
		        		//- Web site -//
		        		if( !empty( $data[ 'web_site' ] ) )
		        		{
		        			$web_site = new DEAM_Website();
		        				$web_site -> id_user = (int)$user -> id;
		        				$web_site -> contact = $data[ 'web_site' ];
		        				
		        			$web_site -> save();
		        		}
		        		
		        		
		        		//- Generate secure hash -//
		        		$secure_hash = new Coffeine_Crypt_PassGenerator( 32 );
		        			$secure_hash -> generate();
		        		
		        		//- Save Secure hash -//
		        		$queue = new DEAM_AccountActivation();
		        			$queue -> id_user = (int)$user -> id;
		        			$queue -> secure_hach = $secure_hash -> getPassword();
		        			
		        		$queue -> save();
		        				        			
		        			
		        		//- Send activation letter -//
		        		$letter = new Coffeine_Messenger_Mail_Main(
							$email -> contact,
					    	'Registration. deam.if.ua'
					    );
					    $letter -> setTemplate(
					    	APPLICATION_PATH . '/templates/',
					    	'LetterActivation_uk_UA.phtml', // . Zend_Registry :: get( 'Zend_Locale' ) . '.phtml',
					    	array(
						    	'user'	=> (object)array(
							    	//'id'	=> $this -> id, 
							    	'secureHash'	=> $secure_hash -> getPassword()
					    		)
					    	)
					    );
			    		$letter -> setAddressSrc( 'DEAM' );
			    		$letter -> init();
					    		 
			    		if( !$letter -> send() )
			    		{
			    			//- ERROR -//
			    			throw new Zend_Controller_Action_Exception( 'Email not sent' );
			    		}
					    		 
			    		//- Add message -//
			    		$this -> _helper -> flashMessenger -> addMessage(
				    		'You registration is success!'
			    		);//TODO: Other msg
			    		
		        		//- Registration success -//
		        		$this -> _redirect( '/registration/success' );
        			}
        	}
        }
        
        //- Init view -//
        $this -> view -> form = $form;
    }

    //- Registration success -//
    public function registrationsuccessAction()
    {
		$this -> view -> msg = $this -> _helper -> flashMessenger -> getMessages();
    }
}
