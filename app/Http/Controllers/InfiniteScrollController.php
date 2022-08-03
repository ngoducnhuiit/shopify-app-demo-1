<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfiniteScroll;
use Illuminate\Support\Facades\Auth;

class InfiniteScrollController extends Controller
{

    public function index()
    {
        $shop = Auth::user();
        $shop_id = $shop->name;
        $themes = $shop->api()->rest('GET', '/admin/themes.json');
        $themId = "";
        foreach($themes['body']->container['themes'] as $theme){
            if($theme['role'] == "main") $themId = $theme['id'] ;
        }
        $infiniteScroll = InfiniteScroll::where('shop_id', '=', $shop_id)->first();

        if(empty($infiniteScroll)){
            $infiniteScroll = '';
        }else{
            $this->edit($infiniteScroll['id']);
            $infinitiScrollConfig = "";
            $infinitiScrollConfig .= "<script class=\"json-config-infinite\" type=\"application/json\" id=\"magepow_config_scroll_laravel_app\">{";
            $infinitiScrollConfig .= '"enabled": '.$infiniteScroll->enabled.',';
            $infinitiScrollConfig .= '"itemLoad": "'.$infiniteScroll->itemLoad.'",';
            $infinitiScrollConfig .= '"delay": "'.$infiniteScroll->delay.'",';
            $infinitiScrollConfig .= '"container": "'.$infiniteScroll->container.'",';
            $infinitiScrollConfig .= '"pagination": "'.$infiniteScroll->pagination.'",';
            $infinitiScrollConfig .= '"nextPagination": "'.$infiniteScroll->nextPagination.'",';
            $infinitiScrollConfig .= '"loadingText": "'.$infiniteScroll->loadingText.'",';
            $infinitiScrollConfig .= '"doneText": "'.$infiniteScroll->doneText.'",';
            $infinitiScrollConfig .= '"image": "{{'.$infiniteScroll->image.'| asset_url}}",';
            $infinitiScrollConfig .= '"loadMoreButtonText": "'.$infiniteScroll->loadMoreButtonText.'"';
            $infinitiScrollConfig .= "}</script>";
        // Data to pass to our rest api request - Dữ liệu để chuyển đến yêu cầu api còn lại của chúng tôi
            $infiniteScrollLiquid = file_get_contents(public_path('shopify-liquid/infiniti-scroll-config.liquid'), true);
            $array = array('asset' => array('key' => 'snippets/infiniti-scroll-config.liquid', 'value' => $infinitiScrollConfig.$infiniteScrollLiquid));
            $shop->api()->rest('PUT', '/admin/themes/'.$themId.'/assets.json', $array);

            $image = file_get_contents(public_path('tmp/uploads/'.$infiniteScroll->image), true);
            $imageArray = array('asset' => array('key' => 'assets/'.$infiniteScroll->image, 'attachment' =>  base64_encode($image)));
            $shop->api()->rest('PUT', '/admin/themes/'.$themId.'/assets.json', $imageArray);

            $infiniteScrollJs = file_get_contents(public_path('js/plugin/infinite-scroll.js'), true);
            $scrollJs = array('asset' => array('key' => 'assets/infinite-scroll.js', 'value' => $infiniteScrollJs));
            $shop->api()->rest('PUT', '/admin/themes/'.$themId.'/assets.json', $scrollJs);
        }

        //data to pass theme.liquid - dữ liệu để vượt qua theme.liquid
        $theme_array = $shop->api()->rest('GET', '/admin/themes/'.$themId.'/assets.json', array('asset'=>array('key'=>'layout/theme.liquid')));
        $themeValue = "";
        foreach($theme_array['body']['container'] as $theme){
            $themeValue = $theme['value'];
        }
        //include file to theme-bao gồm tệp vào chủ đề

        $scrollTheme = "{% include 'infiniti-scroll-config' %}";
        if(!empty($themeValue)) {
            if(!strstr($themeValue, $scrollTheme)) {
                $themeValue = str_replace('</head>', $scrollTheme.'</head>', $themeValue);
                $shop->api()->rest('PUT', '/admin/themes/'.$themId.'/assets.json', array('asset'=>array('key'=>'layout/theme.liquid','value'=> $themeValue)));
            }
        }

        return view('infinite-scroll-config',['infiniteScroll' => $infiniteScroll, 'shop_id' => ['shop_name' => $shop_id, 'theme_id'=> $themId]]);
    }

    public function store(Request $request)
    {

        if(is_null($request->config_id)){
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
            $infiniteScroll->enabled = $request->enabled;
            $infiniteScroll->shop_id = $request->shop_id;
            $infiniteScroll->theme_id = $request->theme_id;
            $infiniteScroll->delay = $request->delay;
            $infiniteScroll->container = $request->container;
            $infiniteScroll->itemLoad = $request->itemLoad;
            $infiniteScroll->pagination = $request->pagination;
            $infiniteScroll->nextPagination = $request->nextPagination;
            $infiniteScroll->loadingText = $request->loadingText;
            $infiniteScroll->image = $this->image;
            $infiniteScroll->doneText = $request->doneText;
            $infiniteScroll->loadMoreButtonText = $request->loadMoreButtonText;
            $infiniteScroll->save();

        }else{
            $this->update($request);
        }
        return redirect('/infinitiscroll')->with('status', 'Blog Post Form Data Has Been inserted');
    }


    public function edit($id){
        $infiniteScroll =  InfiniteScroll::where('id', '=', $id)->first();
        return view('edit', ['infiniteScroll' => $infiniteScroll]);
    }

    public function update(Request $request){
        $infiniteScroll =  InfiniteScroll::where('id', '=', $request->config_id);
        if($request->file('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $path = public_path('tmp/uploads');

            if ( ! file_exists($path) ) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('image');
            $this->image = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $this->image);
            $infiniteScroll->update(['image' => $this->image ]);
        }

        $infiniteScroll->update([
            'enabled' => $request->enabled,
            'delay' => $request->delay,
            'container' => $request->container,
            'itemLoad' => $request->itemLoad,
            'pagination' => $request->pagination,
            'nextPagination' => $request->nextPagination,
            'loadingText' => $request->loadingText,
            'doneText' => $request->doneText,
            'loadMoreButtonText' => $request->loadMoreButtonText,
        ]);
    }

}
