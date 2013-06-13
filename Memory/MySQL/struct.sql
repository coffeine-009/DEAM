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
	 *	@date 2013-04-12 16:55:54 :: 2013-04-14 16:30:47
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

	`password`		VARCHAR( 128 ) NOT NULL, 

	/* Names */
	`first_name`	VARCHAR( 20 ) NOT NULL, /* First name of user 	*/
	`second_name`	VARCHAR( 20 ) NOT NULL, /* Second name of user 	*/
	`father_name`	VARCHAR( 32 ) NOT NULL, /* Father name of user 	*/
	/* Personal data */
	`birthday`		DATE NOT NULL, 			/* Date of birthday 	*/
	`post`			TEXT, 					/* Post of organization */

	`active`		BOOLEAN DEFAULT false, 	/* Flag of active or not user 	*/

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
	`id`			INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`		INTEGER NOT NULL, 		/* Id of user 		*/
	/* Data */
	`contact`		VARCHAR( 80 ) NOT NULL, 		/* email address 		*/
	`confirmed`		BOOLEAN NOT NULL DEFAULT false, /* Confirm email 		*/
	
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /* Time of create 	*/

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# User contact: phone #- */
CREATE TABLE `phone`(
	`id`			INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`		INTEGER NOT NULL, 		/* Id of user 		*/
	/* Data */
	`contact`		VARCHAR( 13 ) NOT NULL, 		/* phone number	*/
	`confirmed`		BOOLEAN NOT NULL DEFAULT false, /* Confirmed 	*/
	
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /* Time of create 	*/

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# User contact: web-site #- */
CREATE TABLE `website`(
	`id`			INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`		INTEGER NOT NULL, 		/* Id of user 		*/
	/* Data */
	`contact`		VARCHAR( 13 ) NOT NULL, 		/* Url to personal site	*/
	`confirmed`		BOOLEAN NOT NULL DEFAULT false, /* Confirmed 			*/
	
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /* Time of create 	*/

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;



/* #- Metherials	---	---	---	---	---	---	---	---	---	---	---	---	--- -# */
/* -# Type of book #- */
CREATE TABLE `book_type`(
	`id`			INTEGER AUTO_INCREMENT, /* Identificator 				*/
	`title`			VARCHAR( 32 ) NOT NULL, /* Title of type book			*/
	`description`	TEXT, 				/* Description about current role	*/

	/* Keys */
	PRIMARY KEY( `id` )
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Books #- */
CREATE TABLE `book`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`			INTEGER NOT NULL, 		/* Id of user 		*/

	`title`				VARCHAR( 64 ) NOT NULL, /* Title of book			*/
	`description`		TEXT, 			/* Description about current book	*/
	/* Data */
	`authors`			VARCHAR( 256 ),	/* Authors of book 					*/
	`edition`			VARCHAR( 256 ), /* Title of edition this work 		*/
	`publication`		DATE NOT NULL, 	/* Time of publication 				*/
	`page_count`		INTEGER NOT NULL, /* Count pages of book 			*/
	`sared`				BOOLEAN NOT NULL DEFAULT false, /* Shared work 		*/

	`creation`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Publications #- */
CREATE TABLE `publication`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`			INTEGER NOT NULL, 		/* Id of user 		*/
	`title`				VARCHAR( 64 ) NOT NULL, /* Title of book			*/
	`text`				TEXT, 					/* Text of publication		*/
	/* Data */
--	`authors`			TEXT, 			/* Authors of book 					*/
--	`edition`			VARCHAR( 256 ), /* Title of edition this work 		*/
	`yeay_publication`	DATE NOT NULL, 	/* Time of publication 				*/
--	`page_count`		INTEGER NOT NULL, /* Count pages of book 			*/
--	`sared`				BOOLEAN NOT NULL DEFAULT false, /* Shared work 		*/
	`creation`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Rank of professor[doc, prof] #- */
CREATE TABLE `rank`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator	*/
	`rank`			TEXT, 

	/* Keys */
	PRIMARY KEY( `id` )
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Scientific_activity #- */
CREATE TABLE `scientific_activity`(
	`id`				INTEGER AUTO_INCREMENT, -- /* Identificator 	*/
	`id_user`			INTEGER NOT NULL, 		--/* Id of user 		*/
    `rank`              INTEGER NOT NULL,
	`title`				VARCHAR( 64 ) NOT NULL, --/*  			*/
    `candidate`         TEXT,       --       /* professors .......   , */
	`description`		TEXT, 		--	/* Description full information about user	*/
--	/* Data */
--	`authors`			TEXT, 			/* Authors of book 					*/
--	`edition`			VARCHAR( 256 ), /* Title of edition this work 		*/
--	`yeay_publication`	DATE NOT NULL, 	/* Time of publication 				*/
--	`page_count`		INTEGER NOT NULL, /* Count pages of book 			*/
--	`sared`				BOOLEAN NOT NULL DEFAULT false, /* Shared work 		*/

	`creation`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
--	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
        
   	FOREIGN KEY( `rank` ) REFERENCES `rank`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

CREATE TABLE `rank`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator	*/
	`rank`			TEXT, 

	/* Keys */
	PRIMARY KEY( `id` )
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Reseach seminar #- */
CREATE TABLE `reseach_seminar`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`			INTEGER NOT NULL, 		/* Id of user 		*/

	`title`				VARCHAR( 64 ) NOT NULL, /* Title of book			*/
	`link`				TEXT, 			/* Description about current book	*/
	`organizator`		TEXT, 			/* Organizator of seminar 			*/

	`coords`			TEXT, 				/* Place of realize */
	`time_from`			TIMESTAMP NULL, 	/* Time the begin 	*/
	`time_to`			TIMESTAMP NULL, 	/* Time the end 	*/

	`creation`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;


/* #- Practice for student older	---	---	---	---	---	---	---	---	---	-# */
/* -# Practice #- */
CREATE TABLE `practice`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator 	*/
	`id_user`			INTEGER NOT NULL, 		/* Id of user 		*/

	`title`				VARCHAR( 64 ) NOT NULL, /* Title of practice		*/
	`description`		TEXT, 			/* Description about current praxis	*/

	`base`				VARCHAR( 256 ),	/* Organisation Who pessage			*/
	`course`			INTEGER, 	/* Course of student 	*/
	`count_student`		INTEGER, 	/* Count of student 	*/
	/* Dates */
	`pessage_from`		DATE, 		/* Begin of pessage 		*/
	`pessage_to`		DATE, 		/* The end ofPessage 		*/

	`creation`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;


/* #- Works	---	---	---	---	---	---	---	---	---	---	---	---	---	---	--- -# */
/* -# Type of work #- */
CREATE TABLE `work_type`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator 			*/

	`title`				VARCHAR( 64 ) NOT NULL, /* Title of work			*/
	`description`		TEXT, 			/* Description about current work	*/
 
	/* Keys */
	PRIMARY KEY( `id` )
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Work (Warn: Student or professor must be from this cafedra) #- */
CREATE TABLE `work`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator 			*/
	`id_user`			INTEGER NOT NULL, /* Id of user(Who add to system)	*/

	`id_work_type`		INTEGER NOT NULL, /* Id type of work[magister, course]*/

	`title`				VARCHAR( 64 ) NOT NULL, /* Title of practice		*/
	`description`		TEXT, 			/* Description about current praxis	*/
	/* Main mannager for student to this theme	*/
	`suppervisor`		TEXT, 	/* Can be professor from other cafedras 	*/

	`student`			VARCHAR( 256 ), /* Names of student 		*/
	`link`				VARCHAR( 512 ), /* Link to file from work 	*/

	`creation`			TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT, 

	FOREIGN KEY( `id_work_type` ) REFERENCES `work_type`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;


/* #- Olimpiads, Concurses	---	---	---	---	---	---	---	---	---	---	--- -# */
/* -# Concurses #- */
CREATE TABLE `concurces`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator	*/
	`id_user`			INTEGER NOT NULL, 		/* Id of user 		*/

	`title`				VARCHAR( 64 ) NOT NULL, /* Title of concurces		*/
	`description`		TEXT, 		/* Description about current concurces	*/
	
	`creation`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;


CREATE TABLE `consultation`(
	`id`				INTEGER AUTO_INCREMENT, /* Identificator	*/
	`id_user`			INTEGER NOT NULL, 		/* Id of user 		*/

	`date_from`			TIMESTAMP NULL, /* Title of concurces*/
	`date_to`			TIMESTAMP NULL, /* Description about current concurces	*/
	
	`creation`			TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)
ENGINE = InnoDB CHARACTER SET = utf8;

/*#- Administration -#  */
/* -# Queue for activations #- */
CREATE TABLE `account_activation`(
	`id`			INTEGER AUTO_INCREMENT, 
	`id_user`		INTEGER NOT NULL, 
	`secure_hach`	VARCHAR( 256 ), 
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE CASCADE
)
ENGINE = InnoDB CHARACTER SET = utf8;

/* -# Queue for forgot #- */
CREATE TABLE `account_forgot`(
	`id`			INTEGER AUTO_INCREMENT, 
	`id_user`		INTEGER NOT NULL, 
	`secure_hash`	VARCHAR( 256 ), 
	`creation`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

	/* Keys */
	PRIMARY KEY( `id` ), 

	FOREIGN KEY( `id_user` ) REFERENCES `user`( `id` )
		ON UPDATE CASCADE
		ON DELETE CASCADE
)
ENGINE = InnoDB CHARACTER SET = utf8;
