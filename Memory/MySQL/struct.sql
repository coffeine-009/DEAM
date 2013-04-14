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
/* -# Role of users #- */
CREATE TABLE `role`(
	`id`			INTEGER AUTO_INCREMENT, /* Identificator 				*/
	`title`			VARCHAR( 32 ) NOT NULL, /* Title of role[admin, teacher]*/
	`description`	TEXT, 				/* Description about current role	*/

	/* Keys */
	PRIMARY KEY( `id` )
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Data about users #- */
CREATE TABLE `user`(
	`id`			INTEGER AUTO_INCREMENT, /* Identificator */
	`id_role`		INTEGER NOT NULL, 		/* Id of role */
	/* Names */
	`first_name`	VARCHAR( 20 ) NOT NULL, /* First name of user 	*/
	`second_name`	VARCHAR( 20 ) NOT NULL, /* Second name of user 	*/
	`father_name`	VARCHAR( 32 ) NOT NULL, /* Father name of user 	*/
	/* Personal data */
	`birthday`		DATE NOT NULL, 			/* Date of birthday 	*/
	`post`			TEXT, 					/* Post of organization */
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /* Time of create */

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_role` ) REFERENCES `role`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# User contact: E-mail #- */
CREATE TABLE `email`(
	`id`			INTEGER AUTO_INCREMENT, /* Identificator */
	`id_user`		INTEGER NOT NULL, 		/* Id of role */
	/* Names */
	`first_name`	VARCHAR( 20 ) NOT NULL, /* First name of user 	*/
	`second_name`	VARCHAR( 20 ) NOT NULL, /* Second name of user 	*/
	`father_name`	VARCHAR( 32 ) NOT NULL, /* Father name of user 	*/
	/* Personal data */
	`birthday`		DATE NOT NULL, 			/* Date of birthday 	*/
	`post`			TEXT, 					/* Post of organization */
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /* Time of create */

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_role` ) REFERENCES `role`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;
