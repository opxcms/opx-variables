<?php

namespace Modules\Shop\Items\Templates;

use Core\Foundation\Template\Template;

/**
 * HELP:
 *
 * ID parameter is shorthand for defining module and field name separated by `::`.
 * [$module, $name] = explode('::', $id, 2);
 * $captionKey = "{$module}::template.section_{$name}";
 *
 * PLACEMENT is shorthand for section and group of field separated by `/`.
 * [$section, $group] = explode('/', $placement);
 *
 * PERMISSIONS is shorthand for read permission and write permission separated by `|`.
 * [$readPermission, $writePermission] = explode('|', $permissions, 2);
 */

return [
    'sections' => [
    ],
    'groups' => [
    ],
    'fields' => [
        Template::keyValue('opx_variables::variables', '', [], ['key' => 'opx_variables::template.key', 'value' => 'opx_variables::template.value']),
    ],
];
