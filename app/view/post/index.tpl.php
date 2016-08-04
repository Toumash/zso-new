<?php
/** @var \app\model\Post $post */
use app\helper\Html;

$post = $this->viewBag['post'];
$this->viewBag['title'] = $post->getName() . ' | ZSO Nr. 1';
$this->layout('_layout');
?>
<div class="gradient naglowek" style="text-align: center;">
    <?php echo $post->getName();?>
</div>
<div style="background-color:white; padding: 5px 10px;">
    <div style="width:700px; position: relative;" class="">
        <?php echo $post->getContent();?>
        <div style="position: absolute; right: 0; top: 0;">
            <?php
            Html::dropEdit($post['Section'], $post['PostId'], false, true, true, true, 162, 104, ".")
            ?>
        </div>
    </div>
</div>