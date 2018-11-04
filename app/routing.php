<?php
// routing.php
$routes = [
    'Item' => [ // Controller
        ['index', '/', 'GET'], // action, url, HTTP method
        ['delete', '/item/delete', ['POST']],
        ['add', '/item/add', ['GET', 'POST']],
        ['show', '/item/{id}', 'GET'], // action, url, HTTP method
        ['edit', '/item/edit/{id}', ['GET', 'POST']],
    ],
    'Category' => [ // Controller
        ['index', '/categories', 'GET'], // action, url, HTTP method
        ['show', '/category/{id}', 'GET'], // action, url, HTTP method
    ],
];