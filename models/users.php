<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php");

//class for user management
class user
{
    private $table = 'users';

    public $id;
    public $CollegeID;
    public $Name;
    public $sur_name;
    public $image;
    public $phone;
    public $email;
    public $pass;
    public $role;
    public $dept;
    public $isadmin;
    public $gender;


    //constructor
    public function __construct()
    {
    }

    public function validate_params($value)
    {
        return (!empty($value));
    }

    //saving new data in our database
    public function register_user()
    {
        global $database;
        $this->CollegeID = trim(htmlspecialchars(strip_tags($this->CollegeID)));
        $this->Name = trim(htmlspecialchars(strip_tags($this->Name)));
        $this->sur_name = trim(htmlspecialchars(strip_tags($this->sur_name)));
        $this->image = trim(htmlspecialchars(strip_tags($this->image)));
        $this->phone = trim(htmlspecialchars(strip_tags($this->phone)));
        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $this->pass = trim(htmlspecialchars(strip_tags($this->pass)));
        $this->role = trim(htmlspecialchars(strip_tags($this->role)));
        $this->dept = trim(htmlspecialchars(strip_tags($this->dept)));
        $this->isadmin = trim(htmlspecialchars(strip_tags($this->isadmin)));
        $this->gender = trim(htmlspecialchars(strip_tags($this->gender)));

        $sql = "INSERT INTO $this->table (CollegeID,Name,sur_name,image,phone,email,pass,role,dept,isadmin,gender) VALUES (
            '" . $database->escape_value($this->CollegeID) . "',
            '" . $database->escape_value($this->Name) . "',
            '" . $database->escape_value($this->sur_name) . "',
            '" . $database->escape_value($this->image) . "',
            '" . $database->escape_value($this->phone) . "',
            '" . $database->escape_value($this->email) . "',
            '" . $database->escape_value($this->pass) . "',
            '" . $database->escape_value($this->role) . "',
            '" . $database->escape_value($this->dept) . "',
            '" . $database->escape_value($this->isadmin) . "',
            '" . $database->escape_value($this->gender) . "'
        )";

        $user_saved = $database->query($sql);

        if ($user_saved) {
            return $database->last_insert_id();
        } else {
            return false;
        }
    }
}

$user = new user();
?>