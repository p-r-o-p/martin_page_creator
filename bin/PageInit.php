<?php

/**
 * Class PageInit
 */
class PageInit
{

    public static function create_page(string $author_name, string $folder_name, array $db_info) {
        $template_handle = fopen('bin/page_template.php', 'r');
        $page_content = sprintf(fread($template_handle, filesize('bin/page_template.php')),
            $db_info['hostname'],$db_info['username'],$db_info['passwd'],$db_info['dbname'],$db_info['dbport'],$db_info['dbsocket'],$author_name);
        fclose($template_handle);
        $author_name = str_replace(" ", "_", $author_name);
        $page_handle = fopen(sprintf("%s/%s.php", $folder_name, $author_name), "w");
        fwrite($page_handle, $page_content);
        fclose($page_handle);
    }

}