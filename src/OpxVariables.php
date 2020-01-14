<?php

namespace Modules\Opx\Variables;

use Illuminate\Support\Facades\Facade;

/**
 * @method  static string getTemplateFileName(string $name)
 * @method  static mixed get(string $name)
 */
class OpxVariables extends Facade
{
    /**
     * Get the registered name of the component.
     *
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'opx_variables';
    }
}
