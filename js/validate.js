<script>

/* 
 * validate.js
 * This javascript function verifies if "password" and "repeat password" matches
 * @Project: YaddaYaddaYadda
 * @author: Marianne, Jepser, Peter & Daniel
 */

   'use strict';
    var check = function (e) {
        if (document.forms.yaddaform.img.value == '') {
            window.alert("No image selected!");
            document.forms.yaddaform.text.focus();
            e.preventDefault();
            return false;
        }
    };
    var init = function () {
        document.forms.yaddaform.addEventListener('submit', check);
    };
    window.addEventListener('load', init);
</script>