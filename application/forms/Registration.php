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
			
		//- Content :: Main -//
		//- Login -//		
		$username = new Zend_Form_Element_Text( 'username' );
			$username -> setLabel( 'Username' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '32'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_Alnum() );
				
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
				
		$submit = new Zend_Form_Element_Submit( 'submit' );
			$submit -> setLabel( 'Register' );
			
		//- Add elements to form -//
		$this -> addElement( $login )
			-> addElement( $password )
			-> addElement( $submit );
			
		//- Create group for display -//
		$this -> addDisplayGroup(
			array( 
				'username', 
				'password', 				
				'submit'
			), 
			'auth' 
		);
		
		$confirmGroup = $this -> getDisplayGroup( 'auth' )
			-> setLegend( 'Authorization data' );
		
		//- Tools -//
		$confirmGroup -> setDecorators(
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
    }

}

