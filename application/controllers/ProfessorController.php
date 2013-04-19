<?php

class ProfessorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
	/* ------ profile professors --------*/
	public function displayshortprofileAction() /*short information about profile  professors*/
	{
		
		$this->view->array_name=$array; /*here mast be information name professor and his status*/
	}
		
	public function displayprofileAction() /*information about profile  professors*/
	{
		
		$this->view->name='П.І.Б.';
		
		$this->view->general_information='general_information';
		
		$this->view->picture='picture';
		
		$this->view->scientific_activity='scientific activity';
		
		$this->view->teaching_works='teaching works';
		
		$this->view->contacts = 'контакти';
		
		$tmp = new DEAM_User_User(	);
		$tmp->setIdRole(1);
		$tmp->setActive(0);
		$tmp->setBirthday('1990-12-12');
		$tmp->setFirstName('my_first_name');
		$tmp->setSecondName('my_second_name');
		$tmp->setFatherName('my_father_name');
		$tmp->setPost('same text to post');
	//		echo $tmp->create();
		/*
		echo '<pre>';
			var_dump($tmp->readAll());
		echo '</pre></br>';
		
		$tmp->setId(2);
		echo '<pre>';
			var_dump($tmp->delete());
		echo '</pre></br>';
		*/
		
	}
	
	public function editprofileAction()
	{
			//$request = $this->getRequest()->getParams();
			
		if(/*if have pararms*/ true){
				//$request->isPost()
			/*$this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));*/
			
		}
			/*display form*/
			$this->view->name='П.І.Б.';
		
			$this->view->general_information='general_information';
		
			$this->view->picture='picture';
		
			$this->view->scientific_activity='scientific activity';
		
			$this->view->teaching_works='teaching works';
		
			$this->view->contacts = 'контакти';
		
		
		
	
	}
	public function deleteprofileAction()
	{
		$params=$this->getRequest()->getParams();
	
	}
	public function addprofileAction()
	{
		$params=$this->getRequest()->getParams();
		
		/*$this->redirect()->toRoute('album', array(
                'action' => 'add' */
	}
//------------------------------	library		-------------------------------------------

//*****************************************************************************************

	public function getlistbookAction()
	{
		/*інформатика і програмування , комплексний аналіз.......*/
		/*нестосуэться конференцій*/
		/*сортувати - за перыодом навчання,тематикою, типом книг*/
		// 	--------- findbookAction ---------
	}
	
	public function editlistAction()
	{
		$params=$this->getRequest()->getParams();
		/*$this->redirect()->toRoute('album', array(
                'action' => 'add' */
	}
//*****************************************************************************************
	public function displaypagememorylistAction()
	{
	
	
	}

	public function displaypagememorydetailAction()
	{
		/* додати місце поховання*/
		/* посилання */
	
	}
	public function editpagememorydetailAction()
	{
		/* додати місце поховання*/
		/* посилання */
	
	}
	public function deletepagememorydetailAction()
	{
		/* додати місце поховання*/
		/* посилання */
	
	}
	
	public function addpagememorydetailAction()
	{
		/* додати місце поховання*/
		/* посилання */
	
	}
	//-------------------------------------------------------------------------------
	public function displaycontactsAction()/*контактна інформація*/
	{
		
	}
	
	public function editcontactsAction()/*контактна інформація*/
	{
		
	}
	public function deletecontactsAction()/*контактна інформація*/
	{
		
	}
	public function addcontactsAction()/*контактна інформація*/
	{
		
	}
	//-------------------------------------------------------------------------------
	public function displaytopicsinfoAction()/*теми курсових та дипломних робіт*/
	{
		
	}
	public function edittopicsinfoAction()/*теми курсових та дипломних робіт*/
	{
		
	}
	public function deletetopicsinfoAction()/*теми курсових та дипломних робіт*/
	{
		
	}
	public function addtopicsinfoAction()/*теми курсових та дипломних робіт*/
	{
		
	}
	//-------------------------------------------------------------------------------
	public function displayscheduleAction()/*Розклад занять викладачів кафедри*/
	{
	
	}
	public function editscheduleAction()/*Розклад занять викладачів кафедри*/
	{
	
	}
	public function deletecheduleAction()/*Розклад занять викладачів кафедри*/
	{
	
	}
	public function addcheduleAction()/*Розклад занять викладачів кафедри*/
	{
	
	}

	//-------------------------------------------------------------------------------
	public function Action()
	{
	
	}
}

