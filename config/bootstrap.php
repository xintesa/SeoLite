<?php
use \Cake\Core\Configure;
use \Croogo\Core\Croogo;
use \Cake\Cache\Cache;
use \Croogo\Core\Nav;

$cacheConfig = array_merge(Configure::read('Croogo.Cache.defaultConfig'), ['groups' => ['seo_lite']]);
Cache::config('seo_lite', $cacheConfig);

Configure::write('Seolite.keys', [
    'meta_keywords' => [
        'label' => __d('seolite', 'Keywords'),
    ],
    'meta_description' => [
        'label' => __d('seolite', 'Description'),
    ],
    'rel_canonical' => [
        'label' => __d('seolite', 'Canonical Page'),
    ],
]);

Croogo::hookHelper('*', 'Seolite.SeoLite');

$queryString = env('REQUEST_URI');
if (strpos($queryString, 'admin') === false) {
    return;
}

/*
 * stuff for /admin routes only
 */

Croogo::hookBehavior('Croogo/Nodes.Nodes', 'Seolite.CustomFields', [
    'priority' => 1,
]);

$title = 'SeoLite';
$element = 'Seolite.admin/meta';
$options = [
    'elementData' => [
        'field' => 'body',
    ],
];
Croogo::hookAdminTab('Admin/Nodes/add', $title, $element, $options);
Croogo::hookAdminTab('Admin/Nodes/edit', $title, $element, $options);
$options['elementData']['field'] = 'description';
Croogo::hookAdminTab('Admin/SeoLiteUrls/add', $title, $element, $options);
Croogo::hookAdminTab('Admin/SeoLiteUrls/edit', $title, $element, $options);

Nav::add('sidebar', 'seo_lite', [
    'title' => 'SeoLite',
    'url' => 'javascript:void(0)',
    'children' => [
        'urls' => [
            'title' => __d('seo_lite', 'Meta by URL'),
            'url' => [
                'admin' => true,
                'plugin' => 'Seolite',
                'controller' => 'Urls',
                'action' => 'index',
            ],
        ],
    ],
]);
