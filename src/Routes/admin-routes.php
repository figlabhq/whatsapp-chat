<?php

use Illuminate\Routing\Route;

Route::group([
    'prefix'     => 'admin/whatsapp',
    'middleware' => ['web', 'admin'],
], function () {
    Route::get('settings', 'Figlab\WhatsAppChat\Http\Controllers\Admin\WhatsAppController@edit')->name('admin.whatsapp.settings');
    Route::post('settings', 'Figlab\WhatsAppChat\Http\Controllers\Admin\WhatsAppController@update')->name('admin.whatsapp.settings.update');
});
