<?php
require_once ('vendor/autoload.php');
require_once ('BlogClient.php');
/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 3:19 PM
 */
abstract class SeleniumBlogClient implements BlogClient
{

    protected $blog_tag;
    protected $browser;

    /**
     * BlogClient constructor.
     * @param $username string the username to login
     * @param $username_field string name of the username input element
     * @param $password string the password to login
     * @param $password_field string name of the password input element
     * @param $submit_selector string css selector for the login submit button
     * @param $login_url string url of login page
     * @param $blog_tag string The default tag for the blog
     */
    public function __construct(
        $username,
        $username_field,
        $password,
        $password_field,
        $submit_selector,
        $login_url,
        $blog_tag
        )
    {
        // set field
        $this->blog_tag = $blog_tag;
        // setup browser
        $this->browser = Facebook\WebDriver\Remote\RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            \Facebook\WebDriver\Remote\DesiredCapabilities::firefox());
        $this->browser->get($login_url);
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name($username_field))->sendKeys($username);
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name($password_field))->sendKeys($password);
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector($submit_selector))->click();
    }

    /***
     * @param $title string the title
     * @param $content string the content
     * @param null $blog_tag string the blog tag
     * @return mixed
     */
    public abstract function send_post($title, $content, $blog_tag = null);

    /**
     * @return mixed custom submit routine for each blogging system
     */
    public abstract function submit_post();

    /**
     * Generally submits posts, you can write your own routine
     * @param $title
     * @param $content
     * @param $title_field string name of the title input element
     * @param $content_field string name of the content input element
     */
    public function general_send_post($title, $content, $title_field, $content_field){
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name($title_field))->sendKeys($title);
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name($content_field))->sendKeys($content);
        $this->submit_post();
    }
}