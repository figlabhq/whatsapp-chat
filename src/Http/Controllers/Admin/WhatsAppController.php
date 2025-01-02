<?php

declare(strict_types=1);

namespace Figlab\WhatsAppChat\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class WhatsAppController extends Controller
{
    public function edit()
    {
        return view('whatsapp::admin.settings');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'phone_number'    => 'required|regex:/^\d+$/',
            'default_message' => 'required|string',
            'button_style'    => 'required|in:green,white',
            'button_size'     => 'required|in:small,medium,large',
        ]);

        $this->updateEnvironmentFile('WHATSAPP_PHONE_NUMBER', $validated['phone_number']);
        $this->updateEnvironmentFile('WHATSAPP_DEFAULT_MESSAGE', $validated['default_message']);
        $this->updateEnvironmentFile('WHATSAPP_BUTTON_STYLE', $validated['button_style']);
        $this->updateEnvironmentFile('WHATSAPP_BUTTON_SIZE', $validated['button_size']);

        session()->flash('success', trans('whatsapp::app.admin.settings.save_success'));

        return redirect()->back();
    }

    private function updateEnvironmentFile($key, $value)
    {
        $path = base_path('.env');

        if (File::exists($path)) {
            $content = File::get($path);

            // Check if setting exists
            if (strpos($content, $key.'=') !== false) {
                // Replace existing setting
                $content = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}=".$value,
                    $content
                );
            } else {
                // Append new setting
                $content .= "\n{$key}=".$value;
            }

            File::put($path, $content);
        }
    }
}
