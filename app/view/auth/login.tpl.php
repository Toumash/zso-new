<?php
/**
 * @var $this \yapf\View
 */
$this->viewBag['title'] = 'login | ZSO nr 1';
$this->layout('_layout');
?>
<form method="post" action="">
    <?php $this->antiForgeryToken(); ?>
    <div class="form-horizontal">
        <h2>Zaloguj się</h2>
        <?php $this->validationSummary('', ['class' => 'text-danger']); ?>
        <div class="form-group">
            <?php $this->labelFor('login', 'Email:', ['class' => 'control-label col-md-3']); ?>
            <div class="col-md-9">
                <?php
                $this->editorFor('login', '', ['class' => 'form-control']);
                $this->validationMessageFor('login', 'Podano niepoprawny login i/lub hasło', ['class' => 'text-danger']);
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php
            $this->labelFor('password', 'Hasło:', ['class' => 'control-label col-md-3']);
            ?>
            <div class="col-md-9">
                <?php
                $this->editorFor('password', '', ['type' => 'password', 'class' => 'form-control']);
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Save" class="btn btn-default"/>
            </div>
        </div>
    </div>
</form>