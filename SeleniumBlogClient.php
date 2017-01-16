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
     * @param $username
     * @param $username_field
     * @param $password
     * @param $password_field
     * @param $submit_selector
     * @param $login_url
     * @param $blog_tag
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

    public abstract function send_post($title, $content, $blog_tag = null);
    public abstract function submit_post();
    public function general_send_post($title, $content, $title_field, $content_field){
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name($title_field))->sendKeys($title);
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name($content_field))->sendKeys($content);
        $this->submit_post();
    }
}