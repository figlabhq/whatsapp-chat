# WhatsApp Chat for Bagisto

WhatsApp chat integration package for Bagisto e-commerce platform. This package adds a floating WhatsApp chat button to your Bagisto store, allowing customers to easily contact you via WhatsApp.

## Features

- Floating WhatsApp chat button
- Customizable button style (green/white)
- Adjustable button size (small/medium/large)
- Configurable default message
- Admin panel integration
- Easy setup via command line
- Responsive design

## Requirements

- PHP ^7.4|^8.0|^8.2
- Bagisto ^2.2

## Installation

1. Install the package via Composer:
```bash
composer require figlab/whatsapp-chat
```
2. Publish the package assets:
```bash
php artisan vendor:publish --provider="Figlab\WhatsAppChat\Providers\WhatsAppChatServiceProvider"
```

## Configuration
1. Run the setup command
```bash
php artisan whatsapp:setup
```
This command will prompt you for:
- WhatsApp phone number (with country code)
- Default message
2. Via Admin Panel
- Log into your Bagisto admin panel
- Navigate to Configure → WhatsApp Chat Settings
- Configure the following settings:

  - WhatsApp Phone Number
  - Default Message
  - Button Style (green/white)
  - Button Size (small/medium/large)


- Click 'Save' to update settings
