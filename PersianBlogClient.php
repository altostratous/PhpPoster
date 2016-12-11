<?php
/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
class PersianBlogClient extends WebClient
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
        // request login, the login data is captured from firefox while requesting using HttpFox firefox add-on.
        $this->login("http://persianblog.ir/Login.aspx?ReturnUrl=%2fHome.aspx", "__VIEWSTATE=%2FwEPDwULLTIwMjg2NzY4MDhkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYBBQ1DaGtSZW1lbWJlck1lULx8c80UqaSnSstbTvc%2BW8EyA%2B24CqblyFcpdU1s4Zk%3D&__VIEWSTATEGENERATOR=C2EE9ABB&TxtUsername=$username&TxtPassword=$password&btnLogin=%D9%88%D8%B1%D9%88%D8%AF");
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
        $ch = $this->grab_page("http://persianblog.ir/CreatePost.aspx?blogID=$blogID");
        // get the redirected url containing the 'h' parameter
        $last_url = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
        // post the data to the blog, the login data is captured from firefox while requesting using HttpFox firefox add-on.
        $this->post_data($last_url,
            "__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=%2FwEPDwULLTExNzAxNjk2MTUPFgIeB3Bvc3RTZWMFAjIzFgICAQ9kFgICCw9kFgJmD2QWCgIBDxYCHgRUZXh0BQlwaHBwb3N0ZXJkAgMPEA8WAh4LXyFEYXRhQm91bmRnZGQWAGQCBQ8PFgIeC05hdmlnYXRlVXJsBR9odHRwOi8vcGhwcG9zdGVyLnBlcnNpYW5ibG9nLmlyZGQCBw8PFgIfAwUJSG9tZS5hc3B4ZGQCCQ9kFiJmDw8WAh8DBR1DcmVhdGVQb3N0LmFzcHg%2FYmxvZ0lEPTk0NjY1NmRkAgEPDxYCHwMFHk1hbmFnZVBvc3RzLmFzcHg%2FYmxvZ0lEPTk0NjY1NmRkAgIPDxYCHwMFHUNyZWF0ZVBhZ2UuYXNweD9ibG9nSUQ9OTQ2NjU2ZGQCAw8PFgIfAwUeTWFuYWdlUGFnZXMuYXNweD9ibG9nSUQ9OTQ2NjU2ZGQCBA8PFgIfAwUhTWFuYWdlQ29tbWVudHMuYXNweD9ibG9nSUQ9OTQ2NjU2ZGQCBQ8PFgIfAwUZQmFja3VwLmFzcHg%2FYmxvZ0lEPTk0NjY1NmRkAgYPDxYCHwMFHUNoYW5nZVRlbXAuYXNweD9ibG9nSUQ9OTQ2NjU2ZGQCBw8PFgIfAwUgRWRpdFRlbXBTdHlsZS5hc3B4P2Jsb2dJRD05NDY2NTZkZAIIDw8WAh8DBRtFZGl0VGVtcC5hc3B4P2Jsb2dJRD05NDY2NTZkZAIJDw8WAh8DBR1DdXN0b21Db2RlLmFzcHg%2FYmxvZ0lEPTk0NjY1NmRkAgoPDxYCHwMFG0VkaXRCbG9nLmFzcHg%2FYmxvZ0lEPTk0NjY1NmRkAgsPDxYCHwMFHk1hbmFnZUxpbmtzLmFzcHg%2FYmxvZ0lEPTk0NjY1NmRkAgwPDxYCHwMFIE1hbmFnZUF1dGhvcnMuYXNweD9ibG9nSUQ9OTQ2NjU2ZGQCDQ8PFgIfAwUbRWRpdFRhZ3MuYXNweD9ibG9nSUQ9OTQ2NjU2ZGQCDg8PFgIfAwUfRWRpdEJsb2cuYXNweD9ibG9nSUQ9OTQ2NjU2I2Z0cGRkAg8PDxYCHwMFM2h0dHA6Ly93d3cucGVyc2lhbnN0YXQuY29tL1Jlc3VsdHMuYXNweD9pZD00MDk0NjY1NmRkAhAPFgIfAQUkPGEgaHJlZj0iUFMuYXNweCI%2B2KrZhti424zZhdin2Ko8L2E%2BZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WCQUJY2hrRXh0cmExBQRjWWVzBQVjQXBwcgUFY0FwcHIFA2NObwUDY05vBQdwUHVibGljBQpwUHJvdGVjdGVkBQpwUHJvdGVjdGVkuZZCbbUSbXIQP%2FEDSoFe8uLczaubgRpPyHfZkOTKJ4Q%3D&__VIEWSTATEGENERATOR=79457F1B&blogID=946656&blogName=phpposter&securityToken=9e4ad10ee5c9e9b46bba25996ba144c923904d13&TxtTitle=$title&intrContent=$body&keyWord1=&keyWord2=&keyWord3=&keyWord4=&mainContent=&postDay=22&postMonth=09&postYear=1395&postMinute=03&postHour=10&Commenting=cYes&PostPreview=pPublic&txtPostPasswd=&btnPublish=%D8%A7%D9%86%D8%AA%D8%B4%D8%A7%D8%B1"
            );
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
        // changed here to return the curl handle
        curl_exec ($ch);
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
        $datapost = curl_init();
        $headers = array("Expect:");
        curl_setopt($datapost, CURLOPT_URL, $site);
        curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
        curl_setopt($datapost, CURLOPT_HEADER, TRUE);
        curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($datapost, CURLOPT_POST, TRUE);
        curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
        curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
        ob_start();
        return curl_exec ($datapost);
        ob_end_clean();
        curl_close ($datapost);
        unset($datapost);
    }

}