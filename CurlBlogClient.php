<?php
require_once ('BlogClient.php');
/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
abstract class CurlBlogClient implements BlogClient
{
    protected $blog_tag;
    /**
     * BlogClient constructor.
     * @param $login_data array in this structure array('[username field name]'=>username, 'password field name'=>password)
     *        for example.
     * @param $login_url The url to login
     * @param null $blog_tag if the blog has any id or specifier
     * @internal param The $username user name for persian blog account
     * @internal param The $password password for persian blog account
     */
    public function __construct($login_data, $login_url, $blog_tag = null)
    {
        // setup
        $this->blog_tag = $blog_tag;
        // get the page containing the form
        $html = $this->grab_page($login_url);
        // load the html document lazily
        $document = new DOMDocument();
        @$document->loadHTML($html);
        // get all input tags
        $inputs = $document->getElementsByTagName("input");
        // data to post, so far given data
        $data = '';
        $added_fields = array();
        foreach ($login_data as $key => $value){
            $data .= urlencode($key).'='.urlencode($value).'&';
            array_push($added_fields, $key);
        }
        // foreach hidden input tag
        foreach ($inputs as $input){
            // it it is not username or password
            if (!in_array($input->getAttribute("name"), $added_fields))
                // add the tag value to data
                $data .= urlencode($input->getAttribute("name")).'='.urlencode($input->getAttribute("value")).'&';
        }
        // request login
        $this->login($login_url, $data);
    }
    protected abstract function get_post_url();

    /**
     * @param $post_data
     * @param $background_data
     */
    protected function post($post_data, $background_data = null){
        if ($background_data != null){
            $background_data_array = array();
            parse_str($background_data, $background_data_array);
            array_merge($post_data, $background_data_array);
        }
        // get post url
        $post_url = $this->get_post_url();
        // get the page containing form
        $html = $this->grab_page($post_url);
        // get action url
        $action = $this->get_form_action($html);
        // load the document to get inputs
        $document = new DOMDocument();
        @$document->loadHTML($html);
        // get all input tags
        $inputs = $document->getElementsByTagName("input");

        // foreach hidden input tag
        foreach ($inputs as $input){
            // add the tag value to data
            if (!isset($post_data[$input->getAttribute("name")])){
                $post_data[$input->getAttribute("name")] = $input->getAttribute("value");
            }
        }
        // data to post, so far given data
        $data = '';
        foreach ($post_data as $key => $value){
            $data .= urlencode($key).'='.urlencode($value).'&';
        }
        // post the data to the blog
        echo $this->post_data($action, $data);
    }
    /**
     * Logs in to the site and saves cookie.txt
     * Find full documentation here
     * https://www.youtube.com/watch?v=_kQN-3aNCeI
     * @param $url the url to login to
     * @param $data the data to send
     * @return mixed returns curl result
     */
    function login($url, $data){
        $fp = fopen("cookie.txt", "w");
        fclose($fp);
        $login = curl_init();
        curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
        curl_setopt($login, CURLOPT_TIMEOUT, 40000);
        curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($login, CURLOPT_URL, $url);
        curl_setopt($login, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
        curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($login, CURLOPT_POST, TRUE);
        curl_setopt($login, CURLOPT_POSTFIELDS, $data);
        ob_start();
        return curl_exec ($login);
        ob_end_clean();
        curl_close ($login);
        unset($login);
    }
    /**
     * Grabs a website page
     * Find full documentation here
     * https://www.youtube.com/watch?v=_kQN-3aNCeI
     * @param $site The site to grab
     * @return resource The curl handle
     */
    function grab_page($site){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
        curl_setopt($ch, CURLOPT_URL, $site);
        ob_start();
        return curl_exec ($ch);
        ob_end_clean();
        curl_close ($ch);
    }
    /**
     * Grabs a website page
     * Find full documentation here
     * https://www.youtube.com/watch?v=_kQN-3aNCeI
     * @param $site The site to grab
     * @return resource The curl handle
     */
    function grab_page_handle($site){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
        curl_setopt($ch, CURLOPT_URL, $site);
        ob_start();
        // changed here to return the curl handle
        curl_exec($ch);
        return $ch;
        ob_end_clean();
        curl_close ($ch);
    }
    /**
     * Posts data to url
     * Find full documentation here:
     * https://www.youtube.com/watch?v=_kQN-3aNCeI
     * @param $site the url
     * @param $data the data url encoded
     * @return mixed returns curl_exec result
     */
    function post_data($site,$data){
        $data_post = curl_init();
        $headers = array("Expect:");
        curl_setopt($data_post, CURLOPT_URL, $site);
        curl_setopt($data_post, CURLOPT_TIMEOUT, 40000);
        curl_setopt($data_post, CURLOPT_HEADER, TRUE);
        curl_setopt($data_post, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($data_post, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0');
        curl_setopt($data_post, CURLOPT_POST, TRUE);
        curl_setopt($data_post, CURLOPT_POSTFIELDS, $data);
        curl_setopt($data_post, CURLOPT_COOKIEFILE, "cookie.txt");
        ob_start();
        return curl_exec ($data_post);
        ob_end_clean();
        curl_close ($data_post);
        unset($data_post);
    }


    protected function get_form_action($html){
        $document = new DOMDocument();
        @$document->loadHTML($html);
        $url = $document->getElementsByTagName('form')->item(0)->getAttribute('action');
        return $url;
    }
}