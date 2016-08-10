<?php
use app\helper\Html;

$this->layout('_layout');
$this->viewBag['title'] = 'Strona Główna | ZSO nr 1';
$postModel = new \app\dal\PostRepository();
$posts = $postModel->getHomePosts();
/**
 * @var $auth \app\UserAuth
 */
$auth = $this->userManager;
?>

<div id="students_photo">
    <?php $module = $posts->fetch(); ?>
    <img src="<?php echo $module['Filename']; ?>" width="100%" height="400px"/>
    <div style="position: absolute; top: 0; right: 0;">
        <?php Html::dropEdit($auth, LAYOUT_PAGE, 1, false, true, false, false, 1000, 400); ?>
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
    $module = $posts->fetch();
    echo $module['Name'];
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
        <?php $module = $posts->fetch(); ?>
        <img src="<?php echo $module['Filename']; ?>" style="width:100%;height:150px;"/>
        <div class="gradient naglowek_pom" style="text-align:center;">
            <b><?php echo $module['Name']; ?></b>
        </div>
        <div style="height:5px;"></div>
        <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
            <?php
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($auth, LAYOUT_PAGE, 3, false, true, true, true, 200, 150);
            echo '</div>';
            echo Html::bbcode_decode($module['Content']);
            ?>
        </div>
    </div>

    <div class="o_nas">
        <?php $module = $posts->fetch(); ?>
        <img src="<?php echo $module['Filename']; ?>" width="100%" height="150px"/>
        <div class="gradient naglowek_pom" style="text-align:center;">
            <b><?php echo $module['Name']; ?></b>
        </div>
        <div style="height:5px;"></div>
        <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
            <?php
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($auth, LAYOUT_PAGE, 4, false, true, true, true, 200, 150);
            echo '</div>';
            echo Html::bbcode_decode($module['Content']);
            ?>
        </div>
    </div>

    <div class="o_nas">
        <?php $module = $posts->fetch(); ?>
        <img src="<?php echo $module['Filename']; ?>" width="100%" height="150px"/>
        <div class="gradient naglowek_pom" style="text-align:center;">
            <b><?php echo $module['Name']; ?></b>
        </div>
        <div style="height:5px;"></div>
        <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
            <?php
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($auth, LAYOUT_PAGE, 5, false, true, true, true, 200, 150);
            echo '</div>';
            echo Html::bbcode_decode($module['Content']);
            ?>
        </div>
    </div>
    <div class="o_nas">
        <?php $module = $posts->fetch(); ?>
        <img src="<?php echo $module['Filename']; ?>" width="100%" height="150px"/>
        <div class="gradient naglowek_pom" style="text-align:center;">
            <b><?php echo $module['Name']; ?></b>
        </div>
        <div style="height:5px;"></div>
        <div class="bright_background justify" style="height:220px; position: relative; padding: 0 5px;">
            <?php
            echo '<div style="position: absolute; top: 0; right: 0;">';
            Html::dropEdit($auth, LAYOUT_PAGE, 6, false, true, true, true, 200, 150);
            echo '</div>';
            echo Html::bbcode_decode($module['Content']);
            ?>
        </div>
    </div>
</div>

<div style="margin-top:20px; clear:both; padding: 0 25px;"><!--zawartość o nas 2-->
    <div class="absolwent">
        <div class="gradient naglowek_pom" style="height:20px; text-align:center;">
            <?php $module = $posts->fetch(); ?>
            <b><?php echo $module['Name']; ?></b>
        </div>
        <div class="bright_background justify" style="height:160px; position: relative; padding: 0 5px;">
            <div
                style="position: absolute; top: 0; right: 0;">
                <?php Html::dropEdit($auth, LAYOUT_PAGE, 7, false, false); ?>
            </div>
            <?php echo Html::bbcode_decode($module['Content']); ?>
        </div>
    </div>
    <div style="width:320px; height:180px; float:left; position: relative;">
        <?php
        $module = $posts->fetch();
        ?>
        <div style="position: absolute; top: 0; right: 0;">
            <?php Html::dropEdit($auth, LAYOUT_PAGE, 8, false, true, false, false, 320, 180); ?>
        </div>
        <img src="<?php echo $module['Filename']; ?>" width="100%" height="100%"/>
    </div>
    <div class="absolwent">
        <div class="gradient naglowek_pom" style="height:20px; text-align:center;">
            <?php
            $module = $posts->fetch();
            ?>
            <b><?php echo $module['Name']; ?></b>
        </div>
        <div class="bright_background justify" style="height:160px; position: relative; padding: 0 5px;">
            <div style="position: absolute; top: 0; right: 0;">
                <?php Html::dropEdit($auth, LAYOUT_PAGE, 9, false, false); ?> </div>
            <?php
            echo Html::bbcode_decode($module['Content']);
            ?>
        </div>
    </div>
</div>
<?php
if (!$auth->checkRights(LAYOUT_PAGE))
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
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 10, false, false, true, true, 200, 150);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 11, false, false, true, true, 200, 150);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 12, false, false, true, true, 200, 150);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 13, false, false, true, true, 200, 150);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 14, false, false, true, true, 200, 150);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 15, false, false, true, true, 200, 150);
        echo '</div>';
        ?>
    </div>
</div>

<div class="czcionka_szara" style="float:left; margin-left: 4px;">
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 16, false, false, true, true);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 17, false, false, true, true);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 18, false, false, true, true);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 19, false, false, true, true);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 20, false, false, true, true);
        echo '</div>';
        ?>
    </div>
    <div style="float:left; width:166px; position: relative;">
        <div style="height:5px;"></div><!--positioner-->
        <?php
        $module = $posts->fetch();
        echo $module['Name'];
        echo Html::bbcode_decode($module['Content']);
        echo '<div style="position: absolute; top: 0; right: 0;">';
        Html::dropEdit($auth, LAYOUT_PAGE, 21, false, false, true, true);
        echo '</div>';
        ?>
    </div>
</div>
<div style="height:20px; clear:left;"></div><!--positioner-->
<?php $this->startSection(); ?>
<script>
    // here you can deploy your own scripts which will go to the scripts section on the page
</script>
<?php $this->endSection('scripts'); ?>
