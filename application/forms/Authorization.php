<?php

/**
 * 
 * Enter description here ...
 * @author vitaliy
 *	@data 2013-01-08 12:04:17 :: 
 */

class Application_Form_Authorization
	extends
		Zend_Form
{
	///	***	Methods		***	///
	public function init()
	{
		//- Init -//
		$this -> setAction( '/login' )
			-> setMethod( 'post' );
			
		//- Content :: Main -//
		//- Login -//		
		$login = new Zend_Form_Element_Text( 'login' );
			$login -> setLabel( 'E-mail' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '80'
					)
				)
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_EmailAddress() );
				
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
			$submit -> setLabel( 'Enter' );
			
		//- Add elements to form -//
		$this -> addElement( $login )
			-> addElement( $password )
			-> addElement( $submit );
			
		//- Create group for display -//
		$this -> addDisplayGroup(
			array( 
				'login', 
				'password', 				
				'submit'
			), 
			'auth' 
		);
		
		$confirmGroup = $this -> getDisplayGroup( 'auth' )
			-> setLegend( 'Authorization' );
		
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