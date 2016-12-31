<?php

// include the Class
require_once('PersianBlogClient.php');
require_once('BlogfaBlogClient.php');

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
        // $persianBlogWebClient = new PersianBlogClient("phpposter", "phpposter");
        $blogfaBlogClient = new BlogfaBlogClient('week','poorpoor');
        // post to the blog
        // $persianBlogWebClient->send_post($title, $body, '946656');
        $blogfaBlogClient->send_post($title,$body);
        // put the new post hash for further check
        file_put_contents("hash", md5($title.$body));
    }
    else
    {
        echo "Post already uploaded.";
    }
}