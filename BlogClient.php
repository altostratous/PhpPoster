<?php
require_once ('simpletest/browser.php');
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
     * @param $submit_label
     * @param null $blog_tag if the blog has any id or specifier
     */
    public function __construct($login_data, $login_url, $submit_label = 'ورود', $blog_tag = null)
    {
        // setup
        $this->blog_tag = $blog_tag;
        $this->browser = new SimpleBrowser;

        // post login form
        $this->post_data_click($login_data, $login_url, $submit_label);
    }

    /**
     * @return string
     */
    protected abstract function get_post_url();

    /**
     * @return array
     */
    protected abstract function get_background_params();

    /**
     * @param $title
     * @param $content
     * @param $blogID
     * @return mixed
     */
    public abstract function post($title, $content, $blogID);

    /**
     * @param $data array The collection of params that should be sent.
     * @param $url  string The url to submit data
     * @param $submit_label string Label for the submit button.
     */
    protected function post_data_click($data, $url, $submit_label) {
        // get post url
        $post_url = $url;

        // get the page containing form
        $this->browser->get($post_url);

        // set the fields
        foreach ($data as $key => $value) {
            $this->browser->setField($key, $value);
        }

        // submit
        $this->browser->clickSubmit($submit_label);
    }

    protected function inner_post_with_click($data) {
        $post_url = $this->get_post_url();
        $background = $this->get_background_params();
        foreach ($background as $key => $value) {
            $data[$key] = $value;
        }
        $this->post_data_click($data, $post_url);
    }

    protected function inner_post($data){
        $background = $this->get_background_params();
        foreach ($data as $key => $value) {
            $background[$key] = $value;
        }
        $html = $this->browser->post($this->get_post_url(),$data);
        echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>'.$html.'</html>';
    }
}