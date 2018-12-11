<?php
/**
 * Created by PhpStorm.
 * User: kking
 * Date: 12/9/18
 * Time: 1:54 PM
 */

    header('Access-Control-Allow-Origin: *');
//    header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
    header("Access-Control-Allow-Headers: *");

    include_once '../db.php';
    include_once '../models/member.php';

    $dbcnct =  new db();
    $cnct = $dbcnct ->getConnection();
    $user = new member($cnct);

    if ($_POST){
        http_response_code(300);
//       echo json_encode($user->create($_POST));
    }