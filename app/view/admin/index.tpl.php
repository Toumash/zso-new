<?php
$this->viewBag['title'] = 'Panel Admina | ZSO Nr. 1';
$this->layout('_layout');
?>
<div style="background-color:rgb(36,90,140); padding: 5px 0;">
    <div style="text-align:center; margin:auto; width:700px;" class="czcionka_szara">
        <h2>Główny panel administracyjny</h2>
        <?php //TODO: w przypadku uprawnien daj uzytkowanikow posty itd ?>
        <a href="<?php echo wwwroot;?>admin/user" class="btn btn-default">Użytkownicy</a>
        <a href="<?php echo wwwroot;?>admin/post" class="btn btn-default">Posty</a>
        <a href="<?php echo wwwroot;?>admin/addPost?Content=true&Section=<?php echo UNDEFINED_PAGE; ?>&Title=true" class="btn btn-success">Dodaj
            Posta</a>
    </div>
</div>