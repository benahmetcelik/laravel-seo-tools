<?php

namespace SEO\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SiteMapController
{
    public function index($model = '')
    {
        if (strlen($model) > 1) {
            if (in_array($model,array_column( config('seo.models'), 'route'))) {
                return $this->thisModel($this->searchModel($model));
            }
        } else {
            return $this->allModels();
        }
    }

    private function searchModel($route){
        $models = config('seo.models');
        foreach ($models as $key=>$value){
           if ($value['route']== $route){
               return $key;
           }
        }
        return redirect()->back();
    }

    public function allModels()
    {
        $models = config('seo.models');
        $maps = array();
        foreach ($models as $key => $value) {
            $new_model = $key::latest()->first()->toArray();
            array_push($maps, array(
                'url' => route('sitemap::sitemap.index',config('seo.models')[$key]['route']),
                'lastmod' => $new_model[$value['last_mod_column']],
                'changefreq'=>config('seo.models')[$key]['changefreq'],
                'priority'=>config('seo.models')[$key]['priority']
            ));
        }
        return Response::make(view('seo::layouts.app',compact('maps')), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }

    public function thisModel($model)
    {
        $datas = $model::orderBy('id','DESC')->get();
        $value = config('seo.models')[$model];
        $maps = array();
        foreach ($datas as $data) {
            $data = $data->toArray();
            array_push($maps, array(
                'url' => route($value['route'],$data[$value['slug_column']]),
                'lastmod' => $data[$value['last_mod_column']],
                'changefreq'=>$value['changefreq'],
                'priority'=>$value['priority']
            ));
        }
        return Response::make(view('seo::layouts.app',compact('maps')), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }

}