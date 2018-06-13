<?php
?>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
        <header>
            <h1>Yadda Yadda Yadda &#153</h1>
            <ul id='menu'>
                <li><a href="index.php">Home</a></li>
                <li><a href="sales.php">Sales</a></li>
<?php
                if (!Authentication::isAuthenticated()) {
                    printf("%16s<li><a href='registerNewUser.php'>
                                        Become a User</a></li>\n", " ");
                    printf("%16s<li><a href='testLogin.php'>
                                        Login</a></li>\n", " ");
                } else { 
                    printf("%16s<li class='dropdown'>\n", " ");
                        printf("%16s<a href='javascript:void(0)' class='dropbtn'>Admin</a>\n", " ");
                        printf("%16s<div class='dropdown-content'>\n", " \n", " ");
                            printf("%16s<a href='addP.php'>
                                        Add Product, adm</a>\n", " ");
                            printf("%16s<a href='activateUsers.php'>Active new users</a>\n", " ");
                            
                        printf("%16s</div>\n", " ");
                    printf("%16s</li>\n", " ");
                    
                    printf("%16s<li><a href='testLogout.php'>
                                        Logout</a></li>\n", " ");
                }
?>
            </ul>
<?php
//                print("<p></p>");
                if (Authentication::isAuthenticated()) {
                    printf("<br /><div>Welcome <b>%s</b></div>", 
                            Authentication::getDispvar());
                } else
                    print("<br /><p>Welcome to Yadda Yadda Yadda &#153 - register to join</p>");
?>
        </header>