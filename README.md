# Laravel Seo Tools #


[See Demo](https://github.com/benahmetcelik/laravel-seo-tools)

### Installation ###
Add composer.json file :
```php
   "benahmetcelik/laravel-seo-tools": "dev-main",
```
Run The Your Terminal :
```php
  php artisan vendor:publish
```
And 0 press

### Easy to use ###
Only Install and usage :)

### Change Colors ###
Config/seo.php

```php
   'models'=>[
       
    
        'App\Models\News' => [
            'slug_status' => true,
            'title_column' => 'title',
            // Column to be keywords (data in this column will be spaced and combined with (,))
            'keywords_column' => 'title',
            'desc_column' => 'content',
            'robots' => 'max-image-preview:large',
            'locale' => 'tr_TR',
            'type' => 'article',
            'image_status' => true,
            'image_column' => 'image',
            'google_verificaiton_code' => 'google_verificaiton_code',
            'chrome_webstore_item' => 'chrome_webstore_item',
            'yandex_verificaiton_code' => 'yandex_verificaiton_code',
            'facebook_domain_veification_code' => 'facebook_domain_veification_code',
            'facebook_app_id' => 'app_id',
            'facebook_app_pages' => 'pages_id',
            'domain_verify' => 'domain_verify',
            'twitter_card' => 'summary_large_image',
            'publisher' => 'publisher',
            'twitter_username' => 'twitter_username',
            'desc_lenght' => 10,
            'slug_column' => 'slug',
            'last_mod_column' => 'updated_at',
            'changefreq' => 'daily',
            'priority' => 1,
            'route' => 'news'
        ]
    
    ]
```



This is simple. Isn't it?

