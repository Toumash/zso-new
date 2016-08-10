<?php

namespace app\model;


class User
{
    private $admin = false;
    private $type;

    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $verified;
    private $rights;
    private $class;
    private $school;
    private $endYear;

    public static function from($data)
    {
        if (empty($data)) {
            return null;
        }
        $user = (new User())
            ->setId($data['UserId'])
            ->setName($data['Name'])
            ->setSurname($data['Surname'])
            ->setEmail($data['Email'])
            ->setPhone($data['Phone'])
            ->setVerified($data['Verified'])
            ->setRights($data['Rights'])
            ->setType($data['Type'])
            ->setClass($data['Class'])
            ->setAdmin($data['IsAdmin'])
            ->setSchool(isset($data['School']) ? $data['School'] : 0)
            ->setEndYear(isset($data['EndYear']) ? $data['EndYear'] : 9999);
        return $user;
    }

    private function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param mixed $verified
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @param mixed $rights
     * @return User
     */
    public function setRights($rights)
    {
        $this->rights = $rights;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     * @return User
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param mixed $school
     * @return User
     */
    public function setSchool($school)
    {
        $this->school = $school;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndYear()
    {
        return $this->endYear;
    }

    /**
     * @param mixed $endYear
     * @return User
     */
    public function setEndYear($endYear)
    {
        $this->endYear = $endYear;
        return $this;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}