<?php
require_once 'BlogClient.php';
/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 3:25 PM
 */
class BlogfaBlogClient extends BlogClient
{
    public function __construct($username, $password, $blog_tag = null)
    {
        parent::__construct($username, 'usrid', $password, 'usrpass', 'input[name=btnSubmit]', $blog_tag);
    }

}