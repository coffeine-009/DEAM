<?php

/**
 * 
 * Enter description here ...
 * @author vitaliy
 *	@data 2013-06-13 21:02:21 :: 
 */

class Application_Form_Forgot
	extends
		Zend_Form
{
	///	***	Methods		***	///
	public function init()
	{
		//- Init -//
		$this -> setAction( '/forgot' )
			-> setMethod( 'post' );
			
		//- Content :: Main -//
		//- Login -//		
		$login = new Zend_Form_Element_Text( 'email' );
			$login -> setLabel( 'E-mail' ) 
				-> setOptions( 
					array(
						'size' 		=> '30', 
						'maxlength'	=> '80'
					)
				)
				-> setAttrib( 'type', 'email' )
				-> setRequired( true )
				-> addValidator( new Zend_Validate_NotEmpty() )
				-> addValidator( new Zend_Validate_EmailAddress() );

				
		$submit = new Zend_Form_Element_Submit( 'submit' );
			$submit -> setLabel( 'Enter' );
			
		//- Add elements to form -//
		$this -> addElement( $login )
			-> addElement( $submit );
			
		//- Create group for display -//
		$this -> addDisplayGroup(
			array( 
				'email', 		
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