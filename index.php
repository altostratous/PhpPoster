<?php
require_once ('PersianblogBlogClient.php');
require_once ('BlogfaBlogClient.php');
require_once ('PersianblogBlogClient.php');
require_once ('Configuration.php');

// check selenium server
if (!Configuration::is_selenium_running()){
    echo 'Selenium server not running. \r\n <br>';
    die();
}

// if both title and body files exist
if (file_exists("title.txt") && file_exists("body.txt")) {
    // flag to perform posting
    $doPost = true;
    // get content of body file
    $body = file_get_contents("body.txt");
    // get content of title file
    $title = file_get_contents("title.txt");
    // if post hash file exists
    if (file_exists("hash")) {
        // compare hash, if it is the same
        if (md5($title.$body) == file_get_contents("hash"))
            // we won't post
            $doPost = false;
    }

    $doPost =true;
    // if the post flag is set
    if ($doPost) {
        // create client
        // $blogClient = new BlogfaBlogClient('week', 'poorpoor');
        $blogClient = new PersianblogBlogClient('phpposter', 'phpposter', '946656');
        // send post
        $blogClient->send_post($title, $body);
        file_put_contents("hash", md5($title.$body));
    }
    else
    {
        echo "Post already uploaded.";
    }
}