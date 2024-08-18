<?php

use Myblog\Router;

Router::add('^album/like', ['controller' => 'Album', 'action' => 'like']);
Router::add('^album/add-comment', ['controller' => 'Album', 'action' => 'add-comment']);
Router::add('^album/add-img', ['controller' => 'Album', 'action' => 'add-img']);
Router::add('^album/edit-album-img', ['controller' => 'Album', 'action' => 'edit-album-img']);
Router::add('^album/edit-album', ['controller' => 'Album', 'action' => 'edit-album']);
Router::add('^album/add', ['controller' => 'Album', 'action' => 'add']);
Router::add('^album/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Album', 'action' => 'view']);
Router::add('^album/?$', ['controller' => 'Album', 'action' => 'index']);

// default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');