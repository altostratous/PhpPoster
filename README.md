# PhpPoster
This project is done to enable posting to some iranian blogging systems using php server side application.
It is based on php_curl, Facebook php-webdriver. 

## Documentation
There you will find full inline documentation for the code.

## Requirements

    php_curl
    facebook/php-webdriver
        - selenium web driver
    geckodriver
    
## Usage
It is really simple:

    <?php
    
    require_once('PersianBlogClient.php');
    $blogClient = new ParsiblogBlogClient("[blog username]", "[blog pasword]", [optional blog tag]);
    $blogClient->post("the title", "the body", [optional blog tag, blog specifier]);