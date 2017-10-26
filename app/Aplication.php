<?php

namespace App;

use App\Http\Kernel;

class Aplication extends Kernel
{
    protected $configs;

    public function __construct(array $configs = array())
    {
        parent::__construct();
        $this->configs = $configs;
    }

    public function setConfig($key, $value)
    {
        $this->configs[$key] = $value;
    }

    public function getConfig($key)
    {
        if (array_key_exists($key, $key->configs)) {
            return $this->configs[$key];
        }

        return null;
    }
}
