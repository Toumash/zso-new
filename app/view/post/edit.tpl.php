<?php
/** @var \app\model\Post $post */

$post = $this->viewBag['post'];
$this->viewBag['title'] = $post->getName() . ' | ZSO Nr. 1';
$this->layout('_layout');
$height = $this->viewBag['picture-height'];
$width = $this->viewBag['picture-width'];
?>

<?php $this->startSection(); ?>
<link rel="stylesheet" href="<?php echo wwwroot; ?>editor/theme/default/wbbtheme.css"/>
<?php $this->endSection('styles'); ?>
<div style="background-color:rgb(36,90,140); padding: 5px 0;">
    <div style="text-align:center; margin:auto; width:700px;" class="czcionka_szara">
        <form action="?returnUrl=<?php echo $this->viewBag['returnUrl']; ?>" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="Id" value=<?php echo '"' . $Id . '"' ?>><br/><br/>
            <?php
            //Obrazek
            if ($this->viewBag['edit-picture']):
                ?>
                Obrazek:
                <input id="imageInput" type="file" name="Picture" onchange="previewFile()"><br/><br/>
                <img id="preview" src="<?php echo $post->getPictureFile(); ?>" alt="Nie można wyświetlić obrazka."
                    <?php if ($width != 0 && $height != 0) {
                        echo ' height="', $height, '" width="', $width, '"';
                    } ?>
                ><br/>
                <?php
            endif;

            if ($width != 0 && $height != 0):?>
                <input name="width" type="hidden" value="<?php echo $width; ?>">';
                <input name="height" type="hidden" value="<?php echo $height; ?>">
                <?php
            endif;

            //Tytuł
            if ($this->viewBag['edit-title']):?>
                <label>Tytuł:
                    <input type="text" name="title" size="58" value="<?php echo $post->getName(); ?>">
                </label><br/>
                <?php
            else: ?>
                <input type="hidden" name="title" size="58" value="<?php echo $post->getName(); ?>">
                <?php
            endif;


            //Treść
            ?>
            <div class="lightBackground">
                <label for="editor">Treść:</label>
                <textarea id="editor" rows="15" cols="60" name="Content">
                    <?php echo str_replace("[br /]", "\n", $post->getContent()); ?>
                </textarea><br/>
            </div>
            <?php
            //Tagi
            if ($this->viewBag['edit-tags']):
                ?>
                <label>Tagi:
                    <input name="Tags" size="58"
                           type="text" value="<?php echo $post->getTags(); ?>">
                </label>
                <?php
            else:
                ?>
                <input name="Tags" size="58" type="hidden" value="<?php echo $post->getTags(); ?>">
                <?php
            endif;


            ?>
            <br/>
            <input type="button" value="Anuluj" onclick="cancel()">
            <input type="submit" value="Aktualizuj"><br/><br/>
        </form>
    </div>
</div>

<?php $this->startSection(); ?>
<!-- Load WysiBB JS and Theme -->
<script src="<?php echo wwwroot; ?>editor/jquery.wysibb.min.js"></script>
<script src="<?php echo wwwroot; ?>editor/lang/pl.js"></script>
<script>
    //Źródło funkcji: https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL
    function previewFile() {
        var preview = document.getElementById('preview');
        var file = document.getElementById('imageInput').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
        else {
            preview.src = "";
        }
    }
    $(document).ready(function () {
        var wbbOpt =
        {
            <?php
            if ($post->getSection() != LAYOUT_PAGE)
                $buttons = "bold,italic,underline,strike,|,sup,sub,|,img,link,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,|,quote,table,removeFormat,|,header";
            else
                $buttons = "bold,italic,underline,strike,|,sup,sub,|,link,|,bullist,numlist,|,removeFormat";
            $id = $post->getId();
            if ($id == 25 || $id == 58 || $id == 61)
                $buttons = "bold,italic,underline,strike,|,sup,sub,|,link,|,bullist,numlist,|,removeFormat,|,dropdown";
            ?>
            buttons: <?php echo '"' . $buttons . '"' ?>,
            lang: "pl",
            allButtons: {
                dropdown: {
                    title: 'Upuszczane menu',
                    buttonText: 'menu',
                    transform: {
                        '<div class="in_editor_dropdown">{SELTEXT}</div>': '[dropdown]{SELTEXT}[/dropdown]'
                    }
                },
                header: {
                    title: 'Wstaw zwijanie tekstu',
                    buttonText: 'break',
                    transform: {
                        '<hr>': '[roll]'
                    }
                }
            }
        };
        $("#editor").wysibb(wbbOpt);
    });
    function cancel() {
        window.location.replace( <?php echo '"' . $this->viewBag['returnUrl'] . '"' ?> );
    }
</script>
<?php $this->endSection('scripts'); ?>
