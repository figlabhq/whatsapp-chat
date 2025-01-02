<div class="whatsapp-chat-widget {{ config('whatsapp-chat.button_size') }}">
    <a
        aria-label="Chat on WhatsApp"
        href="https://wa.me/{{ config('whatsapp-chat.phone_number') }}?text={{ urlencode(config('whatsapp-chat.default_message')) }}"
        target="_blank"
        rel="noopener noreferrer"
        class="whatsapp-button"
    >
        <img
            alt="Chat on WhatsApp"
            src="{{ asset('vendor/whatsapp-chat/WhatsAppButton' . ucfirst(config('whatsapp-chat.button_style')) . ucfirst(config('whatsapp-chat.button_size')) . '.svg') }}"
        />
    </a>
</div>
