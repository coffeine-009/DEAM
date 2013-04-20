///	***	Registration	***	***	***	***	***	***	***	***	***	***	***	***	***	///

	/**	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*
	 *																*
	 *	@copyright 2013
	 *		by
	 *	@author Vitaliy Tsutsman
	 *
	 *	@date 2013-04-19 15:53:39 :: ....-..-.. ..:..:..
	 *
	 *	@address Poland/Krakow/Budryka/5/414
	 *
	 *	@description
	 *		Validation registration form
	 *																*
	*///***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*

///	***	Code	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	///
var Registration = function()// : construct
{
	///	***	Properties	***	///
	
}
///	***	Methods	***	///
Registration.prototype.testUsername = function( 
	/*string*/	sUsername, 
	/*fuction*/	cbfResponse 
)// : void
{
	cbfResponse();
};


///	***********************************************************************	///
window.onload = function()
{
	var element = {
		username 		: document.getElementById( 'username' ), 
		usernameValid 	: document.getElementById( 'username-element' ), 
	};
	
	//--//
	var user = new Registration();
	
	//--//
	element.username.onkeyup = function()
	{
		var interv = setInterval(
			function(){
				user.testUsername(
					'ok', 
					function(){
						if( true )
						{
							element.usernameValid.removeChild( 'span' );
						}
						
						var warn = document.createElement( 'span' );
							
							warn.innerHTML = (element.username.value == 'f' ) ? 'OK' : 'Er';
						element.usernameValid.appendChild( warn );
					}
				);
				
				clearInterval( interv );
			}, 
			1500
		);		
	}
}