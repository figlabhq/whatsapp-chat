<?php

declare(strict_types=1);

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class SetupWhatsAppChat extends Command
{
    protected $signature = 'whatsapp:setup';

    protected $description = 'Setup WhatsApp chat configuration';

    public function handle()
    {
        $this->info('WhatsApp Chat Setup');
        $this->line('----------------');

        // Get phone number
        $phone = $this->ask('What is your WhatsApp phone number? (Include country code, no spaces or special characters)');

        // Validate phone number
        while (! preg_match('/^\d+$/', $phone)) {
            $this->error('Invalid phone number format. Please enter only numbers including country code.');
            $phone = $this->ask('What is your WhatsApp phone number?');
        }

        // Get default message
        $message = $this->ask('What should be the default message? (Press enter for default)',
            'Hello! I have a question about your products.');

        // Update .env file
        $this->updateEnvironmentFile('WHATSAPP_PHONE_NUMBER', $phone);
        $this->updateEnvironmentFile('WHATSAPP_DEFAULT_MESSAGE', $message);

        $this->info('WhatsApp chat configured successfully!');
        $this->line('Phone Number: '.$phone);
        $this->line('Default Message: '.$message);
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
