<?php

namespace Modules\Opx\Variables\Controllers;

use Core\Foundation\Templater\Templater;
use Core\Http\Controllers\APIFormController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Opx\Variables\OpxVariables;

class ManageVariablesApiController extends APIFormController
{
    public $caption = 'opx_variables::manage.variables';
    public $save = 'manage/api/module/opx_variables/variables/save';

    public function getIndex(): JsonResponse
    {
        $template = new Templater(OpxVariables::getTemplateFileName('variables'));
        $template->fillDefaults();
        $vars = $this->getVars();
        $template->setValues(['variables' => $vars]);
        return $this->responseFormComponent(null, $template, $this->caption, $this->save);
    }

    public function postSave(Request $request): JsonResponse
    {
        $vars = $request->input('variables');
        $this->storeVars($vars);
        $template = new Templater(OpxVariables::getTemplateFileName('variables'));
        $template->fillDefaults();
        $vars = $this->getVars();
        $template->setValues(['variables' => $vars]);
        return $this->responseFormComponent(null, $template, $this->caption, $this->save);
    }

    /**
     * Load values array.
     *
     * @return  array
     */
    protected function getVars(): array
    {
        $path = app()->storagePath() . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'variables';

        if (!file_exists($path)) {
            return [];
        }

        $serialized = file_get_contents($path);

        if ($serialized === null || $serialized === false) {
            return [];
        }

        $vars = unserialize($serialized, ['allowed_classes' => false]);

        $array = [];

        if (!empty($vars)) {
            foreach ($vars as $key => $value) {
                $array[] = ['key' => $key, 'value' => $value];
            }
        }

        return $array;
    }

    /**
     * Store values array.
     *
     * @param array $vars
     *
     * @return  void
     */
    protected function storeVars(array $vars): void
    {
        $path = app()->storagePath() . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'variables';

        $array = [];

        if (!empty($vars)) {
            foreach ($vars as $var) {
                $array[$var['key']] = $var['value'];
            }
        }

        file_put_contents($path, serialize($array));
    }
}