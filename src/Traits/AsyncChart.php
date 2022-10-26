<?php

namespace Ajtarragona\Charts\Traits;
use Illuminate\Support\Str;


trait AsyncChart{

    // protected $async=true;
    // public $refresh_rate=false; //seconds
    
    abstract public function reload();
}   