<?php
/**
 * Created by PhpStorm.
 * User: kking
 * Date: 12/9/18
 * Time: 5:38 PM
 */

    include_once '../db.php';
    include_once '../models/appointment.php';

    $dbcnct =  new db();
    $cnct = $dbcnct ->getConnection();
    $app = new appointment($cnct);

    if ($_POST){
        echo $app->create($_POST);
    }