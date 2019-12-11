<?php

namespace App\Http\Dto;

class BaseDto
{
    public function load(array $args)
    {
        foreach ($args as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }
}