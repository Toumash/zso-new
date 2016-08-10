<?php
/**
 * Created by PhpStorm.
 * User: mrtou
 * Date: 04.08.2016
 * Time: 12:31
 */

namespace app;

//Należy zadbać, aby stała miała odpowiednie bity 'zapalone', a odpowiednie 'zgaszone'
    //to znaczy, jeżeli ktoś doda stałe o wartości A = 1, B = 2 i C = 3, to musi uwzględnić,
    //że w operacjach bitowych stała C będzie reprezentowała obie stałe A i B.
    //Wynika to z bitowej reprezentacji liczb.
    //Jeżeli liczba nie będzie wykorzystana jako flaga bitowa, to uwaga ta jej nie dotyczy.

//Stałe nie powinny przekroczyć wartości 2147483647 lub 0x7FFFFFFF aby uniknąc kłopotów z reprezentacją liczb.

use app\model\User;
use PDO;
use yapf\model;

define("GIM", intval(0x00000001));    //Gimnazjum
define("LIC", intval(0x00000002));    //Liceum

define("GENDER_NULL", 1);        //Płeć nieznana
define("GENDER_MAN", 2);        //Płeć męska
define("GENDER_WOMAN", 3);        //Płeć żeńska

define("STUDENT", intval(0x00000001));    //Uczeń
define("PARENT", intval(0x00000002));    //Rodzic
define("TEACHER", intval(0x00000004));    //Nauczyciel

define("BASIC_RIGHT", intval(0x00000000));        //Podstawowe uprawnienia
define("ADMIN_RIGHT", intval(0x7FFFFFFF));        //Wszystkie uprawnienia
define("TEACHER_RIGHT", intval(0x00000001));        //Uprawnienie edycji własnej strony nauczyciela
define("LIBRARIAN_RIGHT", intval(0x00000002));        //Uprawnienie edycji strony biblioteki
define("COUNSEL_RIGHT", intval(0x00000004));        //Uprawnienie edycji strony rady rodziców
define("POST_ADD_RIGHT", intval(0x00000008));        //Uprawnienie dodawania postów na stronie
define("CLASS_PAGE_MODIFY_RIGHT", intval(0x00000010));        //Uprawnienie edycji strony klasowej
define("PSYCHOLOGIST_RIGHT", intval(0x00000020));        //Uprawnienie edycji strony psychologa
define("PEDAGOGIST_RIGHT", intval(0x00000040));        //Uprawnienie edycji strony pedagoga
define("SET_RIGHTS_RIGHT", intval(0x00000080));        //Uprawnienie do nadawania uprawnień
define("VERIFY_TEACHER_RIGHT", intval(0x00000100));        //Uprawnienie do autoryzacji nauczycieli
define("CHANGE_USER_DATA_RIGHT", intval(0x00000200));        //Uprawnienie do modyfikacji danych użytkowników
define("CHANGE_LAYOUT_RIGHT", intval(0x00000400));        //Uprawnienie do zmiany wyglądu strony
define("CHANGE_CLASS_DATA_RIGHT", intval(0x00000800));        //Uprawnienie do modyfikacji klas

define("EMAIL_VERIFIED", intval(0x00000001));        //Email został zweryfikowany
define("TEACHER_VERIFIED", intval(0x00000002));        //Nauczyciel został zweryfikowany

//Dodając typ strony należy też dodać ją, do funkcji checkPostRights() w pliku utils.php
define("UNDEFINED_PAGE", 1);    //Strona niezdefiniowana
define("GIM_LIBRARY_PAGE", 2);    //Strona biblioteki gimanzjum
define("LIC_LIBRARY_PAGE", 3);    //Strona biblioteki liceum
define("GIM_PSYCHOLOGIST_PAGE", 4);    //Strona psychologa gimanzjum
define("LIC_PSYCHOLOGIST_PAGE", 5);    //Strona psychologa liceum
define("GIM_PEDAGOGIST_PAGE", 6);    //Strona pedagoga gimanzjum
define("LIC_PEDAGOGIST_PAGE", 7);    //Strona pedagoga liceum
define("TEACHER_PAGE", 8);    //Strona nauczyciela
define("CLASS_PAGE", 9);    //Strona klasy
define("GIM_PAGE", 10);   //Strona główna gimnazjum
define("LIC_PAGE", 11);   //Strona główna liceum
define("LAYOUT_PAGE", 12);   //Elementy takie, jak stopka, 'na skróty' itp.
define("AFTER_LESSONS_GIM_PAGE", 13);   //Strona "po lekcjach" gimnazjum
define("AFTER_LESSONS_LIC_PAGE", 14);   //Strona "po lekcjach" liceum
define("COMPETITIONS_GIM_PAGE", 15);   //Strona "konkursy" gimanzjum
define("COMPETITIONS_LIC_PAGE", 16);   //Strona "konkursy" liceum
define("PROJECTS_GIM_PAGE", 17);   //Strona "projekty" gimanzjum
define("PROJECTS_LIC_PAGE", 18);   //Strona "projekty" liceum
define("OPINION_GIM_PAGE", 19);   //Strona "naszym zdaniem" gimanzjum
define("OPINION_LIC_PAGE", 20);   //Strona "naszym zdaniem" liceum
define("SUCCESSES_GIM_PAGE", 21);   //Strona "sukcesy" gimnazjum
define("SUCCESSES_LIC_PAGE", 22);   //Strona "sukcesy" liceum
define("PARTNERS_GIM_PAGE", 23);   //Strona "partnerzy" gimanzjum
define("PARTNERS_LIC_PAGE", 24);   //Strona "partnerzy" liceum
define("CLASSES_GIM_PAGE", 25);   //Strona "klasy" gimnazjum
define("CLASSES_LIC_PAGE", 26);   //Strona "klasy" liceum
define("TEACHERS_GIM_PAGE", 27);   //Strona "nauczyciele" gimnazjum
define("TEACHERS_LIC_PAGE", 28);   //Strona "nauczyciele" liceum
define("CALENDAR_EVENT_GIM_PAGE", 29);   //Strona wydarzenia z kalendarza liceum
define("CALENDAR_EVENT_LIC_PAGE", 30);   //Strona wydarzenia z kalendarza gimnazjum

