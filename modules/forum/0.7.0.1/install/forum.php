<?php
/**
 * Конфигурационный файл модуля
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.forum.install
 * @since 0.1
 *
 */
return array(
    'module'   => array(
        'class' => 'application.modules.forum.ForumModule',
    ),
    'import'    => array(
        'application.modules.forum.models.*',
    ),
    'component' => array(),
    'rules'     => array(
        '/forums/'        => '/forum/forum/index',
        '/forums/<alias>' => '/forum/forum/show',
        '/topics/<alias>' => '/forum/topic/show',
    ),
);