<?php
require_once 'BlogClient.php';
/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 3:25 PM
 */
class ParsiblogSeleniumBlogClient extends SeleniumBlogClient
{
    public function __construct($username, $password, $blog_tag = null)
    {
        parent::__construct(
            $username,
            'Condition',
            $password,
            'name',
            '#beusergif',
            'http://parsiblog.com/Def.htm?ru=Default',
            $blog_tag);
    }
    function js_string_escape($data)
    {
        $safe = "";
        for($i = 0; $i < strlen($data); $i++)
        {
            if(ctype_alnum($data[$i]))
                $safe .= $data[$i];
            else
                $safe .= sprintf("\\x%02X", ord($data[$i]));
        }
        return $safe;
    }
    public function send_post($title, $content, $blog_tag = null)
    {
        if ($blog_tag != null)
            $this->blog_tag = $blog_tag;
        $this->browser->wait()->until(function ($driver){
            return strpos($driver->getCurrentUrl(), "http://www.parsiblog.com/Main.aspx") !== false;
        });
        $this->browser->get("http://www.parsiblog.com/Notes.aspx?Post");
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name('Title'))->sendKeys($title);
        $this->browser->executeScript("tinyMCE.getInstanceById('PBEdit').setContent('".$this->js_string_escape($content)."');");
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::name('Title'))->sendKeys($title);
        $this->submit_post();
    }

    public function submit_post()
    {
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('#SaveBtn'))->click();
    }
}