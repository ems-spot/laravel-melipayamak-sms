# laravel-melipayamak-sms


> An unofficial integration of the melipayamak sms library for laravel 5.



## Code Example

    public function toSms($notifiable)
    {
        return (new SMS)
            ->text(__('sms.activation_code', ['code' => $this->activation_code]))
            ->to($notifiable->phone)
            ->sendText();
    }

    public function via($notifiable)
    {
        return ['EmsSpot\Melipayamak\SMS'];
    }

## Installation
    in .env:
    
    MELIPAYAMAK_USERNAME=
    MELIPAYAMAK_PASSWORD=
    MELIPAYAMAK_FROM=
    MELIPAYAMAK_DEBUG=false
    MELIPAYAMAK_DEBUG_RECIPIENT=
    
    in command line:
        
    php artisan vendor:publish --provider="EmsSpot\Melipayamak\MelipayamakServiceProvider"
    
    or if it doesnt work use 
    
    php artisan vendor:publish --force

## License

WTF

