<form id="infinite-scroll-form" class="form-scroll" method="post" action="{{ url('infinitiscroll') }}"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="config_id" name="config_update" value="update">
    <input type="hidden" class="theme_id" name="theme_id" value="{{ $shop_id['theme_id'] }}">
    <input type="hidden" class="theme_id" name="shop_domain" value="{{ $shop_id['shop_domain'] }}">
    <input type="hidden" class="all_theme_id" name="all_theme_id" value="{{ $shop_id['all_theme_id'] }}">
    <input type="hidden" class="apply_all_theme" id="apply_all_theme"  name="apply_all_theme" value="0">
    <div class="form-row">
        <div class="form-group field col-md-6">
            <label for="input-enable"><?php echo __('Enabled') ?></label>
            <select id="input-enable" class="form-control" name="enabled">
                <option value="0" @if (!$infiniteScroll['enabled']) selected @endif>No</option>
                <option value="1" @if ($infiniteScroll['enabled']) selected @endif>Yes</option>
            </select>
        </div>
        <div class="form-group field col-md-6">
            <label for="delay"><?php echo __('Delay (ms)') ?></label>
            <input type="text" class="form-control" id="delay" name="delay" value="{{ $infiniteScroll['delay'] }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group field col-md-6">
            <label for="container-item"><?php echo __('Container') ?></label>
            <input type="text" class="form-control width-90" id="container-item" name="container" value="{{ $infiniteScroll['container'] }}" data-required="true">
            <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right" title="
            {{ __('If the attribute is taken as an id, add "#" For example: #container_grid') }}.
{{ __('If the attribute is taken as an id, add "." For example: .container_grid') }}">
            </button>
        </div>
        <div class="form-group field col-md-6">
            <label for="itemload"><?php echo __('Item') ?></label>
            <input type="text" class="form-control" id="item" name="itemLoad" value="{{ $infiniteScroll['itemLoad'] }}" data-required="true">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group field col-md-6">
            <label for="pagination"><?php echo __('Pagination '); ?></label>
            <input type="text" class="form-control width-90" id="pagination" name="pagination" value="{{ $infiniteScroll['pagination'] }}" data-required="true">
            <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right" title="
            {{ __('If the attribute is taken as an id, add "#" For example: #pagination_list') }}.
{{ __('If the attribute is taken as an class, add "." For example: .pagination_list') }}">
            </button>
        </div>
        <div class="form-group field col-md-6">
            <label for="next-pagination"><?php echo __('Next Pagination') ?></label>
            <input type="text" class="form-control" id="next-pagination" name="nextPagination" value="{{ $infiniteScroll['nextPagination'] }}" data-required="true">
        </div>
    </div>
    <div class="form-group field">
        <label for="loading-text"><?php echo __('Loading Text') ?></label>
        <input type="text" class="form-control" id="loading-text" name="loadingText" value="{{ $infiniteScroll['loadingText'] }}">
    </div>
    <div class="form-group field">
        <label for="loading-text"><?php echo __('Offset') ?></label>
        <input type="number" class="form-control" id="offset" name="offset"  value="{{ $infiniteScroll['offset'] }}" data-required="true">
    </div>
    <div class="form-group field">
        <label for="done-text"><?php echo __('Done Text') ?></label>
        <input type="text" class="form-control" id="done-text" name="doneText" value="{{ $infiniteScroll['doneText'] }}">
    </div>
    <div class="form-group field">
        <label for="load-image-placeholder"><?php echo __('Loading Image placeholder :') ?></label>
        @if($infiniteScroll['image'])
        <img src="{{ url('tmp/uploads/'. $infiniteScroll['image']) }}" id="magepow_infinitescroll_general_loading_image_image" title="{{ $infiniteScroll['image'] }}"
        alt="$infiniteScroll['image']" height="22" width="22" class="small-image-preview v-middle" >
        @endif
        <input type="file" class="form-control" id="load-image-placeholder" name="image" >
    </div>
    <div class="form-group field">
        <label for="load-more-button-text"><?php echo __('Load More button text') ?></label>
        <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText" value="{{ $infiniteScroll['loadMoreButtonText'] }}">
    </div>
    <button type="submit" class="btn btn-primary"><?php echo __('Update New Config') ?></button>
</form>


