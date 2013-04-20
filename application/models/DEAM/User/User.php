<?php
class DEAM_User_User 	
{
	protected $id;
	protected $id_role;
	protected $first_name;
	protected $second_name;
	protected $father_name;
	protected $birstday;
	protected $post;
	protected $active;
	protected $creation;
	
	
	protected $db_link;
	
	const SQL_INSERT = 'insert into `user`(`id_role`,`first_name`,`second_name`,`father_name`,`birthday`,`post`,`active`) values(%d,\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',%d)';
	/*
	 * insert into `user`(`id_role`,`first_name`,`second_name`,`father_name`,`birthday`,`post`,`active`) values(1,'first_my_name','secont_my_name','fasther_my_name','1990-12-30','??mm',0);
	 * */
	const SQL_DELETE = 'delete from user where `id` = %d';
	
	const SQL_SELECT = 'select `id`,`id_role`,`first_name`,`second_name`,`father_name`,`birthday`,`post`,`active` from user';
	
	const SQL_UPDATE = 'update `user` set `first_name` = \'%s\',`second_name` = \'%s\',`father_name` = \'%s\',`birthday`=\'%s\',`post`=\'%s\',`active`=%d';
	
	const SQL_SELECT_LIST ='select * from user';
	
	public function __construct(
			$Id			= null,
			$Id_role	= null,
			$First_name = null,
			$Second_name= null,
			$Father_name= null,
			$Birstday	= null,
			$Post		= null,
			$Active		= null,
			$Creation	= null
	)
	{
		
		$this->id			= $Id;
		$this->id_role		= $Id_role;
		$this->first_name 	= $First_name; 
		$this->second_name	= $Second_name;
		$this->father_name  = $Father_name;
		$this->birstday		= $Birstday;
		$this->post			= $Post;
		$this->active		= $Active;		
		$this->creation		= $Creation;
		
		$this -> db_link = Zend_Registry :: get( 'db' );
		
	}
	
	public function __destruct()
	{
		unset($db_link);
	}
	
	//- SECTION :: GET -//
	
	public function getId(){
		
		return $this->id;
	}
	
	public function getIdRole(){
		
		return $this->id_role;
	}
	public function getFirstName(){
		
		return $this->first_name;
	}
	
	public function getSecondName(){
	
		return $this->second_name;
	}
	
	public function getFatherName(){

		return $this->father_name;
		
	}
	
	public function getBirthday(){

		return $this->birstday;

	}
	
	public function getPost(){

		return $this->post;

	}
	
	public function getActive(){
	
		return $this->active;
	}
	
	public function getCreation(){

		return  $this->creation;	
	}
	
	
	////-------------------------------------------
	//- SECTION :: SET -//	
	

	public function setId($Id){
	
		$this->id = $Id;
		return $this;
	}
	
	public function setIdRole($Id_role){
	
		$this->id_role=$Id_role;
		return $this;
	}
	public function setFirstName($First_name){
	
		$this->first_name=$First_name;
		return $this;
	}
	
	public function setSecondName($Second_name){
	
		$this->second_name=$Second_name;
		return $this;
	}
	
	public function setFatherName($Father_name){
	
		$this->father_name=$Father_name;
		return $this;
	}
	
	public function setBirthday($Birthday){
	
		$this->birstday=$Birthday;
		return $this;
	
	}
	
	public function setPost($Post){
	
		$this->post=$Post;
		return $this; 
	
	}
	
	public function setActive($Active){
	
		$this->active=$Active;
		return $this;
	}
	
	public function setCreation($Creation){
	
		$this->creation=$Creation;
		return  $this;
	}
	
	public function create(){
			echo 	sprintf(
						self :: SQL_INSERT,
						$this->id_role,
						$this->first_name,
						$this->second_name,
						$this->father_name,
						$this->birstday,
						$this->post,
						$this->active
					);
		try
		{
			$this -> db_link -> query(
					sprintf(
						self :: SQL_INSERT,
						//- Params -//
						$this->id_role,
						$this->first_name,
						$this->second_name,
						$this->father_name,
						$this->birstday,
						$this->post,
						$this->active
					)
			);
		}
		
		catch( Exception $Exc )
		{
			//- Can not save this data in DB -//
			return false;
		}
		
		//- Object was saved -//
		return true;
		
	}
	
	public function delete(){

		if( $this -> id === null ){ return false; }
		try
		{
			$this -> db_link -> query(
					sprintf(
							self :: SQL_DELETE,
							$this -> id
					)
			);
		}
		
		catch( Exception $Ecx )
		{
			//- Can not delete this object from DB -//
			return false;
		}
		
		//- Object was deleted -//
		return true;
	}
	
	public function read(){

		try
		{
			$response = $this -> db_link -> query(
					sprintf(
							self :: SQL_SELECT,
							$this -> id
					)
			) -> fetch( PDO :: FETCH_OBJ );
				
			/*			//- Initialize object -//
			 $this -> id 		= (int)	$response -> id;
			$this -> title 		= 		$response -> title;
			$this -> description = 		$response -> description;
			*/
			//- Object was read -//
			return $response;
		}
		
		catch( Exception $Ecx )
		{
			//- Can not read this object from DB -//
			return false;
		}
	}
	public function readAll(){
		
		try
		{
			$response = $this -> db_link -> query(
					sprintf(
							self :: SQL_SELECT_LIST
					)
			) -> fetchAll( PDO :: FETCH_OBJ );
		
			//- Object was read -//
			return $response;
		}
		
		catch( Exception $Ecx )
		{
			//- Can not read this object from DB -//
			return false;
		}
	}
	public function update(){
		try
		{
			$response = $this -> db_link -> query(
					sprintf(
							self :: SQL_UPDATE,
							$this -> id_abode_type,
							$this -> id_address,
							$this -> id
					)
			);
				
			//- Object was updated -//
			return true;
		}
		
		catch( Exception $Ecx )
		{
			//- Can not update this object in DB -//
			return false;
		}
	}
}