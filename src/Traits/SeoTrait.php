<?php

namespace SEO\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;
use SEO\Services\Helper;

trait SeoTrait
{


    public function getSeoTags(){
        echo $this->getSeoTitles().
            $this->getSeoConfigs().
            $this->getSeoDescs().
            $this->getSeoImage().
            $this->getSeoImage().
            $this->getSeoLinks().
            $this->getSeoSocials().
            $this->getSeoVerifications().
            $this->getSeoJson();
    }

    /**
     * @return string
     * Get Seo Title
     */
    public function getSeoTitles()
    {
        if ($this->seo_title == null && array_key_exists(get_class($this), config('seo.models'))) {
                $this->generateSeoTitle();
        }
        return '<title>' . $this->seo_title . '</title>
<meta property="og:title" content="' . $this->seo_title . '" />

<meta name="twitter:title" content="' . $this->seo_title . '"/>

';
    }


    public function getSeoDescs()
    {
        if ($this->seo_desc == null && array_key_exists(get_class($this), config('seo.models'))) {
         self::generateSeoDesc();

        }
        return '<meta name="description" content="' . $this->seo_desc . '" />
                <meta property="og:description" content="' . $this->seo_desc . '" />

<meta name="twitter:description" content="' . $this->seo_desc . '"/>

                ';

    }


    public function getSeoKeywords()
    {
        if ($this->seo_keywords == null && array_key_exists(get_class($this), config('seo.models'))) {
           $this->generateSeoKeywords();
        }
        return '
                
                <meta name="keywords" content="' . $this->seo_keywords . '">
         
                ';

    }


    public function getSeoConfigs()
    {

        return '
        <meta name=\'robots\' content=\'' . config('seo.models')[get_class($this)]['robots'] . '\' />

<meta property="og:locale" content="' . config('seo.models')[get_class($this)]['locale'] . '" />

<meta property="og:type" content="' . config('seo.models')[get_class($this)]['type'] . ' />

<meta name="twitter:card" content="' . config('seo.models')[get_class($this)]['twitter_card'] . '/>

<meta property="og:site_name" content="' . config('app.name') . '" />

        ';
    }

    public function getSeoLinks()
    {

        return '
        <link rel="canonical" href="' . route(config('seo.models')[get_class($this)]['route'], $this->value(config('seo.models')[get_class($this)]['slug_column'])) . '" />
<meta property="og:url" content="' . route(config('seo.models')[get_class($this)]['route'], $this->value(config('seo.models')[get_class($this)]['slug_column'])) . '" />
      
      <meta name="twitter:url" content="' . route(config('seo.models')[get_class($this)]['route'], $this->value(config('seo.models')[get_class($this)]['slug_column'])) . '">
        ';
    }

    public function getSeoSocials()
    {
        return '
       <meta property="article:publisher" content="' . config('seo.models')[get_class($this)]['publisher'] . '" />
<meta name="twitter:site" content="' . config('seo.models')[get_class($this)]['twitter_username'] . '"/> 
<meta property="fb:app_id" content="' . config('seo.models')[get_class($this)]['facebook_app_id'] . '" />
<meta property="fb:pages" content="' . config('seo.models')[get_class($this)]['facebook_app_pages'] . '" />

';

    }


    public function getSeoJson(){
        return '
        <script type="application/ld+json">
{
"@context": "https://schema.org/",
  "@type": "'.config('seo.models')[get_class($this)]['type'].'",
  "name": "'.$this->seo_title.'",
  "description": "'.$this->seo_desc.'",
  "about": {
    "@type": "Event",
    "name": "'.$this->seo_title.'"
  },
  "contentReferenceTime": "'. $this->value(config('seo.models')[get_class($this)]['last_mod_column']) .'"
}
</script>
        ';
    }

    public function getSeoImage()
    {
        if (config('seo.models')[get_class($this)]['image_status']) {
            return '
<meta property="og:image" content="' . $this->value(config('seo.models')[get_class($this)]['image_column']) . '" />
<link rel="image_src" href="' . $this->value(config('seo.models')[get_class($this)]['image_column']) . '" />
';
        }

    }

    public function getSeoVerifications()
    {


        return '
        <meta name="google-site-verification" content="' . config('seo.models')[get_class($this)]['google_verificaiton_code'] . '" />
<link rel="chrome-webstore-item" href="' . config('seo.models')[get_class($this)]['chrome_webstore_item'] . '" />
<meta name=\'yandex-verification\' content=\'' . config('seo.models')[get_class($this)]['yandex_verificaiton_code'] . '\' />
<meta name="facebook-domain-verification" content="' . config('seo.models')[get_class($this)]['facebook_domain_veification_code'] . '" />
<meta name="p:domain_verify" content="' . config('seo.models')[get_class($this)]['domain_verify'] . '" />
        ';
    }


    public function generateSeoKeywords()
    {
        if (!Schema::hasColumn($this->getTable(), 'seo_keywords')) {
            Schema::table($this->getTable(), function (Blueprint $table) {
                $table->string('seo_keywords');
            });
        }
        $this->seo_keywords = Helper::generate_keyword($this->value(config('seo.models')[get_class($this)]['keywords_column']));
        $this->save();
        return $this->seo_keywords;
    }

    public function generateSeoDesc()
    {
        if (!Schema::hasColumn($this->getTable(), 'seo_desc')) {
            Schema::table($this->getTable(), function (Blueprint $table) {
                $table->string('seo_desc');
            });
        }
        $this->seo_desc = Helper::shorten($this->value(config('seo.models')[get_class($this)]['desc_column']), config('seo.models')[get_class($this)]['desc_lenght']);
        $this->save();
        return $this->seo_desc;
    }


    /**
     * @return mixed
     * Generate Seo Title
     */
    public function generateSeoTitle()
    {
        if (!Schema::hasColumn($this->getTable(), 'seo_title')) {
            Schema::table($this->getTable(), function (Blueprint $table) {
                $table->string('seo_title');
            });
        }
        $this->seo_title = $this->value(config('seo.models')[get_class($this)]['title_column']);
        $this->save();
        return $this->seo_title;
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->seo_title = $model->generateSeoTitle();
            $model->seo_desc = $model->generateSeoDesc();
        });
        static::updating(function ($model) {
            if ($model->seo_title == null) {
                $model->seo_title = $model->generateSeoTitle();
            }
            if ($model->seo_desc == null) {
                $model->seo_desc = $model->generateSeoDesc();
            }
        });

    }


}
