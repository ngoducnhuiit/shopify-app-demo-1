<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfiniteScroll;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class InfiniteScrollController extends Controller
{
    public function index()
    {
        $shop = Auth::user();
        $shop_domain = $shop->name;
        $themes = $shop->api()->rest('GET', '/admin/themes.json');
        $themeId = "";
        $allThemeId = "";
        foreach($themes['body']->container['themes'] as $theme){
            if($theme['role'] == "main") $themeId = $theme['id'] ;
            $allThemeId .= $theme['id'].' ';
        }
        $infiniteScroll = InfiniteScroll::where('shop_domain', '=', $shop_domain)->pluck('config')->first();
        if(empty($infiniteScroll)){
            $infiniteScroll = '';
        }else{
            $infiniteScroll = json_decode($infiniteScroll);
            $infiniteScrollConfig = [];
            foreach($infiniteScroll as $key => $item){
                if($key == $themeId) $infiniteScrollConfig = $item ;
            }
            $infiniteScroll = json_decode(json_encode($infiniteScrollConfig), true);

            $infinitiScrollConfig = "";
            $infinitiScrollConfig .= "<script class=\"json-config-infinite\" type=\"application/json\" id=\"magepow_config_scroll_laravel_app\">{";
            $infinitiScrollConfig .= '"enabled": '.$infiniteScrollConfig->enabled.',';
            $infinitiScrollConfig .= '"itemLoad": "'.$infiniteScrollConfig->itemLoad.'",';
            $infinitiScrollConfig .= '"delay": "'.$infiniteScrollConfig->delay.'",';
            $infinitiScrollConfig .= '"container": "'.$infiniteScrollConfig->container.'",';
            $infinitiScrollConfig .= '"pagination": "'.$infiniteScrollConfig->pagination.'",';
            $infinitiScrollConfig .= '"nextPagination": "'.$infiniteScrollConfig->nextPagination.'",';
            $infinitiScrollConfig .= '"loadingText": "'.$infiniteScrollConfig->loadingText.'",';
            $infinitiScrollConfig .= '"doneText": "'.$infiniteScrollConfig->doneText.'",';
            $infinitiScrollConfig .= '"image": "{{ "'.$infiniteScrollConfig->image.'" | asset_url }}",';
            $infinitiScrollConfig .= '"loadMoreButtonText": "'.$infiniteScrollConfig->loadMoreButtonText.'",';
            $infinitiScrollConfig .= '"offset": '.$infiniteScrollConfig->offset;
            $infinitiScrollConfig .= "}</script>";
            // Data to pass to our rest api request
            $infiniteScrollLiquid = file_get_contents(public_path('shopify-liquid/infinite-scroll-config.liquid'), true);
            $array = array('asset' => array('key' => 'snippets/infinite-scroll-config.liquid', 'value' => "{% if request.page_type == 'collection' %}".$infinitiScrollConfig.$infiniteScrollLiquid."{% endif %}"));
            $shop->api()->rest('PUT', '/admin/themes/'.$themeId.'/assets.json', $array);

            //Add image
            $image = file_get_contents(public_path('tmp/uploads/'.$infiniteScrollConfig->image), true);
            $imageArray = array('asset' => array('key' => 'assets/'.$infiniteScrollConfig->image, 'attachment' =>  base64_encode($image)));
            $shop->api()->rest('PUT', '/admin/themes/'.$themeId.'/assets.json', $imageArray);

            //add file plugin js
            $infiniteScrollJs = file_get_contents(public_path('js/plugin/infinite-scroll.js'), true);
            $scrollJs = array('asset' => array('key' => 'assets/infinite-scroll.js', 'value' => $infiniteScrollJs));
            $shop->api()->rest('PUT', '/admin/themes/'.$themeId.'/assets.json', $scrollJs);

            //data to pass theme.liquid - dữ liệu để vượt qua theme.liquid
            $theme_array = $shop->api()->rest('GET', '/admin/themes/'.$themeId.'/assets.json', array('asset'=>array('key'=>'layout/theme.liquid')));
            $themeValue = "";
            foreach($theme_array['body']['container'] as $theme){
                $themeValue = $theme['value'];
            }

            //include file to theme
            $scrollTheme = "{% include 'infinite-scroll-config' %}";
            if(!empty($themeValue)) {
                if(!strstr($themeValue, $scrollTheme)) {
                    $themeValue = str_replace('</head>', $scrollTheme.'</head>', $themeValue);
                    $shop->api()->rest('PUT', '/admin/themes/'.$themeId.'/assets.json', array('asset'=>array('key'=>'layout/theme.liquid','value'=> $themeValue)));
                }
            }
        }
        return view('infinite-scroll-config',['infiniteScroll' => $infiniteScroll, 'shop_id' => ['shop_domain' => $shop_domain, 'theme_id'=> $themeId, 'all_theme_id' =>  $allThemeId ]]);
    }

    public function store(Request $request)
    {
        if(is_null($request->config_update)){
            $this->image = '';
            if($request->file('image')){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $path = public_path('tmp/uploads');
                if ( ! file_exists($path) ) {
                    mkdir($path, 0777, true);
                }
                $file = $request->file('image');
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $this->image = $fileName;
                $file->move($path, $fileName);
            }
            $infiniteScroll = new InfiniteScroll;
            $infiniteScroll->shop_domain = $request->shop_domain;
            $config = [];
            $allThemeId = rtrim($request->all_theme_id, ',');
            $allThemeId = explode(" ",$allThemeId);
            if($request->apply_all_theme){
                foreach($allThemeId as $key => $theme_id){
                    $config[$theme_id] = $request->all();
                    $this->image ? $config[$theme_id]['image'] =  $this->image : '';
                    foreach($this->unsetDataArray() as $key => $value){
                        unset($config[$theme_id][$value]);
                    }
                }
            }
            $infiniteScroll->config = json_encode($config);
            $infiniteScroll->save();

        }else{
            $this->update($request);
        }
        return redirect('/infinitiscroll');
    }

    public function unsetDataArray()
    {
        return array('all_theme_id', 'apply_all_theme', '_token', 'shop_domain', 'config_id', 'theme_id', 'config_update');
    }

    public function update(Request $request){
        $infiniteScroll =  InfiniteScroll::where('shop_domain', '=', $request->shop_domain);
        // Add array config
        $config = [];
        $theme_id = $request->theme_id;
        $infiniteScrollGet = $infiniteScroll->first();
        $config = json_decode($infiniteScrollGet->config);
        // Additional image processing
        $this->image = '';
        if($request->file('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $path = public_path('tmp/uploads');

            if(! file_exists($path) ) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('image');
            $this->image = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $this->image);
        }else{
            $this->image = $config->$theme_id->image;
        }
        $config->$theme_id =  $request->all();
        $config->$theme_id['image'] = $this->image;
        foreach($this->unsetDataArray() as $key => $value){
            unset($config->$theme_id[$value]);
        }
        //update Config
        $infiniteScroll->update([
            'config' => json_encode($config),
        ]);
    }


    public function destroy(){
        $shop = Auth::user();
        $shop_domain = $shop->name;
        $themes = $shop->api()->rest('GET', '/admin/themes.json');
        $infiniteScroll = InfiniteScroll::where('shop_domain', '=', $shop_domain)->first();
        $themeId = "";
        foreach($themes['body']->container['themes'] as $theme){
            if($theme['role'] == "main") $themeId = $theme['id'] ;
        }
        $infiniteScroll = InfiniteScroll::where('shop_domain', '=', $shop_domain)->first();
        $scrollJs = array('asset' => array('key' => 'assets/infinite-scroll.js'));
        $shop->api()->rest('delete', '/admin/themes/'.$themeId.'/assets.json', $scrollJs);

        $infiniteLiquid = array('asset' => array('key' => 'snippets/infinite-scroll-config.liquid'));
        $shop->api()->rest('delete', '/admin/themes/'.$themeId.'/assets.json', $infiniteLiquid);

        $theme_array = $shop->api()->rest('GET', '/admin/themes/'.$themeId.'/assets.json', array('asset'=>array('key'=>'layout/theme.liquid')));
        $themeValue = "";
        foreach($theme_array['body']['container'] as $theme){
            $themeValue = $theme['value'];
        }
        $scrollTheme = "{% include 'infinite-scroll-config' %}";
        if(!empty($themeValue)) {
            if(strstr($themeValue, $scrollTheme)) {
                $themeValue = str_replace($scrollTheme, '', $themeValue);
                $shop->api()->rest('PUT', '/admin/themes/'.$themeId.'/assets.json', array('asset'=>array('key'=>'layout/theme.liquid','value'=> $themeValue)));
            }
        }
        $infiniteScroll->delete();

        return  redirect('infinitiscroll');
    }

}
