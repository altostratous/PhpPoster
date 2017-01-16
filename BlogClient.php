<?php

/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/16/17
 * Time: 8:55 PM
 */
interface BlogClient
{
    function send_post($title, $content, $blog_tag = null);
}