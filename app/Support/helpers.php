<?php

function prd($elem = '')
{

    pr($elem);
    die;
}

function pr($elem = '')
{

    echo '<hr><pre>';
    print_r($elem);
    echo '</pre><hr>';
}

if (!function_exists('get_last_query')) {
    function get_last_query()
    {

        $queries = DB::getQueryLog();

        $sql = end($queries);

        if (!empty($sql['bindings'])) {
            $pdo = DB::getPdo();
            foreach ($sql['bindings'] as $binding) {
                $sql['query'] =
                        preg_replace(
                                '/\?/',
                                $pdo->quote($binding),
                                $sql['query'],
                                1
                        );
            }
        }

        return $sql['query'];
    }

}