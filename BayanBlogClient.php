<?php

/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/29/2016
 * Time: 9:19 PM
 */
class BayanBlogClient extends BlogClient
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
            'username' => $username,
            'password' => $password,
        ), "http://bayan.ir/service/bayan/", 'ورود', $blog_tag);
    }

    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     * @return mixed|void
     */
    public function post($title, $body, $blog_tag = null)
    {
        $this->blog_tag = $blog_tag;
        $this->browser->addHeader("User-Agent	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0
Accept	application/json, text/javascript, */*; q=0.01
Accept-Language	en-US,en;q=0.5
Accept-Encoding	gzip, deflate
Content-Type	application/x-www-form-urlencoded; charset=UTF-8
X-Requested-With	XMLHttpRequest
Referer	http://blog.ir/panel/$blog_tag/post_edit/
Connection	keep-alive");
        $this->inner_post(array('title' => $title, 'content' => $body, 'url' => time()));
    }




    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        return "http://blog.ir/panel/$this->blog_tag/process/post_edit#new";
    }

    /**
     * @return mixed
     */
    protected function get_background_params()
    {
        $background_params = array();
        parse_str('post_did=&get_post_data=1&title=asdfasdfas&url=asdfasdfas&content=%3Cp%3Esdfasdfadfafsdf%3Cbr%3E%3C%2Fp%3E&tags=&status=1&settings_PIN_ORDER=1&categories=&settings_COMMENT_SEND_ENABLED=1&settings_COMMENT_SEND_ENABLED=0&settings_COMMENT_WHO_CAN=1&settings_COMMENT_APPROVAL_FOR=0&settings_ALLOW_ANONYMOUS_COMMENT=1&settings_ALLOW_ANONYMOUS_COMMENT=0&settings_COMMENT_ONLY_PRIVATE=0&settings_NEW_COMMENTS_LIMITED_BY_TIME=0&settings_IS_PROTECTED=0&settings_ENABLE_PRIVATE_COMMENTS_FOR_PROTECTED=1&settings_ENABLE_PRIVATE_COMMENTS_FOR_PROTECTED=0&settings_IS_RATING_ENABLED=1&settings_IS_RATING_ENABLED=0&settings_HIDE_POST_AUTHOR_NAME=0&settings_HIDE_POST_DATE=0&settings_SEPARATE_SUMMARY_AND_CONTENT=0&settings_CONVERT_PERSIAN_CHARS=1&settings_CONVERT_PERSIAN_CHARS=0', $background_params);
        return $background_params;
    }
}