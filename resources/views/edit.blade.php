
<form name="add-blog-post-form" id="add-blog-post-form"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="config_id" name="config_id" value="{{ $infiniteScroll['id'] }}">
    <div class="form-group col-md-6">
        <label for="input-enable">Enabled</label>
        <select id="input-enable" class="form-control" name="enabled">
            <option value="0" @if (!$infiniteScroll['enabled']) selected @endif>No</option>
            <option value="1" @if ($infiniteScroll['enabled']) selected @endif>Yes</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="delay">Delay (ms)</label>
        <input type="text" class="form-control" id="delay" name="delay" value="{{ $infiniteScroll['delay'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="container-item">Container</label>
        <input type="text" class="form-control" id="container-item" name="container" value="{{ $infiniteScroll['container'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="pagination">Pagination</label>
        <input type="text" class="form-control" id="pagination" name="pagination" value="{{ $infiniteScroll['pagination'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="next-pagination">Next Pagination</label>
        <input type="text" class="form-control" id="next-pagination" name="nextPagination" value="{{ $infiniteScroll['nextPagination'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="itemload">Item</label>
        <input type="text" class="form-control" id="item" name="itemLoad" value="{{ $infiniteScroll['itemLoad'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="loading-text">Loading Text</label>
        <input type="text" class="form-control" id="loading-text" name="loadingText" value="{{ $infiniteScroll['loadingText'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="done-text">Done Text</label>
        <input type="text" class="form-control" id="done-text" name="doneText" value="{{ $infiniteScroll['doneText'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="load-image-placeholder">Loading Image placeholder :</label>
        @if($infiniteScroll['image'])
        <img src="{{ url('tmp/uploads/'. $infiniteScroll['image']) }}" id="magepow_infinitescroll_general_loading_image_image" title="$infiniteScroll['image']"
        alt="$infiniteScroll['image']" height="22" width="22" class="small-image-preview v-middle" >
        @endif
        <input type="file" class="form-control" id="load-image-placeholder" name="image" >
        <input type="hidden" class="form-control" name="hidden_image" value="{{ $infiniteScroll['image'] }}">
    </div>
    <div class="form-group col-md-6">
        <label for="load-more-button-text">Load More button text</label>
        <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText" value="{{ $infiniteScroll['loadMoreButtonText'] }}">
    </div>
    <button type="submit" class="btn btn-primary">Update New Config</button>
</form>

<script>
    $(document).ready(function(){
        $('#add-blog-post-form').submit(function(e){
                e.preventDefault();
                var url =  "{{ url('infinitiscroll') }}";
                var dataJson = $(this).serializeArray();
                $.ajax({
                    url: url,
                    dataType: "json",
                    type: "POST",
                    data: dataJson,
                    success: function (data) {

                    },
                    error: function (xhr, exception) {

                    }
                });
        });
    });
</script>

