<script>
/* 
 * createUserVerify.js
 * This javascript function verifies if "password" and "repeat password" matches
 * @Project: YaddaYaddaYadda
 * @author: Marianne, Jepser, Peter & Daniel
 */

    'use strict';
    var check = function (e) {
        if (document.forms.formalia.password.value !== document.forms.formalia.pwd2.value) {
            window.alert("Two password entries differ");
            document.forms.formalia.password.focus();
            e.preventDefault();
            return false;
        }
    };
    var init = function () {
        document.forms.formalia.addEventListener('submit', check);
    };
    window.addEventListener('load', init);
</script>