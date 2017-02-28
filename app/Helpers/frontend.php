<?php
\Html::macro('smartNav', function($url, $title, $icon) {
    $class = $url == request()->url() ? 'active' : '';

    $url_string = url('/');
    $url_string = $url_string.'/'.request()->segment(1);
    if($url_string == $url)
    {
        $class = 'active';
    }
    
    //return "<li class=\"$class\"><a href=\"$url\">$title</a></li>";
    return "<a href=\"$url\" class=\"list-group-item $class\"><i class=\"fa fa-lg $icon\"></i>&nbsp;&nbsp; $title</a>";
});