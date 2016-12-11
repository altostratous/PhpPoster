<?php

require_once('PersianBlogClient.php');
if (file_exists("title.txt") && file_exists("body.txt")) {
    $doPost = true;
    $body = file_get_contents("body.txt");
    $title = file_get_contents("title.txt");
    if (file_exists("hash")) {
        if (md5($title.$body) == file_get_contents("hash"))
            $doPost = false;
    }
    if ($doPost) {
        $webClient = new PersianBlogClient("phpposter", "phpposter");
        $webClient->post('946656', $title, $body);
        file_put_contents("hash", md5($title.$body));
    }
}