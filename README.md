# PhpPoster
This project is done to enable posting to persianblog.ir using php server side application.
php_curl is used to perform requests.

## Documentation
There you will find full inline documentation for the code.

## Requirements
This project is done using php_curl so it should be installed on the production server.

## Usage
It is really simple:

    <?php
    
    require_once('PersianBlogClient.php');
    $webClient = new PersianBlogClient("[blog username]", "[blog pasword]");
    $webClient->post('[blog ID, it can be found in the url when posting to a blog on persian blog]', "the title", "the body");