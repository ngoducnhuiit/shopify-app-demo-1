<form id="infinite-scroll-form" class="form-scroll" method="post" action="{{ url('infinitiscroll') }}"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="config_id" name="config_update" value="update">
    <input type="hidden" class="theme_id" name="theme_id" value="{{ $shop_id['theme_id'] }}">
    <input type="hidden" class="theme_id" name="shop_domain" value="{{ $shop_id['shop_domain'] }}">
    <input type="hidden" class="all_theme_id" name="all_theme_id" value="{{ $shop_id['all_theme_id'] }}">
    <input type="hidden" class="apply_all_theme" id="apply_all_theme"  name="apply_all_theme" value="0">
    <div class="form-row">
        <div class="form-group field col-md-6">
            <label for="input-enable"><?php echo __('infinite_scroll_config.config.enabled') ?></label>
            <input type="checkbox" class="form-control" name="enabled" @if ($infiniteScroll['enabled']) checked @endif />

        </div>
        <div class="form-group field col-md-6">
            <label for="delay"><?php echo __('infinite_scroll_config.config.delay') ?></label>
            <input type="text" class="form-control" id="delay" name="delay" value="{{ $infiniteScroll['delay'] }}">
        </div>
    </div>
'config' => [
        'enabled'               =>  'Enabled',
        'delay'                 =>  'Delay (ms)',
        'container'             =>  'Container',
        'item'                  =>  'Item',
        'pagination'            =>  'Pagination',
        'nextPagination'        =>  'Next Pagination',
        'offset'                =>  'Offset',
        'doneText'              =>  'Done Text',
        'loadingImage'          =>  'Loading Image placeholder:',
        'loadMoreBtn'           =>  'Load More button text',
        'borderSizeBtn'         =>  'Border Size Button',
        'borderRadius'          =>  'Border Radius Button',
        'fontSize'              =>  'Font Size',
        'borderColorBtn'        =>  'Border Color',
        'backgroundLoadmore'    =>  'Background Button Loadmore',
        'fontColor'             =>  'Font Color',
        'saveBtn'               =>  'Save Config',
        'saveBtnNewConfig'      =>  'Update New Config'

    ],
    <div class="form-row">
        <div class="form-group field col-md-6">
            <label for="container-item"><?php echo __('infinite_scroll_config.config.container') ?></label>
            <input type="text" class="form-control width-90" id="container-item" name="container" value="{{ $infiniteScroll['container'] }}" data-required="true">
            <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right">
            </button>
        </div>
        <div class="form-group field col-md-6">
            <label for="itemload"><?php echo __('infinite_scroll_config.config.item') ?></label>
            <input type="text" class="form-control" id="item" name="itemLoad" value="{{ $infiniteScroll['itemLoad'] }}" data-required="true">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group field col-md-6">
            <label for="pagination"><?php echo __('infinite_scroll_config.config.pagination'); ?></label>
            <input type="text" class="form-control width-90" id="pagination" name="pagination" value="{{ $infiniteScroll['pagination'] }}" data-required="true">
            <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right">
            </button>
        </div>
        <div class="form-group field col-md-6">
            <label for="next-pagination"><?php echo __('infinite_scroll_config.config.nextPagination') ?></label>
            <input type="text" class="form-control" id="next-pagination" name="nextPagination" value="{{ $infiniteScroll['nextPagination'] }}" data-required="true">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="form-group field">
                <label for="offset"><?php echo __('infinite_scroll_config.config.offset') ?></label>
                <input type="number" class="form-control" id="offset" name="offset"  value="{{ $infiniteScroll['offset'] }}" data-required="true">
                <p class="note">
                    <span>{{ __('Please change this parameter Live Preview will work') }}</span>
                </p>
            </div>
            <div class="form-group field">
                <label for="done-text"><?php echo __('infinite_scroll_config.config.doneText') ?></label>
                <input type="text" class="form-control" id="done-text" name="doneText" value="{{ $infiniteScroll['doneText'] }}">
            </div>
            <div class="form-group field">
                <label for="load-image-placeholder"><?php echo __('infinite_scroll_config.config.loadingImage') ?></label>
                @if($infiniteScroll['image'])
                <img src="{{ url('tmp/uploads/'. $infiniteScroll['image']) }}" id="magepow_infinitescroll_general_loading_image_image" title="{{ $infiniteScroll['image'] }}"
                alt="$infiniteScroll['image']" height="22" width="22" class="small-image-preview v-middle" >
                @endif
                <input type="file" class="form-control" id="load-image-placeholder" name="image" accept=".png, .jpg, .jpeg, .gif" />
            </div>
            <div class="form-group field">
                <label for="load-more-button-text"><?php echo __('infinite_scroll_config.config.loadMoreBtn') ?></label>
                <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText" value="{{ $infiniteScroll['loadMoreButtonText'] }}">
            </div>
        </div>
        <div class="form-group col-md-6">
            <h3>Live preview</h3>
            <div class="preview-config-list">
                <div class="preview-item">
                    <div class="offset"></div>
                </div>
                <div class="preview-item">
                    <div class="done-text">{{ $infiniteScroll['doneText'] }}</div>
                </div>
                <div class="preview-item">
                    <div class="iass-spinner" style="">
                        <img src="{{ url('tmp/uploads/'. $infiniteScroll['image']) }}" class="load-image-placeholder">
                        <span>
                            <em>Loading - please wait...</em>
                        </span>
                    </div>
                </div>
                <div class="preview-item">
                    <button class="load-more-button-text">{{ $infiniteScroll['loadMoreButtonText'] }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" id="input-change-layout">
        <div class="form-group col-md-6">
            <div class="form-group field">
                <label for="border-size"><?php echo __('infinite_scroll_config.config.borderSizeBtn') ?></label>
                <input type="number" id="border-size" class="form-control" name="borderSize" value="{{ $infiniteScroll['borderSize'] }}">
                <p class="note">
                    <span>{{ __('infinite_scroll_config.note.empty') }}</span>
                </p>
            </div>
            <div class="form-group field">
                <label for="border-radius"><?php echo __('infinite_scroll_config.config.borderRadius') ?></label>
                <input type="number" id="border-radius" class="form-control" name="borderRadius" value="{{ $infiniteScroll['borderRadius'] }}">
                <p class="note">
                    <span>{{ __('infinite_scroll_config.note.empty') }}</span>
                </p>
            </div>
            <div class="form-group field">
                <label for="font-size"><?php echo __('infinite_scroll_config.config.fontSize') ?></label>
                <input type="number" id="font-size" class="form-control"  name="fontSize" value="{{ $infiniteScroll['fontSize'] }}">
                <p class="note">
                    <span>{{ __('infinite_scroll_config.note.emptyFont') }}</span>
                </p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="form-group field">
                <label for="border-color"><?php echo __('infinite_scroll_config.config.borderColorBtn') ?></label>
                <input type="color" id="border-color"class="form-control"  name="borderColor" value="{{ $infiniteScroll['borderColor']}}">
            </div>
            <div class="form-group field">
                <label for="background-button-loadmore"><?php echo __('infinite_scroll_config.config.backgroundLoadmore') ?></label>
                <input type="color" id="background-button-loadmore" class="form-control" name="backgroundButtonLoadmore" value="{{ $infiniteScroll['backgroundButtonLoadmore']}}">
            </div>
            <div class="form-group field">
                <label for="font-color"><?php echo __('infinite_scroll_config.config.fontColor') ?></label>
                <input type="color" id="font-color" class="form-control" name="fontColor" value="{{ $infiniteScroll['fontColor']}}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo __('infinite_scroll_config.config.saveBtnNewConfig') ?></button>
</form>


