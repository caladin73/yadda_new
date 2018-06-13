<?php
    session_start();
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Authentication.inc.php';
    $dbh = DbH::getDbH();
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register New User</title>
        <link rel='stylesheet' href='css/styles.css'/>
        <script>
            'use strict'; // use correct syntax in js. Helps us find issues in js
            var check = function (e) {
                if (document.forms.formalia.pwd1.value !== 
                                   document.forms.formalia.pwd2.value) {
                    window.alert("Two password entries differ");
                    document.forms.formalia.pwd1.focus();
                    e.preventDefault(); //#1 stay on this page
                    return false;       //#1
                } 
            }
            var init = function () {
                document.forms.formalia.addEventListener('submit', check);
            }
            window.addEventListener('load', init);
        </script>
    </head>
    <body>
<?php
    include './includes/menu.inc.php';
?>
        <main id="mydiv">
          <form id='formalia' action="./registerNewUserDb.php" method="post">
            <table id="register">
                <caption>New user</caption>
                <tr>
                  <td class='l'>First name:</td>
                  <td><input type="text" name="fname" required/>*</td>
                </tr>
                <tr>
                  <td class='l'>Last name:</td>
                  <td><input type="text" name="lname" required/>*</td>
                </tr>
                <tr>
                  <td class='l'>Desired userid:</td>
                  <td><input type="text" name="uid" required/>*</td>
                </tr>
                <tr>
                  <td class='l'>Email address:</td>
                  <td><input type="email" name="email" required/>*</td>
                </tr>
                <tr>
                  <td class='l'>Password:</td>
                  <td><input type="password" name="pwd1" required/>*</td>
                </tr>
                <tr>
                  <td class='l'>Repeat password:</td>
                  <td><input type="password" name="pwd2" required/>*</td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" value="OK"/>
                  </td>
                </tr>
            </table>
          </form>
        </main>

  </body>
</html>