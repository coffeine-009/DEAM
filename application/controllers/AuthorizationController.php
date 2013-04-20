<?php

class AuthorizationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

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
				Zend_Loader :: loadFile( 'classes/Auth/Adapter.php' );
				
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
					$this -> _redirect( '/' . strtolower( $this -> session -> user -> role ) );
				}else
					{
						//- Display message: Error, authenticate -//
						array_push( 
	    					$this -> view -> errors, 
	    					'Error, Can not authentificate user. Repeat, please!'
	    				);
	    				return;
					}
			}else
				{
					//- Data is not valid -//
					array_push( 
    					$this -> view -> errors, 
    					'Error, data is not valid. Repeat, please!'
    				);
    				return;
				}
		}
		
		//- Init view -//
		$this -> view -> form = $formAuth;
	
    }

    public function logoutAction()
    {
		//- Destroy user session -//
		Zend_Auth :: getInstance() -> clearIdentity();
		Zend_Session :: destroy();
    }

    public function registrationAction()
    {
    	//- Create form of registration -//
        $form = new Application_Form_Registration();
        
        //- Test submit of form -//
        if( $this -> getRequest() -> isPost() )
        {
        	//- Validation submited form -//
        	if( $form -> isValid( $this -> getRequest() -> getPost() ) )
        	{
        		//TODO: Send email and create user
        		        		
        		
        		//- Registration success -//
        		$this -> _redirect( '/registration/success' );
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









