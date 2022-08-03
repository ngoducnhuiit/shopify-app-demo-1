<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            @if (!$infiniteScroll)
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ url('infinitiscroll') }}"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="shop_http" name="shop_id" value="{{ $shop_id['shop_name'] }}">
                    <input type="hidden" class="theme_id" name="theme_id" value="{{ $shop_id['theme_id'] }}">
                    <div class="form-group col-md-6">
                        <label for="input-enable">Enabled</label>
                        <select id="input-enable" class="form-control" name="enabled">
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="delay">Delay (ms)</label>
                        <input type="text" class="form-control" id="delay" name="delay">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="container-item">Container</label>
                        <input type="text" class="form-control" id="container-item" name="container">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pagination">Pagination</label>
                        <input type="text" class="form-control" id="pagination" name="pagination">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="next-pagination">Next Pagination</label>
                        <input type="text" class="form-control" id="next-pagination" name="nextPagination">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="itemload">Item</label>
                        <input type="text" class="form-control" id="item" name="itemLoad">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="loading-text">Loading Text</label>
                        <input type="text" class="form-control" id="loading-text" name="loadingText">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="done-text">Done Text</label>
                        <input type="text" class="form-control" id="done-text" name="doneText">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="load-image-placeholder">Loading Image placeholder :</label>
                        <input type="file" class="form-control" id="load-image-placeholder" name="image">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="load-more-button-text">Load More button text</label>
                        <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Config</button>
                </form>
            @else
                @include('edit')
            @endif
        </div>


    </body>
</html>
