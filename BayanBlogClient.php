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
        ), "http://bayan.ir/service/bayan/", null);
    }

    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function send_post($title, $body, $blog_tag = null)
    {
        $this->blog_tag = $blog_tag;
        parent::post(array('title' => $title, 'content' => $body, 'url' => time()), 'post_did=&get_post_data=1&title=%D8%A7%D9%85%D8%AA%DB%8C%D8%A7%D8%B2+%D8%B3%D9%88%D8%A7%D9%84%D8%A7+%D9%85%D8%B1%D8%AA%D8%A8+%D8%A7%D8%B3%D8%AA%D8%9F&url=sdfafdfsf&content=%3Cp%3Efjaslkfjslfsafas%3Cbr%3E%3C%2Fp%3E&tags=&status=1&settings_PIN_ORDER=1&categories=&settings_COMMENT_SEND_ENABLED=1&settings_COMMENT_SEND_ENABLED=0&settings_COMMENT_WHO_CAN=1&settings_COMMENT_APPROVAL_FOR=0&settings_ALLOW_ANONYMOUS_COMMENT=1&settings_ALLOW_ANONYMOUS_COMMENT=0&settings_COMMENT_ONLY_PRIVATE=0&settings_NEW_COMMENTS_LIMITED_BY_TIME=0&settings_IS_PROTECTED=0&settings_ENABLE_PRIVATE_COMMENTS_FOR_PROTECTED=1&settings_ENABLE_PRIVATE_COMMENTS_FOR_PROTECTED=0&settings_IS_RATING_ENABLED=1&settings_IS_RATING_ENABLED=0&settings_HIDE_POST_AUTHOR_NAME=0&settings_HIDE_POST_DATE=0&settings_SEPARATE_SUMMARY_AND_CONTENT=0&settings_CONVERT_PERSIAN_CHARS=1&settings_CONVERT_PERSIAN_CHARS=0');
    }




    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        return "http://blog.ir/panel/$this->blog_tag/process/post_edit#new";
    }
}