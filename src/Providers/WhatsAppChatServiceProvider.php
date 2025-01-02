<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

final class WhatsAppChatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register views
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'whatsapp');

        // Publish assets
        $this->publishes([
            __DIR__.'/../Resources/assets/css' => public_path('vendor/figlab/whatsapp-chat/css'),
        ], 'public');

        // Add view composer to inject the button into the layout
        \View::composer('shop::layouts.master', function ($view) {
            if (! $view->exists('whatsapp::shop.whatsapp-button')) {
                return;
            }

            $content = $view->getData()['content'] ?? '';
            $whatsappButton = view('whatsapp::shop.whatsapp-button')->render();

            // Append WhatsApp button to content
            $content .= $whatsappButton;
            $view->with('content', $content);
        });

        // Add assets to layout
        \View::composer('shop::layouts.master', function ($view) {
            $view->with('whatsappCss', true);
        });

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupWhatsAppChat::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/../Routes/admin-routes.php');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'whatsapp');

        // Add menu item
        $this->app->booted(function () {
            Event::listen('bagisto.admin.layout.head', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('whatsapp::admin.layouts.style');
            });

            $this->createAdminMenuOption();
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/whatsapp-chat.php', 'whatsapp-chat'
        );

        // Add this in your boot method
        $this->app->booted(function () {
            $this->app['view']->prependNamespace('shop', [
                __DIR__.'/../Resources/views/shop',
            ]);
        });
    }

    protected function createAdminMenuOption()
    {
        Event::listen('core.configuration.before', function ($config) {
            $config->addItem([
                'key'   => 'whatsapp',
                'name'  => 'whatsapp::app.admin.settings.title',
                'sort'  => 45,
                'icon'  => 'icon-whatsapp',
                'route' => 'admin.whatsapp.settings',
            ]);
        });
    }
}
