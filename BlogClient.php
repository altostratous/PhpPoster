<?php
require_once 'vendor/autoload.php';

/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
abstract class BlogClient
{
    protected $blog_tag;
    protected $browser;

    /**
     * BlogClient constructor.
     * @param $login_data array in this structure array('[username field name]'=>username, 'password field name'=>password)
     *        for example.
     * @param $login_url The url to login
     * @param string $submit_label
     * @param null $blog_tag if the blog has any id or specifier
     * @internal param $gecko_driver_path
     */
    public function __construct($login_data, $login_url, $submit_label = 'ورود', $blog_tag = null)
    {
        // setup
        $this->blog_tag = $blog_tag;
        $host = 'http://localhost:4444/wd/hub';

        $capabilities = Facebook\WebDriver\Remote\DesiredCapabilities::firefox();
        $this->browser = Facebook\WebDriver\Remote\RemoteWebDriver::create($host, $capabilities);
        // post login form
//        $this->post_data_click($login_data, $login_url, $submit_label);
        $this->browser->get($login_url);
    }

    /**
     * @return string
     */
    protected abstract function get_post_url();


    /**
     * @param $title
     * @param $content
     * @param $blogID
     * @return mixed
     */
    public abstract function post($title, $content, $blogID);
}