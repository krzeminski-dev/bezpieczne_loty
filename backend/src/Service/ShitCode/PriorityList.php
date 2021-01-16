<?php

namespace App\Service\ShitCode;

class PriorityList {
    public $next;
    public $data;
    function __construct($data) {
        $this->next = null;
        $this->data = $data;
    }
}