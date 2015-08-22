<?php namespace Iserter\Transunion\Facades;

use Illuminate\Support\Facades\Facade;

class Transunion extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Iserter\Transunion\Contracts\TransunionServiceInterface';
    }
}