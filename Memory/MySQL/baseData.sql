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
	 *	@date 2013-04-14 16:01:31 :: 2013-04-14 16:37:11
	 *
	 *	@address Poland/Krakow/Bydryka/5/414
	 *
	 *	@description ::
	 *		Service for kafedra DEAM of PNU Ukraine
	 *																	*
	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*/

/*	Code	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	***	*/
/* #- Set Datebase for using -# */
USE `deam`;


/* -# Roles #- */
INSERT INTO `role`(
	`id`, 
	`title`, 
	`description`
)
VALUES
(	1,	'admin',		'Supper user. All permits.'	), 
(	2,	'professor',	'Control yourself data'		);


/* -# Types of book #- */
INSERT INTO `book_type`(
	`id`, 
	`title`, 
	`description`
)
VALUES
(	1,	'book',		'Authors book.'	), 
(	2,	'article',	'Publication article'		);
/* TODO: Add other */


/* -# Types of work #- */
INSERT INTO `work_type`(
	`id`, 
	`title`, 
	`description`
)
VALUES
(	1,	'magister',		'5 course.'		), 
(	2,	'bakalavr',		'4 cource'		), 
(	3,	'course',		'<=4 course'	);
