<?php
///	***	Class :: Form.Registration	***	***	***	***	***	***	***	***	***	***	///

	/**	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*
	 * 																	*
	 * @copyright 2013
	 * 		by
	 * @author Vitaliy Tsutsman
	 * 
	 * @date 2013-04-14 18:30:17 :: 2013-04-14 ..:..:..
	 * 
	 * @address Poland/Krakow/Budryka/5/414
	 * 
	 * @description
	 *	Form for registration user on system
	 *																	*
	*///***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*

///	***	Code	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	///
class Application_Form_Registration
	extends
		Zend_Form
{

	///	***	Methods		***	///	
    public function init()
    {
        //- Init -//
		$this -> setAction( '/authorization/registration' )//TODO: change
			-> setMethod( 'post' );
			
		//- Content :: Main :: Fields -//
		//- Username -//		
		$username = new Zend_Form_Element_Text( 'username' );
			$username -> setLabel( 'Username' ) 
				-> setOptions( 
					array(
						'id'		=> 'username', 					
						//- Params -//
						'size' 		=> '30', 
						'maxlength'	=> '32'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_Alnum() );

		//- Password -//
		$password = new Zend_Form_Element_Password( 'password' );
			$password -> setLabel( 'Password' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() );
				
		//- Password -//
		$password_r = new Zend_Form_Element_Password( 'password_r' );
			$password_r -> setLabel( 'Repeat password' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() );

				
		//- Names -//
		//- First name -//
		$first_name = new Zend_Form_Element_Text( 'first_name' );
			$first_name -> setLabel( 'First name' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_Alpha() );
				
		//- First name -//
		$second_name = new Zend_Form_Element_Text( 'second_name' );
			$second_name -> setLabel( 'Second name' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_Alpha() );
				
		//- First name -//
		$father_name = new Zend_Form_Element_Text( 'father_name' );
			$father_name -> setLabel( 'Father name' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_Alpha() );
				
				
		//- Contacts -//
		//- E-mail -//
		$email = new Zend_Form_Element_Text( 'email' );
			$email -> setLabel( 'E-mail' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_EmailAddress() );
				
		//- Phone -//
		$phone = new Zend_Form_Element_Text( 'phone' );
			$phone -> setLabel( 'Phone' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_Digits() );//TODO: ?
				
		//- Web-site -//
		$webSite = new Zend_Form_Element_Text( 'web_site' );
			$webSite -> setLabel( 'Web-site' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() );

				
		//- License -//
		$license = new Zend_Form_Element_Checkbox( 'license' );
			$license -> setLabel( 'I confirm license' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '40'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() );
				
		$submit = new Zend_Form_Element_Submit( 'submit' );
			$submit -> setLabel( 'Register' );
			
			
		
		//- Add elements to form -//
		$this -> addElements(
			array(
				$username, 
				$password, 
				$password_r
			)
		);

		
		//- Create group for display -//
		$this -> addDisplayGroup(
			array( 
				'username', 
				'password', 
				'password_r'
			), 
			'auth' 
		);		
		$authData = $this -> getDisplayGroup( 'auth' )
			-> setLegend( 'Authorization data' );
			


		//- Names -//
		$this -> addElements(
			array(
				$first_name, 
				$second_name, 
				$father_name
			)
		);
				
		//- Create group for display -//
		$this -> addDisplayGroup(
			array( 
				'first_name', 
				'second_name', 
				'father_name'
			), 
			'names'
		);		
		$Names = $this -> getDisplayGroup( 'names' )
			-> setLegend( 'Names' );

		
		//- Contacts -//
		$this -> addElements(
			array(
				$email, 
				$phone, 
				$webSite
			)
		);

		$this -> addDisplayGroup(
			array(
				'email', 
				'phone', 
				'web_site'
			), 
			'contacts'
		);
		$Contacts = $this -> getDisplayGroup( 'contacts' )
			-> setLegend( 'Contacts' );
			
		//- Tools -//
		$authData -> setDecorators(
			array(
				'FormElements', 
				'Fieldset', 
				array(
					'HtmlTag', 
					array(
						'tag'	=> 'div', 
						'style'	=> ''
					)
				)
			)
		);
		
		//- Names -//
		$Names -> setDecorators(
			array(
				'FormElements', 
				'Fieldset', 
				array(
					'HtmlTag', 
					array(
						'tag'	=> 'div', 
						'style'	=> ''
					)
				)
			)
		);
		
		//- Contacts -//
		$Contacts -> setDecorators(
			array(
				'FormElements', 
				'Fieldset', 
				array(
					'HtmlTag', 
					array(
						'tag'	=> 'div', 
						'style'	=> ''
					)
				)
			)
		);

		
		//- Submit -//
		$this -> addElements(
			array(
				$license, 
				$submit
			)
		);
    }

}

