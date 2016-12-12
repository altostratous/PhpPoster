<?php
/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
class PersianBlogClient
{
    /**
     * PersianBlogClient constructor.
     * @param $username The user name for persian blog account
     * @param $password The password for persian blog account
     */
    public function __construct($username, $password)
    {
        // first encode the values
        $username = urlencode($username);
        $password = urlencode($password);
        // get the page containing the form
        $html = $this->grab_page("http://persianblog.ir/Login.aspx?ReturnUrl=%2fHome.aspx");
        // load the html document lazily
        $document = new DOMDocument();
        @$document->loadHTML($html);
        // get all input tags
        $inputs = $document->getElementsByTagName("input");
        // data to post, so far username and password
        $data = "TxtUsername=$username&TxtPassword=$password";
        // foreach hidden input tag
        foreach ($inputs as $input){
            // it it is not username or password
            if ($input->getAttribute("name") != "TxtUsername" && $input->getAttribute("name") != "TxtPassword")
                // add the tag value to data
                $data .= '&'.$input->getAttribute("name").'='.urlencode($input->getAttribute("value"));
        }
        // request login
        $this->login("http://persianblog.ir/Login.aspx?ReturnUrl=%2fHome.aspx", $data);
    }

    /**
     * @param $blogID The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function post($blogID, $title, $body){
        // first encode values
        $title = urlencode($title);
        $body = urlencode($body);
        // try to load posting page
        $ch = $this->grab_page_handle("http://persianblog.ir/CreatePost.aspx?blogID=$blogID");
        // get the redirected url containing the 'h' parameter
        $last_url = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
        // get the page containing form
        $html = $this->grab_page($last_url);
        // load the document to get inputs
        $document = new DOMDocument();
        @$document->loadHTML($html);
        // get all input tags
        $inputs = $document->getElementsByTagName("input");
        // add title and body to data
        $data = "TxtTitle=$title&intrContent=$body";
        // for each of other tags add their value to the data
        foreach ($inputs as $input){
            if ($input->getAttribute("name") != "TxtTitle" && $input->getAttribute("name") != "intrContent")
                $data .= '&'.$input->getAttribute("name").'='.urlencode($input->getAttribute("value"));
        }
        // post the data to the blog
        $this->post_data($last_url, $data);
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
        curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
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
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
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
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
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
        curl_setopt($data_post, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($data_post, CURLOPT_POST, TRUE);
        curl_setopt($data_post, CURLOPT_POSTFIELDS, $data);
        curl_setopt($data_post, CURLOPT_COOKIEFILE, "cookie.txt");
        ob_start();
        return curl_exec ($data_post);
        ob_end_clean();
        curl_close ($data_post);
        unset($data_post);
    }

}