<?php

namespace App\Utils;

class Feedback
{
    public $author;
    public $content;

    public function __construct($_author, $_content)
    {
        $this->author = $_author;
        $this->content = $_content;
    }
}

?>