<?php
/**
 * Created by PhpStorm.
 * User: kking
 * Date: 12/9/18
 * Time: 1:54 PM
 */

header("Access-Control-Allow-Origin: *");
//'Access-Control-Allow-Origin': '*',
//              'Access-Control-Allow-Credentials':true,
//              'Access-Control-Allow-Methods':'POST, GET'
    header("Access-Control-Allow-Methods: POST");
    header('Access-Control-Allow-Credentials:false');

    include_once '../db.php';
    include_once '../models/member.php';

    $dbcnct =  new db();
    $cnct = $dbcnct ->getConnection();
    $user = new member($cnct);


    $data = json_decode( file_get_contents( 'php://input' ), true );
    echo sizeof($data);

    if(!empty($data) && sizeof($data) === 6) {
        echo 'success';
    } else {
        http_response_code(422);
        echo 'invalid parameters';
    }