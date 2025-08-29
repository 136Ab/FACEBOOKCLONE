<?php
require_once "db.php";
require_once "helpers.php";
if(!logged_in()){
    redirect_js("login.php");
}
