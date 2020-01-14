<?php

namespace Modules\Opx\Variables;

use Core\Foundation\Module\BaseModule;
use Modules\Opx\Slideshow\Models\Slide;

class Variables extends BaseModule
{
    /** @var string  Module name */
    protected $name = 'opx_variables';

    /** @var string  Module path */
    protected $path = __DIR__;

    /** @var array|null */
    protected $vars;

    /**
     * Load variables.
     *
     * @return  void
     */
    protected function loadVars(): void
    {
        $path = $this->app->storagePath() . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'variables';

        $serialized = file_get_contents($path);

        if ($serialized === null || $serialized === false) {
            $this->vars = [];
            return;
        }

        $vars = unserialize($serialized, ['allowed_classes' => false]);

        if (empty($vars)) {
            $this->vars = [];
            return;
        }

        $this->vars = $vars;
    }

    /**
     * Get variable value by name.
     *
     * @param string $name
     *
     * @return mixed|null
     */
    public function get(string $name)
    {
        if (!isset($this->vars)) {
            $this->loadVars();
        }

        return $this->vars[$name] ?? null;
    }
}
