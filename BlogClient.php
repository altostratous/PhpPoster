<?php
require_once ('vendor/autoload.php');
/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 3:19 PM
 */
class BlogClient
{

    protected $blog_tag;
    protected $browser;
    /**
     * BlogClient constructor.
     * @param $username
     * @param $username_field
     * @param $password
     * @param $password_field
     * @param $submit_selector
     * @param $blog_tag
     */
    public function __construct(
        $username,
        $username_field,
        $password,
        $password_field,
        $submit_selector,
        $blog_tag
        )
    {
        // setup browser
        $this->browser = Facebook\WebDriver\Remote\RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            \Facebook\WebDriver\Remote\DesiredCapabilities::firefox());
    }
}