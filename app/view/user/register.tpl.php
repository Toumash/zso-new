<?php
/**
 * @var $this \yapf\View
 */

$this->viewBag['title'] = 'Rejestracja | ZSO nr 1';
$this->layout('_layout');

/** @var \app\model\Group $groups */
$groups = $this->viewBag['groups'];
?>

    <div class="gradient naglowek" style="text-align: center;">Rejestracja</div>
    <div style="background-color:rgb(36,90,140); padding: 5px 0;">
        <div style="text-align:center; margin:auto; width:700px;" class="czcionka_szara">
            <form method="post" action="" onsubmit="return validate()">
                <?php $this->antiForgeryToken(); ?>
                <div class="form-horizontal">
                    <label for="email">Email:</label><br>
                    <?php $this->editorFor('email', '', ['id' => 'email']); ?><br>
                    <?php $this->validationMessageFor('email', '', ['class' => 'text-danger']); ?><br>

                    <label for="password">Hasło:*</label><br>
                    <input type="password" name="password" id="password"/><br>
                    <?php $this->validationMessageFor('password', '', ['class' => 'text-danger']); ?><br>

                    <label for="re-password">Powtórz hasło:*</label><br>
                    <input type="password" name="re-password" id="re-password"/><br>
                    <?php $this->validationMessageFor('password', '', ['class' => 'text-danger']); ?><br>


                    <label for="name">Imię:*</label><br>
                    <input type="text" name="name" id="name"/><br>
                    <?php $this->validationMessageFor('name', '', ['class' => 'text-danger']); ?><br>

                    <label for="surname">Nazwisko:*</label><br>
                    <input type="text" name="surname" id="surname"/><br>
                    <?php $this->validationMessageFor('surname', '', ['class' => 'text-danger']); ?><br>

                    <label for="phone">Telefon:</label><br>
                    <input type="tel" name="phone" id="phone"/><br>
                    <?php $this->validationMessageFor('phone', '', ['class' => 'text-danger']); ?><br>

                    <input type="hidden" name="type" id="type" value="0"/><br>
                    <div style="width:410px; text-align:right;">
                        Zaznacz, kim jesteś:*<br/>
                        Uczeń: <input type="checkbox" onclick="updateType(0)" id="cb_type_U"><br>
                        Rodzic: <input type="checkbox" onclick="updateType(1)" id="cb_type_R"><br>
                        Naczyciel: <input type="checkbox" onclick="updateType(2)" id="cb_type_N"><br>
                    </div>
                    <?php $this->validationMessageFor('type', '', ['class' => 'text-danger']); ?>
                    <select id="class" name="class" title="wybór klasy">
                        <?php
                        /** @var \app\model\Group $group */
                        foreach ($groups as $group) {
                            echo "<option value=", $group->getId(), ">", $group->getName(), "</option>";
                        } ?>
                    </select>
                    <?php $this->validationMessageFor('class', '', ['class' => 'text-danger']); ?><br>
                    <input type="submit" value="Zarejestruj się" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
<?php $this->startSection(); ?>
    <script>
        /* TODO: better validation aestethics*/
        var cls = $('#class');
        var cls_err = $('#class-err');

        var email = $('#email');
        var email_err = $('#email-err');

        var password = $('#password');
        var password_err = $('#password-err');

        var re_password = $('#re-password');
        var re_password_err = $('#re-password-err');

        var name = $('#name');
        var name_err = $('#name-err');

        var surname = $('#surname');
        var surname_err = $('#surname-err');

        var type = $('#type');
        var type_err = $('#type-err');

        var phone = $('#phone');
        var phone_err = $('#phone-err');

        function clearErrors() {
            cls_err.empty();
            email_err.empty();
            password_err.empty();
            re_password_err.empty();
            surname_err.empty();
            type_err.empty()
            phone_err.empty();
        }

        function validateClass() {
            return !(cls.selectedIndex == 0 && $('#cb_type_U').checked);
        }

        function validate() {
            var valid = true;
            clearErrors();
            if (!validatePassword(password.value)) {
                password_err.innerHTML = "Hasło musi mieć minimum 8 znaków!<br />";
                valid = false;
            }
            if (!validatePassword2(password.value, re_password.value)) {
                re_password_err.innerHTML = "Hasła muszą być identyczne!<br />";
                valid = false;
            }
            if (!validateName(name.value)) {
                name_err.innerHTML = "Podane imie jest nieprawidłowe!<br />";
                valid = false;
            }

            if (!validateSurname(surname.value)) {
                surname_err.innerHTML = "Podane nazwisko jest nieprawidłowe!<br />";
                valid = false;
            }

            if (!validatePhone(phone.value)) {
                phone_err.innerHTML = "Podany numer telefonu jest nieprawidłowy!<br />";
                valid = false;
            }

            if (!validateType(type.value)) {
                type_err.innerHTML = "Zaznacz odpowiedni opis!<br />";
                valid = false;
            }
            if (!validateClass()) {
                cls_err.innerHTML = "Wybierz odpowiednią klasę!<br />";
                valid = false;
            }
            return valid;
        }
        function updateType(cb_id) {
            var U = document.getElementById("cb_type_U");
            var R = document.getElementById("cb_type_R");
            var N = document.getElementById("cb_type_N");
            if (cb_id == 0) {
                R.checked = false;
                N.checked = false;
            }
            else {
                U.checked = false;
            }
            if (U.checked) {
                cls.style.visibility = "visible";
            }
            var value = 0;

            if (U.checked) {
                /*FIXME: blackmagic*/
                value = value | <?php echo STUDENT; ?>;
            }
            if (R.checked) {
                value = value | <?php echo PARENT; ?>;
            }
            if (N.checked) {
                value = value | <?php echo TEACHER; ?>;
            }
            type.value = value;
        }
    </script>
<?php $this->endSection('scripts'); ?>