<?php

/**
 * Class PageInit
 */
class PageInit
{

    public static function create_page(string $author_name, string $folder_name, array $db_info) {
        $handle = fopen('page_template.php', 'r');
        $page_content = fread($handle, filesize('page_template.php'));
        var_dump($page_content);
    }

}