define("ACTION_FAILED", false);    //Akcja nie udana
define("ACTION_SUCCES", true);     //Akcja udana

define("ADMIN", true);    //Administrator
define("USER", false);        //Zwykły urzytkownik


class UserAuth extends model
{
    /**
     * @var User
     */
    private $user = null;

    private $db;

    public function __construct($connection = null)
    {
        if (isset($connection)) {
            $this->db = $this->getDatabaseConnection($connection);
        } else {
            $this->db = $this->getDatabaseConnection();
        }
        if (isset($_SESSION['_user'])) {
            $this->user = $_SESSION['_user'];
        }
    }

    /**
     * @param $login
     * @param $password
     * @return bool true on proper sing-in
     */
    public function singIn($login, $password)
    {
        $q = $this->db->prepare("SELECT * FROM users LEFT OUTER JOIN classes ON users.Class=classes.ClassId WHERE Email=:login");
        $q->bindParam(':login', $login, PDO::PARAM_STR);
        $q->execute();

        $query_data = $q->fetch(PDO::FETCH_ASSOC);
        if (count($query_data) > 0 && password_verify($password, $query_data['Password']) == true) {
            $this->user = User::from($query_data);
            $_SESSION['_user'] = $this->user;
            return true;
        }
        return false;
    }

    public function getSessionUser()
    {
        return $this->user;
    }

    public function checkPostRights($Page)
    {
        if (!$this->isLoggedIn())
            return false;

        $user = $this->user;

        if ($user->isAdmin())
            return true;

        // FIXME: magic ints
        if (!$this->isLoggedIn() || (($user->getType() & STUDENT) != 0) && ((date("Y") > $user->getEndYear() || (date("Y") == $this->user->getEndYear() && date("m") >= 7)))) {
            return false;
        }

        switch ($Page) {
            case GIM_LIBRARY_PAGE:
                return $this->checkRights(LIBRARIAN_RIGHT) &&
                ($user->getSchool() & GIM);
            case LIC_LIBRARY_PAGE:
                return $this->checkRights(LIBRARIAN_RIGHT) &&
                ($user->getSchool() & LIC);
            case GIM_PSYCHOLOGIST_PAGE:
                return $this->checkRights(PSYCHOLOGIST_RIGHT) &&
                ($user->getSchool & GIM);
            case LIC_PSYCHOLOGIST_PAGE:
                return $this->checkRights(PSYCHOLOGIST_RIGHT) &&
                ($user->getSchool() & LIC);
            case GIM_PEDAGOGIST_PAGE:
                return $this->checkRights(PEDAGOGIST_RIGHT) &&
                ($user->getSchool() & GIM);
            case LIC_PEDAGOGIST_PAGE:
                return $this->checkRights(PEDAGOGIST_RIGHT) &&
                ($user->getSchool() & LIC);
            case TEACHER_PAGE:
                return $this->checkRights(TEACHER_RIGHT);
            case CLASS_PAGE:
                return $this->checkRights(CLASS_PAGE_MODIFY_RIGHT);
            case GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case LAYOUT_PAGE:
                return $this->checkRights(CHANGE_LAYOUT_RIGHT);
            case AFTER_LESSONS_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case AFTER_LESSONS_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case COMPETITIONS_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case COMPETITIONS_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case PROJECTS_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case PROJECTS_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case OPINION_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case OPINION_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case SUCCESSES_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case SUCCESSES_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case PARTNERS_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case PARTNERS_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case CLASSES_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case CLASSES_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            case TEACHERS_GIM_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & GIM);
            case TEACHERS_LIC_PAGE:
                return $this->checkRights(POST_ADD_RIGHT) &&
                ($user->getSchool() & LIC);
            default:
                return false;
        }
    }

    public function isLoggedIn()
    {
        return isset($this->user);
    }


    //Sprawdza, czy zalogowany użytkownik posiada podane uprawnienia
    //Wywołanie $this->checkRights(0) sprawdza, czy użytkownik jest administratorem.
    public function checkRights($Rights)
    {
        if (!$this->isLoggedIn())
            return false;

        return $this->user->isAdmin() || ($this->user->getRights() & $Rights);
    }
}