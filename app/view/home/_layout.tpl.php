<?php
use app\dal\PostRepository;
use app\helper\Html;
use yapf\Config;

define('wwwroot', Config::getInstance()->getBasePath());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="<?php echo wwwroot;?>images/main.png?" type="image/x-icon"/>
    <title><?php echo isset($this->viewBag['title']) ? $this->viewBag['title'] : 'Zso nr 1'; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <link href="<?php echo wwwroot;?>css/main.css" rel="stylesheet">
    <link href="<?php echo wwwroot;?>css/expand.css" rel="stylesheet">
    <script src="<?php echo wwwroot;?>js/ee.js"></script>
    <script src="<?php echo wwwroot;?>js/utils.js"></script>
    <?php $this->renderSection('styles'); ?>
</head>
<body>
<div id="body-container">
    <?php
    $postModel = new PostRepository();
    $query_result = $postModel->getLayoutPosts();
    $menu = $query_result->fetch();
    $layoutGim = $query_result->fetch();
    $layoutLic = $query_result->fetch();
    ?>
    <div
        style="background-color: rgb(52, 103, 148); position:fixed; top:0px; left:0px; width:100%; height:157px; z-index:50;"></div>
    <div id="masthead">
        <!--<div id="grad_BOK"></div>-->
        <div id="ZSO" class="gradient naglowek">ZESPÓŁ SZKÓŁ OGÓLNONOKSZTAŁCĄCYCH NR 1 W GDAŃSKU</div>
        <img src="<?php echo wwwroot;?>images/godlo2.png" style="float:left; margin-bottom:15px;" height="110px"/>
        <div class="szkola">
            <img src="<?php echo wwwroot;?>images/Gimnazjum_nr1_v2.min.png" class="logo"/>
            <div style="text-align: center; display:table-cell; vertical-align:middle; position: relative;"
                 class="naglowek_pom czcionka_szara">
                <?php echo Html::bbcode_decode($layoutGim['Content']); ?>
                <div style="position: absolute; top: 0; right: 0;">';
                    <?php Html::dropEdit($user, LAYOUT_PAGE, 26, false, false, true, true, 0, 0, $pathToRoot); ?>
                </div>
            </div>
        </div>
        <div class="szkola">
            <img src="<?php echo wwwroot;?>images/IXLO_transparent.min.png" class="logo"/>
            <div style="text-align: center;  display:table-cell; vertical-align:middle; position: relative;"
                 class="naglowek_pom czcionka_szara">
                <?php echo Html::bbcode_decode($layoutLic['Content']); ?>
                <div style="position: absolute; top: 0; right: 0;">
                    <?php Html::dropEdit($user, LAYOUT_PAGE, 27, false, false, true, true, 0, 0, $pathToRoot); ?>
                </div>
            </div>
        </div>
        <div id="linki" class="gradient naglowek_pom" style="position: relative;">
            <ol class="main_menu_link_list">
                <?php Html::bbcode_decode($menu['Content']); ?>
            </ol>
            <div style="position: absolute; top: 0; right: 0;">';
                <?php Html::dropEdit($user, LAYOUT_PAGE, 25, false, false, false, true, 0, 0, $pathToRoot); ?>
            </div>
        </div>
    </div>
    <div style="height:167px;"></div><!--positioner-->';
    <div id="students_photo">
        <?php $layout = $query_result->fetch(); ?>
        <img src="<?php echo $layout['Filename']; ?>" width="100%" height="400px"/>
        <div style="position: absolute; top: 0; right: 0;">
            <?php Html::dropEdit($user, LAYOUT_PAGE, 1, false, true, false, false, 1000, 400); ?>
        </div>

        <!--<div style="position:absolute; left:940px; top:80px;">
            <img src="images/IXLO_transparent.png" style="width:120px;" />
            <img src="images/Gimnazjum_nr1_v2.png" style="width:120px;" />
        </div>-->
    </div>

    <div style="height:20px;"></div><!--positioner-->

    <div id="tp_o_nas" style="position:relative; bottom:175px;"></div>
    <div id="o_nas" class="gradient naglowek" style="text-align: center;">
        <?php
        $layout = $query_result->fetch();
        echo $layout['Name'];
        ?>
    </div>
    <br/>
    <!--<div style="background-color:rgb(36,90,140); padding: 5px 0; position: relative;">
            <div style="position: absolute; top: 0; right: 0;"> <?php // Html::dropEdit($user,LAYOUT_PAGE, 2, false, false, false);?> </div>
			<div style="text-align:center; margin:auto; width:700px; position: relative" class="czcionka_szara">
                <?php
    //echo Html::bbcode_decode($layout['Content']);
    ?>
			</div>
		</div>-->


    <div style="height:404px;"><!--zawartość o nas 1-->
        <div class="o_nas">
            <?php $layout = $query_result->fetch(); ?>
            <img src="<?php echo $layout['Filename']; ?>" style="width:100%;height:150px;"/>
            <div class="gradient naglowek_pom" style="text-align:center;">
                <b><?php echo $layout['Name']; ?></b>
            </div>
            <div style="height:5px;"></div>
            <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
                <?php
                echo '<div style="position: absolute; top: 0; right: 0;">';
                Html::dropEdit($user, LAYOUT_PAGE, 3, false, true, true, true, 200, 150);
                echo '</div>';
                echo Html::bbcode_decode($layout['Content']);
                ?>
            </div>
        </div>

        <div class="o_nas">
            <?php $layout = $query_result->fetch(); ?>
            <img src="<?php echo $layout['Filename']; ?>" width="100%" height="150px"/>
            <div class="gradient naglowek_pom" style="text-align:center;">
                <b><?php echo $layout['Name']; ?></b>
            </div>
            <div style="height:5px;"></div>
            <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
                <?php
                echo '<div style="position: absolute; top: 0; right: 0;">';
                Html::dropEdit($user, LAYOUT_PAGE, 4, false, true, true, true, 200, 150);
                echo '</div>';
                echo Html::bbcode_decode($layout['Content']);
                ?>
            </div>
        </div>

        <div class="o_nas">
            <?php $layout = $query_result->fetch(); ?>
            <img src="<?php echo $layout['Filename']; ?>" width="100%" height="150px"/>
            <div class="gradient naglowek_pom" style="text-align:center;">
                <b><?php echo $layout['Name']; ?></b>
            </div>
            <div style="height:5px;"></div>
            <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
                <?php
                echo '<div style="position: absolute; top: 0; right: 0;">';
                Html::dropEdit($user, LAYOUT_PAGE, 5, false, true, true, true, 200, 150);
                echo '</div>';
                echo Html::bbcode_decode($layout['Content']);
                ?>
            </div>
        </div>
        <div class="o_nas">
            <?php $layout = $query_result->fetch(); ?>
            <img src="<?php echo $layout['Filename']; ?>" width="100%" height="150px"/>
            <div class="gradient naglowek_pom" style="text-align:center;">
                <b><?php echo $layout['Name']; ?></b>
            </div>
            <div style="height:5px;"></div>
            <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
                <?php
                echo '<div style="position: absolute; top: 0; right: 0;">';
                Html::dropEdit($user, LAYOUT_PAGE, 6, false, true, true, true, 200, 150);
                echo '</div>';
                echo Html::bbcode_decode($layout['Content']);
                ?>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; clear:both; padding: 0 25px;"><!--zawartość o nas 2-->
        <div class="absolwent">
            <div class="gradient naglowek_pom" style="height:20px; text-align:center;">
                <?php $layout = $query_result->fetch(); ?>
                <b><?php echo $layout['Name']; ?></b>
            </div>
            <div class="bright_background justify" style="height:160px; position: relative; padding: 0 5px;">
                <div
                    style="position: absolute; top: 0; right: 0;">
                    <?php Html::dropEdit($user, LAYOUT_PAGE, 7, false, false); ?>
                </div>
                <?php echo Html::bbcode_decode($layout['Content']); ?>
            </div>
        </div>
        <div style="width:320px; height:180px; float:left; position: relative;">
            <?php
            $layout = $query_result->fetch();
            ?>
            <div style="position: absolute; top: 0; right: 0;">
                <?php Html::dropEdit($user, LAYOUT_PAGE, 8, false, true, false, false, 320, 180); ?>
            </div>
            <img src="<?php echo $layout['Filename']; ?>" width="100%" height="100%"/>
        </div>
        <div class="absolwent">
            <div class="gradient naglowek_pom" style="height:20px; text-align:center;">
                <?php
                $layout = $query_result->fetch();
                ?>
                <b><?php echo $layout['Name']; ?></b>
            </div>
            <div class="bright_background justify" style="height:160px; position: relative; padding: 0 5px;">
                <div style="position: absolute; top: 0; right: 0;">
                    <?php Html::dropEdit($user, LAYOUT_PAGE, 9, false, false); ?> </div>
                <?php
                echo Html::bbcode_decode($layout['Content']);
                ?>
            </div>
        </div>
    </div>
    <?php
    if (!checkPostRights(LAYOUT_PAGE))
        echo "<div style='height:200px;'></div>";
    else
        echo "<div style='height:224px;'></div>";
    ?>

    <div id="tp_na_skroty"></div>
    <div id="na_skroty" class="gradient naglowek" style=" clear:left; text-align: center;">
        NA SKRÓTY
    </div>
    <div style="height:20px;"></div><!--positioner-->
    <div class="czcionka_szara" style="float:left; margin-left: 4px;"><!--zawartość na skróty-->
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 10, false, false, true, true, 200, 150);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 11, false, false, true, true, 200, 150);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 12, false, false, true, true, 200, 150);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 13, false, false, true, true, 200, 150);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 14, false, false, true, true, 200, 150);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 15, false, false, true, true, 200, 150);
            echo '</div>';
            ?>
        </div>
    </div>

    <div class="czcionka_szara" style="float:left; margin-left: 4px;">
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 16, false, false, true, true);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 17, false, false, true, true);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 18, false, false, true, true);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 19, false, false, true, true);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 20, false, false, true, true);
            echo '</div>';
            ?>
        </div>
        <div style="float:left; width:166px; position: relative;">
            <div style="height:5px;"></div><!--positioner-->
            <?php
            $layout = $query_result->fetch();
            echo $layout['Name'];
            echo Html::bbcode_decode($layout['Content']);
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($user, LAYOUT_PAGE, 21, false, false, true, true);
            echo '</div>';
            ?>
        </div>
    </div>
    <div style="height:20px; clear:left;"></div><!--positioner-->

    <?php ///////////////////////////////////////////////////////////////////////////////////
    //////////////// FOOTER //////////////////////////////////////////////  
    $query_result = $postModel->getLayoutFooterPosts();

    $query_data = $query_result->fetch();
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
            Html::bbcode_decode($query_data['Content']);
            $query_data = $query_result->fetch();
            echo '<div style="float:left; margin-left: 5px; position: relative;">';
            Html::dropEdit($user, LAYOUT_PAGE, 22, false, false, false, true, 0, 0, $pathToRoot);
            ?>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div style=" margin-right:10px; float:left;">
        <?php Html::bbcode_decode($query_data['Content']) ?>
    </div>
    <div style="float:left;margin-left: 5px position: relative;">
        <?php
        Html::dropEdit($user, LAYOUT_PAGE, 23, false, false, false, true, 0, 0, $pathToRoot);
        $query_data = $query_result->fetch();
        ?>
    </div>
    <div style="float:left;">
        <?php Html::bbcode_decode($query_data['Content']); ?>
    </div>
    <div style="float:left;margin-left: 5px">';
        <?php
        Html::dropEdit($user, LAYOUT_PAGE, 24, false, false, false, true, 0, 0, $pathToRoot);
        ?>
    </div>
</div>

<div id="logowanie" class="czcionka_szara">
    <?php

    // FIXME separated page for error logins
    if (!$this->user->isLoggedIn()) {
        if ($login) {
            $url = "";
            if ($_SERVER['HTTP_HOST'] != "localhost")
                $url .= 'http://';
            $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            echo '<form action="' . $pathToRoot . '/' . 'php/login.php?Next=' . $url . '" method="post">
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
        echo '<a href="register.php">Załóż konto</a>';
    } else {
        # show user panel
        echo '<form action="' . $pathToRoot . '/php/logout.php" method="post">
                    <br /><input type="submit" value="Wyloguj się"><br />
                </form>
                <form action="' . $pathToRoot . '/accountManagment.php">
                    <br /><input type="submit" value="Zarządzaj kontem"><br />
                </form>';
        if ($this->user->checkRights(SET_RIGHTS_RIGHT | VERIFY_TEACHER_RIGHT | CHANGE_USER_DATA_RIGHT) != 0) {
            echo '<form action="' . $pathToRoot . '/adminPanel.php">
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
        <img src="<?php Config::getInstance()->getBasePath(); ?>images/Cookies.png" style="float:left; height:50px;"/>
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