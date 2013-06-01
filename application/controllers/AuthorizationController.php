<?php

class AuthorizationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this -> view -> errors = array();
    }

    public function indexAction()
    {
        // action body
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
	    					$this -> view -> errors, 
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
		//- Destroy user session -//
		Zend_Auth :: getInstance() -> clearIdentity();
		Zend_Session :: destroy();
    }

    //- Registration -//
    public function registrationAction()
    {
    	//- Include css -//
    	$this -> view -> headLink() -> appendStylesheet(
    		'/client/application/views/styles/authorization/registration.css'
    	);
    	
    	//- Include JS -//
    	$this -> view -> headScript() -> appendFile(
    		'/client/application/views/scripts/authorization/registration.js'
    	);
    	
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
		        		
		        		//- Send activation letter -//
		        		
		        		//TODO: Send email and create user
		        		        		
		        		
		        		//- Registration success -//
		        		$this -> _redirect( '/registration/success' );
        			}
        	}
        }
        
        //- Init view -//
        $this -> view -> form = $form;
    }

    public function registrationsuccessAction()
    {
        // action body
    }


}









