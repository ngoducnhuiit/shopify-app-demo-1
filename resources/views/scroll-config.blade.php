<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/infinitescroll.css') }}" />
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/infinitescroll.js') }}"></script>
        <style type="text/css">
             .container-wrap{
                    margin-top: 50px;
                }

                /* .tooltip .comment.active{
                    display: block;
                }
                 */
                 .tooltip{
                    border: 1px solid #ccc;
                    border-radius: 50%;
                    opacity: 1;
                    text-align: center;
                    position: inherit;
                    float: right;
                    margin-top: -9%;
                    background: #ffffff;
                    color: #000000;
                }
                .width-90{
                    width: 90%;
                }
                .tooltip::before{
                    content: '?';
                }
                .margin-right-100px{
                    margin-right: 100px;
                }

                .preview-item .done-text,.preview-item .iass-spinner,.preview-item .done-text,.preview-item .load-more-button-text{
                    display: none;
                }

                .preview-item .iass-spinner.active,
                .preview-item .done-text.active,
                .preview-item .load-more-button-text.active{
                    display: block;
                }
        </style>
    </head>
    <body>
        <div class="container container-wrap">
            <div class="row">
                <div class="block-left col-md-3">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="card-annotation">
                                <img src="{{ url('image/alo.png') }}" width="200" class="icon_logo">
                            </div>
                        </div>
                        <div class="row row no-gutters">
                            <div class="card">
                                <h3 class="resource-list__header">{{ __('Navigation') }}</h3>
                                <ul class="resource-list">
                                    <li class="resource-list__item">
                                        <a href="#infinite-scroll-form">{{ __('Options Settings') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#configuration-guide">{{ __('Configuration Guide') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#write-us-review">{{ __('Write Us Review') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#contact-us">{{ __('Contact us') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="{{ url('infinitiscroll/delete') }}" class="btn btn-link">{{ __('Delete Config App') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="block-right col-md-9">
            @if (!$infiniteScroll)
                    <form id="infinite-scroll-form" class="form-scroll" method="post" action="{{ url('infinitiscroll') }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="shop_http" name="shop_domain" value="{{ $shop_id['shop_domain'] }}">
                        <input type="hidden" class="theme_id" name="theme_id" value="{{ $shop_id['theme_id'] }}">
                        <input type="hidden" class="all_theme_id" name="all_theme_id" value="{{ $shop_id['all_theme_id'] }}">
                        <input type="hidden" class="apply_all_theme" id="apply_all_theme" name="apply_all_theme" value="1">
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="input-enable"><?php echo __('Enabled') ?></label>
                                <input type="checkbox" name="enabled" />
                            </div>
                            <div class="form-group field col-md-6">
                                <label for="delay"><?php echo __('Delay (ms)') ?></label>
                                <input type="text" class="form-control" id="delay" name="delay" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="container-item"><?php echo __('Container') ?></label>
                                <input type="text" class="form-control width-90" id="container-item" name="container" data-required="true">
                                <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right">
                                </button>

                            </div>
                            <div class="form-group field col-md-6">
                                <label for="itemload"><?php echo __('Item') ?></label>
                                <input type="text" class="form-control" id="item" name="itemLoad" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="pagination"><?php echo __('Pagination ') ?></label>
                                <input type="text" class="form-control width-90" id="pagination" name="pagination" data-required="true">
                                <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right">
                                </button>
                            </div>
                            <div class="form-group field col-md-6">
                                <label for="next-pagination"><?php echo __('Next Pagination') ?></label>
                                <input type="text" class="form-control" id="next-pagination" name="nextPagination" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <div class="form-group field">
                                    <label for="loading-text"><?php echo __('Offset') ?></label>
                                    <input type="number" class="form-control" id="offset" name="offset" data-required="true" value="3">
                                    <p class="note">
                                        <span>{{ __('Please change this parameter Live Preview will work') }}</span>
                                    </p>
                                </div>
                                <div class="form-group field">
                                    <label for="done-text"><?php echo __('Done Text') ?></label>
                                    <input type="text" class="form-control" id="done-text" name="doneText">
                                </div>
                                <div class="form-group field">
                                    <label for="load-image-placeholder"><?php echo __('Loading Image placeholder:') ?></label>
                                    <img src="{{ url('tmp/uploads/loader-1.gif') }}" id="magepow_infinitescroll_general_loading_image_image" title="loader-1.gif"
                                        alt="loader-1.gif" height="22" width="22" class="small-image-preview v-middle" >
                                    <input type="file" accept=".png, .jpg, .jpeg, .gif" class="form-control" id="load-image-placeholder" name="image">
                                </div>
                                <div class="form-group field">
                                    <label for="load-more-button-text"><?php echo __('Load More button text') ?></label>
                                    <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText">
                                </div>
                            </div>
                            <div class="form-group field col-md-6">
                                <h3><?php echo __('Live Preview') ?></h3>
                                <div class="preview-config-list">
                                    <div class="preview-item">
                                        <div class="offset"></div>
                                    </div>
                                    <div class="preview-item">
                                        <div class="done-text"><?php echo __('You\'ve reached the end of the item.') ?></div>
                                    </div>
                                    <div class="preview-item">
                                        <div class="iass-spinner">
                                            <img src="{{ url('tmp/uploads/loader-1.gif') }}" class="load-image-placeholder" width="30" height="30" />
                                            <span>
                                                <em>Loading - please wait...</em>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="preview-item">
                                        <button class="load-more-button-text"><?php echo __('Load More ...') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group field">
                                    <label for="border-size"><?php echo __('Border Size Button') ?></label>
                                    <input type="number" id="border-size" class="form-control" name="borderSize">
                                    <p class="note">
                                        <span>{{ __('If left empty the default value is 0.') }}</span>
                                    </p>
                                </div>
                                <div class="form-group field">
                                    <label for="border-radius"><?php echo __('Border Radius Button') ?></label>
                                    <input type="number" id="border-radius" class="form-control" name="borderRadius">
                                    <p class="note">
                                        <span>{{ __('If left empty the default value is 0.') }}</span>
                                    </p>
                                </div>
                                <div class="form-group field">
                                    <label for="font-size"><?php echo __('Font Size') ?></label>
                                    <input type="number" id="font-size" class="form-control"  name="fontSize">
                                    <p class="note">
                                        <span>{{ __('If left empty the default value is 16.') }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group field">
                                    <label for="border-color"><?php echo __('Border Color') ?></label>
                                    <input type="color" id="border-color"class="form-control"  name="borderColor">
                                </div>
                                <div class="form-group field">
                                    <label for="background-button-loadmore"><?php echo __('Background Button Loadmore') ?></label>
                                    <input type="color" id="background-button-loadmore" class="form-control" name="backgroundButtonLoadmore">
                                </div>
                                <div class="form-group field">
                                    <label for="font-color"><?php echo __('Font Color') ?></label>
                                    <input type="color" id="font-color" class="form-control" name="fontColor">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo __('Save Config') ?></button>

                    </form>
                    <script type="text/javascript">
                        var dataDefault = {
                          'delay': 1000,
                          'container-item': "#collection-product,#product-grid",
                          'item': ".product-item,.grid__item",
                          'pagination': ".page-numbers,.pagination__list",
                          'next-pagination': ".page-next,.pagination__item--prev",
                          'offset': 3,
                          'done-text': "You've reached the end of the item.",
                          'load-more-button-text': "Load More ...",
                          'border-size': 0,
                          'border-radius': 0,
                          'font-size': 16
                        };
                        Object.keys(dataDefault).forEach(key => {
                            document.querySelector('#'+key).value = dataDefault[key];
                        });
                    </script>
                    @else
                        @include('edit')
                    @endif
                    @include('guide')
                </div>
            </div>
        </div>
    </body>
</html>


<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/infinitescroll.css') }}" />
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/infinitescroll.js') }}"></script>
        <style type="text/css">
             .container-wrap{
                    margin-top: 50px;
                }

                /* .tooltip .comment.active{
                    display: block;
                }
                 */
                 .tooltip{
                    border: 1px solid #ccc;
                    border-radius: 50%;
                    opacity: 1;
                    text-align: center;
                    position: inherit;
                    float: right;
                    margin-top: -9%;
                    background: #ffffff;
                    color: #000000;
                }
                .width-90{
                    width: 90%;
                }
                .tooltip::before{
                    content: '?';
                }
                .margin-right-100px{
                    margin-right: 100px;
                }

                .preview-item .done-text,.preview-item .iass-spinner,.preview-item .done-text,.preview-item .load-more-button-text{
                    display: none;
                }

                .preview-item .iass-spinner.active,
                .preview-item .done-text.active,
                .preview-item .load-more-button-text.active{
                    display: block;
                }
        </style>
    </head>
    <body>
        <div class="container container-wrap">
            <div class="row">
                <div class="block-left col-md-3">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="card-annotation">
                                <img src="{{ url('image/alo.png') }}" width="200" class="icon_logo">
                            </div>
                        </div>
                        <div class="row row no-gutters">
                            <div class="card">
                                <h3 class="resource-list__header">{{ __('infinite_scroll_config.menu.navigation') }}</h3>
                                <ul class="resource-list">
                                    <li class="resource-list__item">
                                        <a href="#infinite-scroll-form">{{ __('infinite_scroll_config.menu.configNav') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#configuration-guide">{{ __('infinite_scroll_config.menu.guide') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#write-us-review">{{ __('infinite_scroll_config.menu.review') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#contact-us">{{ __('infinite_scroll_config.menu.contactUs') }}</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="{{ url('infinitiscroll/delete') }}" class="btn btn-link">{{ __('infinite_scroll_config.menu.deleteConfig') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-right col-md-9">
            @if (!$infiniteScroll)
                    <form id="infinite-scroll-form" class="form-scroll" method="post" action="{{ url('infinitiscroll') }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="shop_http" name="shop_domain" value="{{ $shop_id['shop_domain'] }}">
                        <input type="hidden" class="theme_id" name="theme_id" value="{{ $shop_id['theme_id'] }}">
                        <input type="hidden" class="all_theme_id" name="all_theme_id" value="{{ $shop_id['all_theme_id'] }}">
                        <input type="hidden" class="apply_all_theme" id="apply_all_theme" name="apply_all_theme" value="1">
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="input-enable"><?php echo __('infinite_scroll_config.config.enabled') ?></label>
                                <input type="checkbox" name="enabled" />
                            </div>
                            <div class="form-group field col-md-6">
                                <label for="delay"><?php echo __('infinite_scroll_config.config.delay') ?></label>
                                <input type="text" class="form-control" id="delay" name="delay" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="container-item"><?php echo __('infinite_scroll_config.config.container') ?></label>
                                <input type="text" class="form-control width-90" id="container-item" name="container" data-required="true">
                                <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right">
                                </button>

                            </div>
                            <div class="form-group field col-md-6">
                                <label for="itemload"><?php echo __('infinite_scroll_config.config.item') ?></label>
                                <input type="text" class="form-control" id="item" name="itemLoad" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="pagination"><?php echo __('infinite_scroll_config.config.pagination') ?></label>
                                <input type="text" class="form-control width-90" id="pagination" name="pagination" data-required="true">
                                <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right">
                                </button>
                            </div>
                            <div class="form-group field col-md-6">
                                <label for="next-pagination"><?php echo __('infinite_scroll_config.config.nextPagination') ?></label>
                                <input type="text" class="form-control" id="next-pagination" name="nextPagination" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <div class="form-group field">
                                    <label for="loading-text"><?php echo __('infinite_scroll_config.config.offset') ?></label>
                                    <input type="number" class="form-control" id="offset" name="offset" data-required="true" value="3">
                                    <p class="note">
                                        <span>{{ __('infinite_scroll_config.note.offset') }}</span>
                                    </p>
                                </div>
                                <div class="form-group field">
                                    <label for="done-text"><?php echo __('infinite_scroll_config.config.doneText') ?></label>
                                    <input type="text" class="form-control" id="done-text" name="doneText">
                                </div>
                                <div class="form-group field">
                                    <label for="load-image-placeholder"><?php echo __('infinite_scroll_config.config.loadingImage') ?></label>
                                    <img src="{{ url('tmp/uploads/loader-1.gif') }}" id="magepow_infinitescroll_general_loading_image_image" title="loader-1.gif"
                                        alt="loader-1.gif" height="22" width="22" class="small-image-preview v-middle" >
                                    <input type="file" accept=".png, .jpg, .jpeg, .gif" class="form-control" id="load-image-placeholder" name="image">
                                </div>
                                <div class="form-group field">
                                    <label for="load-more-button-text"><?php echo __('infinite_scroll_config.config.loadMoreBtn') ?></label>
                                    <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText">
                                </div>
                            </div>
                            <div class="form-group field col-md-6">
                                <h3><?php echo __('infinite_scroll_config.config.title') ?></h3>
                                <div class="preview-config-list">
                                    <div class="preview-item">
                                        <div class="offset"></div>
                                    </div>
                                    <div class="preview-item">
                                        <div class="done-text"><?php echo __('infinite_scroll_config.preview.doneText') ?></div>
                                    </div>
                                    <div class="preview-item">
                                        <div class="iass-spinner">
                                            <img src="{{ url('tmp/uploads/loader-1.gif') }}" class="load-image-placeholder" width="30" height="30" />
                                            <span>
                                                <em>Loading - please wait...</em>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="preview-item">
                                        <button class="load-more-button-text"><?php echo __('infinite_scroll_config.preview.loadMoreBtn') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group field">
                                    <label for="border-size"><?php echo __('infinite_scroll_config.config.borderSizeBtn') ?></label>
                                    <input type="number" id="border-size" class="form-control" name="borderSize">
                                    <p class="note">
                                        <span>{{ __('infinite_scroll_config.note.empty') }}</span>
                                    </p>
                                </div>
                                <div class="form-group field">
                                    <label for="border-radius"><?php echo __('infinite_scroll_config.config.borderRadius') ?></label>
                                    <input type="number" id="border-radius" class="form-control" name="borderRadius">
                                    <p class="note">
                                        <span>{{ __('infinite_scroll_config.note.empty') }}</span>
                                    </p>
                                </div>
                                <div class="form-group field">
                                    <label for="font-size"><?php echo __('infinite_scroll_config.config.fontSize') ?></label>
                                    <input type="number" id="font-size" class="form-control"  name="fontSize">
                                    <p class="note">
                                        <span>{{ __('infinite_scroll_config.note.emptyFont') }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group field">
                                    <label for="border-color"><?php echo __('infinite_scroll_config.config.borderColorBtn') ?></label>
                                    <input type="color" id="border-color"class="form-control"  name="borderColor">
                                </div>
                                <div class="form-group field">
                                    <label for="background-button-loadmore"><?php echo __('infinite_scroll_config.config.backgroundLoadmore') ?></label>
                                    <input type="color" id="background-button-loadmore" class="form-control" name="backgroundButtonLoadmore">
                                </div>
                                <div class="form-group field">
                                    <label for="font-color"><?php echo __('infinite_scroll_config.config.fontColor') ?></label>
                                    <input type="color" id="font-color" class="form-control" name="fontColor">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo __('infinite_scroll_config.config.saveBtn') ?></button>

                    </form>
                    <script type="text/javascript">
                        var dataDefault = {
                          'delay': 1000,
                          'container-item': "#collection-product,#product-grid",
                          'item': ".product-item,.grid__item",
                          'pagination': ".page-numbers,.pagination__list",
                          'next-pagination': ".page-next,.pagination__item--prev",
                          'offset': 3,
                          'done-text': "You've reached the end of the item.",
                          'load-more-button-text': "Load More ...",
                          'border-size': 0,
                          'border-radius': 0,
                          'font-size': 16
                        };
                        Object.keys(dataDefault).forEach(key => {
                            document.querySelector('#'+key).value = dataDefault[key];
                        });
                    </script>
                    @else
                        @include('edit')
                    @endif
                    @include('guide')
                </div>
            </div>
        </div>
    </body>
</html>
