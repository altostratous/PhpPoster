<?php

/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/29/2016
 * Time: 9:19 PM
 */
class BlogfaBlogClient extends BlogClient
{

    /**
     * PersianBlogClient constructor.
     * @param $username The user name for persian blog account
     * @param $password The password for persian blog account
     * @param null $blog_tag Blog specifier
     */
    public function __construct($username, $password, $blog_tag = null)
    {
        parent::__construct(array(
            'usrid' => $username,
            'usrpass' => $password,
        ), "http://www.blogfa.com/Desktop/Login.aspx", null);
    }

    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function send_post($title, $body, $blog_tag = null)
    {
        $this->blog_tag = $blog_tag;
        parent::post(array('txtTitle' => $title, 'txtPostBody' => $body), '__VIEWSTATE=%2FwEPDwULLTE0NTUzMjMwODAPFg4eBkFjdGlvbgUHbmV3cG9zdB4GUG9zdElkBQEwHgN0bXQFEjYzNjE4NjYzOTk5NzA0NjI1MB4GQ2F0Q250BQEwHgdvbGR0YWdzZR4FdG9rZW4FCTczOTUwOTQ5NR4LbmV3cG9zdHRpbWUFEDYzNjE4NjYzOTk5LjcwNDZkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYDBQhjaGtEcmFmdAUPY2hrQXV0b21hdGVUaW1lBQljaGtTdGlja3lu%2FRdIBVIgXRJ12Gt%2BXDqH0IQFBw%3D%3D&__VIEWSTATEGENERATOR=D40A4779&__EVENTVALIDATION=%2FwEdABY8iftIam3WYVfBOtHhIUqW5zWayQiUQh3YpXfp9HkgkZo7RSy2v17%2BIgTuctb9ALcEOdruqxjq0t8optBUCG2OBF7mZAo5AuH6QQyGE20ZcOKpzeND3KbwadDhZC69DXcVMM0pjvw3qe8w%2Bh90de8NrITvMKBaL6tTJUl7LVQO0i2y9P8QKGSk9qf%2ByerY0eaBmXREJtVMpNl0TDTz9%2FhJx2mxUtyz9Zu1ZI3ZaRQ0WeV8Jp6FeWjBLTrDLlR4ySuOd7TRJ9WcpQEMUDSb74OyOeIj0sLGXv4vKBEqal2l%2BeXC%2B0tNsLKWBHNTy6ajDOHKrf96LiPYguDIhmE3NOXXy37GA43880HQdfWjXLBe5Wp9UeWesnd0pOx9L%2BYCwlrNTiQNUiO73P8KZK9R0bGTzqdjC1nI2ATq7C8946HSKW%2F6FhrNxJ%2BYZf6p6xvA%2BTY04XqpPlQHWkBc13WhQ6AzQQJONeLHJIGoT9FCOvGeFjLnvgQ%3D&hasextended=false&txtTitle=%D8%A8%D8%B1%D9%88+%D8%A8%DB%8C%D9%86%DB%8C%D9%85+%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7&txtPostBody=%3Cp%3E%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7%D8%A8%D8%A7%3C%2Fp%3E&txtPostExtended=&btnPublish=%D8%AB%D8%A8%D8%AA+%D9%86%D9%88%D8%B4%D8%AA%D9%87+%D9%88+%D8%A8%D8%A7%D8%B2%D8%B3%D8%A7%D8%B2%DB%8C+%D9%88%D8%A8%D9%84%D8%A7%DA%AF&txtTags=&cmbCommentType=9&txtDay=10&txtMonth=10&txtYear=1395&txtMinute=36&txtHour=06&chkAutomateTime=on&txtPostPW=',
            array(
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate, br',
                //'Referer' => 'https://blogfa.com/Desktop/Post.aspx?action=new&r=5363844798921250&t=236017524',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => 1,
                'Pragma' => 'no-cache',
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ));
    }




    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        // try to load posting page
        $html = $this->grab_page('http://www.blogfa.com/Desktop/home.aspx?type=first');
        $document = new DOMDocument();
        @$document->loadHTML($html);
        $last_url = 'http://www.blogfa.com/Desktop/'.$document->getElementsByTagName('a')->item(0)->getAttribute('href');
        return $last_url;
    }
}