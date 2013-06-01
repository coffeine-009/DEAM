<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DEAM_User', 'doctrine');

/**
 * DEAM_BaseUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_role
 * @property string $password
 * @property string $first_name
 * @property string $second_name
 * @property string $father_name
 * @property date $birthday
 * @property string $post
 * @property integer $active
 * @property timestamp $creation
 * @property DEAM_Role $Role
 * @property Doctrine_Collection $Book
 * @property Doctrine_Collection $Concurces
 * @property Doctrine_Collection $Consultation
 * @property Doctrine_Collection $Email
 * @property Doctrine_Collection $Phone
 * @property Doctrine_Collection $Practice
 * @property Doctrine_Collection $Publication
 * @property Doctrine_Collection $ReseachSeminar
 * @property Doctrine_Collection $ScientificActivity
 * @property Doctrine_Collection $Website
 * @property Doctrine_Collection $Work
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class DEAM_BaseUser extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('id_role', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('password', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('first_name', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('second_name', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('father_name', 'string', 32, array(
             'type' => 'string',
             'length' => 32,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('birthday', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('post', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('active', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('creation', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DEAM_Role as Role', array(
             'local' => 'id_role',
             'foreign' => 'id'));

        $this->hasMany('DEAM_Book as Book', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Concurces as Concurces', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Consultation as Consultation', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Email as Email', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Phone as Phone', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Practice as Practice', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Publication as Publication', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_ReseachSeminar as ReseachSeminar', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_ScientificActivity as ScientificActivity', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Website as Website', array(
             'local' => 'id',
             'foreign' => 'id_user'));

        $this->hasMany('DEAM_Work as Work', array(
             'local' => 'id',
             'foreign' => 'id_user'));
    }
}