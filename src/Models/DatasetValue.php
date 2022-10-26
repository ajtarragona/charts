<?php

namespace Ajtarragona\Charts\Models;

use Ajtarragona\Charts\Traits\WithDotOptions;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class DatasetValue
{   
    public $label;
    public $data;
    use WithDotOptions;
    

    /**
     * Class constructor.
     */
    public function __construct($label, $data, $options=[])
    {
        $this->label = $label;
        $this->data = $data;
        $this->options = $options;

        $this->prepareOptions();
    }
}
