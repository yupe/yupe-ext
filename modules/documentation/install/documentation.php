<?php
return array(
    'module'   => array(
        'class'           => 'application.modules.documentation.DocumentationModule',
    ),
    'import'    => array(
        'application.modules.documentation.models.*',
    ),
    'rules'     => array(
        '/documentation/<action:\w+>' => 'documentation/<action>',
    ),
);