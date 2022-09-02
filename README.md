# Laravel Seo Tools #


[See Demo](https://github.com/benahmetcelik/laravel-seo-tools)

### Installation ###
Add composer.json file :
```php
   "benahmetcelik/laravel-seo-tools": "dev-main",
```


### Easy to use ###
Only Install and usage :)

### Change Colors ###
Config/seo.php

```php
   'models'=>[
       
        'App\Models\News'=>[
            'slug_status'=>true,
            'slug_column'=>'slug',
            'last_mod_column'=>'updated_at',
            'changefreq'=>'daily',
            'priority'=>1,
            'route'=>'news'
        ],
        'App\Models\Page'=>[
            'slug_status'=>true,
            'slug_column'=>'slug',
            'last_mod_column'=>'updated_at',
            'changefreq'=>'daily',
            'priority'=>1,
            'route'=>'page'
        ]
    
    ]
```



This is simple. Isn't it?

