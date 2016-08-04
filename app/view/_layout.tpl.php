<?php
use app\dal\PostRepository;
use app\helper\Html;
use yapf\Config;
use yapf\TempData;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="<?php echo wwwroot; ?>images/main.png?" type="image/x-icon"/>
    <title><?php echo isset($this->viewBag['title']) ? $this->viewBag['title'] : 'Zso nr 1'; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <link href="<?php echo wwwroot; ?>css/main.css" rel="stylesheet">
    <link href="<?php echo wwwroot; ?>css/expand.css" rel="stylesheet">
    <script src="<?php echo wwwroot; ?>js/ee.js"></script>
    <script src="<?php echo wwwroot; ?>js/utils.js"></script>
    <?php $this->renderSection('styles'); ?>
</head>
<body>
<div id="body-container">
    <?php
    $postModel = new PostRepository();
    $headerPosts = $postModel->getHeaderPosts();
    $headerMenu = $headerPosts->fetch();
    $headerGim = $headerPosts->fetch();
    $headerLic = $headerPosts->fetch();
    /**
     * @var $auth \app\UserAuth
     */
    $auth = $this->user;
    ?>
    <div
        style="background-color: rgb(52, 103, 148); position:fixed; top:0px; left:0px; width:100%; height:157px; z-index:50;"></div>
    <?php
    if (!is_null($msg = TempData::get('error-message'))): //TODO extend?>
        <div class="alert alert-info">
            <?php echo $msg; ?>\
        </div>
        <?php
    endif; ?>
    <div id="masthead">
        <!--<div id="grad_BOK"></div>-->
        <div id="ZSO" class="gradient naglowek">ZESPÓŁ SZKÓŁ OGÓLNONOKSZTAŁCĄCYCH NR 1 W GDAŃSKU</div>
        <img src="<?php echo wwwroot; ?>images/godlo2.png" style="float:left; margin-bottom:15px;" height="110px"/>
        <div class="szkola">
            <img src="<?php echo wwwroot; ?>images/Gimnazjum_nr1_v2.min.png" class="logo"/>
            <div style="text-align: center; display:table-cell; vertical-align:middle; position: relative;"
                 class="naglowek_pom czcionka_szara">
                <?php echo Html::bbcode_decode($headerGim['Content']); ?>
                <div style="position: absolute; top: 0; right: 0;">';
                    <?php Html::dropEdit($auth, LAYOUT_PAGE, 26, false, false, true, true, 0, 0); ?>
                </div>
            </div>
        </div>
        <div class="szkola">
            <img src="<?php echo wwwroot; ?>images/IXLO_transparent.min.png" class="logo"/>
            <div style="text-align: center;  display:table-cell; vertical-align:middle; position: relative;"
                 class="naglowek_pom czcionka_szara">
                <?php echo Html::bbcode_decode($headerLic['Content']); ?>
                <div style="position: absolute; top: 0; right: 0;">
                    <?php Html::dropEdit($auth, LAYOUT_PAGE, 27, false, false, true, true, 0, 0); ?>
                </div>
            </div>
        </div>
        <div id="linki" class="gradient naglowek_pom" style="position: relative;">
            <ol class="main_menu_link_list">
                <?php Html::bbcode_decode($headerMenu['Content']); ?>
            </ol>
            <div style="position: absolute; top: 0; right: 0;">';
                <?php Html::dropEdit($auth, LAYOUT_PAGE, 25, false, false, false, true, 0, 0); ?>
            </div>
        </div>
    </div>
    <div style="height:167px;"></div><!--positioner-->
    <!-- header end -->
    <?php
    $this->renderBody();
    ?>


    <?php ///////////////////////////////////////////////////////////////////////////////////
    //////////////// FOOTER //////////////////////////////////////////////  
    $posts = $postModel->getLayoutFooterPosts();

    $footer = $posts->fetch();
    ?>
    <div class="gradient" style="height:8px; clear: left;"></div>
    <div style="height:20px;"></div><!--positioner-->
    <div style="float:left; margin-right:10px;">
        <img src="<? echo (Config::getInstance())->getBasePath(); ?>images/IXLO_transparent.min.png"
             style="height:50px; margin-top: 10px; float:left;"/>
        <img src="<? echo (Config::getInstance())->getBasePath(); ?>images/Gimnazjum_nr1_v2.min.png"
             style="height:50px; margin: 10px 0 10px 0; float:left; clear:left;"/>
    </div>
    <div id="info" class="czcionka_szara" style="font-size:14px;">
        <div>
            <?php
            Html::bbcode_decode($footer['Content']);
            $footer = $posts->fetch();
            echo '<div style="float:left; margin-left: 5px; position: relative;">';
            Html::dropEdit($auth, LAYOUT_PAGE, 22, false, false, false, true, 0, 0);
            ?>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div style=" margin-right:10px; float:left;">
        <?php Html::bbcode_decode($footer['Content']) ?>
    </div>
    <div style="float:left;margin-left: 5px position: relative;">
        <?php
        Html::dropEdit($auth, LAYOUT_PAGE, 23, false, false, false, true, 0, 0);
        $footer = $posts->fetch();
        ?>
    </div>
    <div style="float:left;">
        <?php Html::bbcode_decode($footer['Content']); ?>
    </div>
    <div style="float:left;margin-left: 5px">';
        <?php
        Html::dropEdit($auth, LAYOUT_PAGE, 24, false, false, false, true, 0, 0);
        ?>
    </div>
    <!--
    PROBLEM Z TAKIEM </div> USUNIETO -->

    <div id="logowanie" class="czcionka_szara">
        <?php

        // FIXME separated page for error logins
        if (!$this->user->isLoggedIn()) {
            if ($login) {
                $url = "";
                if ($_SERVER['HTTP_HOST'] != "localhost")
                    $url .= 'http://';
                $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                echo '<form action="' . wwwroot . '/' . 'php/login.php?Next=' . $url . '" method="post">
                        Email:<br />
			            <input  name="Email"/><br />
			            Hasło:<br />
                        <input type="password" name="Pass"/><br /><br />
			            <input type="submit" value="Zaloguj"><br />
                    </form>';
                if (isset($_SESSION['LoginErr'])) {
                    echo '<div id="email_err" class="error">' . $_SESSION['LoginErr'] . '</div>';
                    unset($_SESSION['LoginErr']);
                }
            }
            echo '<a href="' . wwwroot . 'register.php">Załóż konto</a>';
        } else {
            # show user panel
            echo '<form action="' . wwwroot . 'php/logout.php" method="post">
                    <br /><input type="submit" value="Wyloguj się"><br />
                </form>
                <form action="' . wwwroot . 'accountManagment.php">
                    <br /><input type="submit" value="Zarządzaj kontem"><br />
                </form>';
            if ($this->user->checkRights(SET_RIGHTS_RIGHT | VERIFY_TEACHER_RIGHT | CHANGE_USER_DATA_RIGHT) != 0) {
                echo '<form action="' . wwwroot . 'adminPanel.php">
                        <br /><input type="submit" value="Panel administracyjny"><br />
                    </form>';
            }
        }
        ?>
    </div>
    <div style="clear:both; height:20px;"></div><!--positioner-->
    <div class="gradient" style=" height:20px;"></div>
    <!--przerwa na koniec-->
    <div style="padding: 5px 0px; background-color: rgb(36, 90, 140);">
        <div class="czcionka_nieb" style="margin: auto; width: 700px; text-align: center;">
            Strona utworzona we współpracy Uczniów, Nauczycieli i Rady Rodziców - 2016
        </div>
    </div>

    <div style="height:150px; clear:both;"></div>
    <?php
    if (!isset($_COOKIE['cookieAgree'])) {
        ?>
        <div style="position:fixed; bottom:0;right:0; width:100%; opacity: 0.8;" class="gradient" id="cookieMessage">
            <!--ciasteczka-->
            <div onclick="closeCookieMessage(cookieMessage);"
                 style="float:right; color: blue; text-decoration: underline; cursor:pointer">
                Zamknij
            </div>
            <img src="<?php Config::getInstance()->getBasePath(); ?>images/Cookies.png"
                 style="float:left; height:50px;"/>
            <!--potrzebny lepszy obrazek-->
            Ta strona używa ciastek!
        </div>
        <?php
    }
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>
<?php
$this->renderSection('scripts', false);
?>
</body>
</html>