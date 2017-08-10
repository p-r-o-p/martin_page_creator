<?php

/**
 * Class PageInit
 */
class PageInit
{

    public function __construct() {
        $handle = fopen('page_template.php', 'r');
        $page_content = fread($handle, filesize('page_template.php'));
        var_dump($page_content);
    }

}