/* Kafedra Differencial equation and Applied Mathematic :: Struct	***	*** */

	/**	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*
	 *																	*
	 *	@copyright 2013
	 *		by
	 *	@author Vitaliy Tsutsman
	 *		and
	 *	@author Andrii Plyasun
	 *		and
	 *	@author Andrii Khristonko
	 *
	 *	@date 2013-04-12 16:55:54 :: ....-..-.. ..:..:..
	 *
	 *	@address Poland/Krakow/Bydryka/5/414
	 *
	 *	@description ::
	 *		Service for kafedra DEAM of PNU Ukraine
	 *																	*
	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*/

/*	Code	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*/
/* #- Create database -# */
CREATE DATABASE `deam`
	DEFAULT
		CHARACTER SET utf8 
		COLLATE utf8_general_ci;

/* #- Set Datebase for using -# */
USE `deam`;

/* Create tables	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*/
/* -#  #- */
CREATE TABLE ``(
	`id`		INTEGER AUTO_INCREMENT
)
ENGINE = InnoDB CHARACTER SET = utf8;
