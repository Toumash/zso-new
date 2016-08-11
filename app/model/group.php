<?php

namespace app\model;


class Group
{
    /** @var int */
    private $id;
    /** @var string */
    private $letter;
    /** @var int */
    private $endYear;
    /** @var  int */
    private $pageId;
    /**  @var string */
    private $profile;
    /** @var int */
    private $school;

    public static function from($data)
    {
        if (empty($data)) {
            return null;
        }
        $group = (new Group())
            ->setId($data['ClassId'])
            ->setLetter($data['Letter'])
            ->setEndYear($data['EndYear'])
            ->setPageId($data['ClassPageId'])
            ->setProfile($data['Profile'])
            ->setSchool($data['SchoolOfClass']);
        return $group;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Group
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     * @return Group
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
        return $this;
    }

    public function getName()
    {
        $groupNumber = intval($this->getEndYear()) - intval(date("Y"));
        $school = $this->getSchool() == GIM ? 'Gimnazjum' :
            $this->getSchool() == LIC ? 'Liceum' : '';
        $letter = $this->getLetter();
        $profile = $this->getProfile();

        $groupName = "$groupNumber $letter $profile $school";
        return $groupName;
    }

    /**
     * @return int
     */
    public function getEndYear()
    {
        return $this->endYear;
    }

    /**
     * @param int $endYear
     * @return Group
     */
    public function setEndYear($endYear)
    {
        $this->endYear = $endYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param int $school
     * @return Group
     */
    public function setSchool($school)
    {
        $this->school = $school;
        return $this;
    }

    /**
     * @return string
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * @param string $letter
     * @return Group
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;
        return $this;
    }

    /**
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param string $profile
     * @return Group
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
        return $this;
    }

    private function getGroupNumber($year)
    {
        if (date("m" < 7)) {
            $year = $year + 1;
        }
        $year = ($year - 4) * (-1);
        return $year;
    }
}