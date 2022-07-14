<?php

namespace NeeZiaa\Router;

use NeeZiaa\Router\Router;

class Routes {

    /**
     * @throws RouterException
     */
    public function routes(): void
    {
        $router = new Router($_SERVER['REQUEST_URI']);

        // Public

        $router->get('/', 'home@index', 'home');

            // News

        $router->get('/news', 'news@index', 'news');
        $router->get('/news/:id', 'news@article', 'news_article');

            // Autres

        $router->get('/rules', 'home@rules', 'rules');
        $router->get('/contact', 'home@contact', 'contact');
        $router->get('/settings', 'home@settings', 'settings');
        $router->get('/about', 'home@about', 'about');

            // Content

        $router->get('/exclusive-content', 'content@index', 'exclusive-content');
        $router->get('/exclusive-content/:id', 'content@item', 'exclusive-content_item');

            // Team

        $router->get('/team', 'home@team', 'team');


        // Admin

        $router->get('/admin', 'admin/home@index', 'admin_home');

            // Login

        $router->get('/admin/login', 'admin/login@index', 'admin_login');
        $router->post('/admin/login', 'admin/login@auth', 'admin_login_auth');

            // Settings

        $router->get('/admin/settings', 'admin/settings@index', 'admin_settings');
        $router->get('/admin/rules', 'admin/settings@rules', 'admin_settings_rules');
        $router->get('/admin/about', 'admin/settings@about', 'admin_settings_about');
        $router->post('/admin/settings', 'admin/settings@edit', 'admin_settings_edit');

            // Team

        $router->get('/admin/team', 'admin/team@index', 'admin_team');
        $router->get('/admin/team/create', 'admin/team@create', 'admin_team_create');
        $router->get('/admin/team/edit/:id', 'admin/team@edit', 'admin_team_edit');

            // Post

        $router->post('/admin/team/create', 'admin/team@create', 'admin_team_create_post');
        $router->post('/admin/team/edit', 'admin/team@edit', 'admin_team_edit_post');
        $router->post('/admin/team/delete/:id', 'admin/team@index', 'admin_team_delete_post');


            // Admin - News

        $router->get('/admin/news', 'admin/news@index', 'admin_news');
        $router->get('/admin/news/create', 'admin/news@create', 'admin_news_create');
        $router->get('/admin/news/edit', 'admin/news@edit', 'admin_news_edit');

            // Post

        $router->post('/admin/news/create', 'admin/news@create', 'admin_news_create');
        $router->post('/admin/news/edit', 'admin/news@edit', 'admin_news_edit');
        $router->post('/admin/news/delete', 'admin/news@delete', 'admin_news_delete');

        $router->run();
    }
}

