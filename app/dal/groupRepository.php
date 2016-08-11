<?php
namespace app\dal;


use app\model\Group;
use PDO;
use yapf\model;

class GroupRepository extends model
{
    private $db;

    public function __construct()
    {
        $this->db = $this->getDatabaseConnection('default');
    }

    public function getCurrentGroups()
    {
        $endyear = intval(date("Y"));
        if (date('m') < 7) {
            --$endyear;
        }
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE EndYear > :endyear");
        $stmt->bindParam(':endyear', $endyear, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $groups = [];
        foreach ($data as $dataGroup) {
            $groups[] = Group::from($dataGroup);
        }
        return $groups;
    }
}