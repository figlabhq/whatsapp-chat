<?php

declare(strict_types=1);

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
}
