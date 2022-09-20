<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <style>
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
        </style>
    </head>

    <body>
        <div class="container container-wrap">
            <div class="row">
                <div class="block-left col-md-3">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="card-annotation">
                                <img src="{{ url('image/magepow-logo.png') }}" height="100" width="200" class="icon_logo">
                            </div>
                        </div>
                        <div class="row row no-gutters">
                            <div class="card">
                                <h3 class="resource-list__header">Navigation</h3>
                                <ul class="resource-list">
                                    <li class="resource-list__item">
                                        <a href="#infinite-scroll-form">Options Settings</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#configuration-guide" >Configuration Guide</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#write-us-review">Write Us Review</a>
                                    </li>
                                    <li class="resource-list__item">
                                        <a href="#contact-us">Contact us</a>
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
                        <input type="hidden" class="apply_all_theme" id="apply_all_theme"  name="apply_all_theme" value="1">
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="input-enable"><?php echo __('Enabled') ?></label>
                                <select id="input-enable" class="form-control" name="enabled">
                                    <option value="0" selected><?php echo __('No') ?></option>
                                    <option value="1"><?php echo __('Yes') ?></option>
                                </select>
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
                                <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right" title=title="
                                {{ __('If the attribute is taken as an id, add "#" For example: #container_grid') }}.
                    {{ __('If the attribute is taken as an id, add "." For example: .container_grid') }}">
                                </button>

                            </div>
                            <div class="form-group field col-md-6">
                                <label for="itemload"><?php echo __('Item') ?></label>
                                <input type="text" class="form-control" id="item" name="itemLoad" data-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group field col-md-6">
                                <label for="pagination"><?php echo __('Pagination.') ?></label>
                                <input type="text" class="form-control width-90" id="pagination" name="pagination" data-required="true">
                                <button type="button" class="btn btn-secondary tooltip" data-toggle="tooltip" data-placement="right" title="
                                {{ __('If the attribute is taken as an id, add "#" For example: #pagination_list') }}.
                    {{ __('If the attribute is taken as an id, add "." For example: .pagination_list') }}">
                                </button>
                            </div>
                            <div class="form-group field col-md-6">
                                <label for="next-pagination"><?php echo __('Next Pagination') ?></label>
                                <input type="text" class="form-control" id="next-pagination" name="nextPagination" data-required="true">
                            </div>
                        </div>
                        <div class="form-group field">
                            <label for="loading-text"><?php echo __('Loading Text') ?></label>
                            <input type="text" class="form-control" id="loading-text" name="loadingText">
                        </div>
                        <div class="form-group field">
                            <label for="loading-text"><?php echo __('Offset') ?></label>
                            <input type="number" class="form-control" id="offset" name="offset" data-required="true">
                        </div>
                        <div class="form-group field">
                            <label for="done-text"><?php echo __('Done Text') ?></label>
                            <input type="text" class="form-control" id="done-text" name="doneText">
                        </div>

                        <div class="form-group field">
                            <label for="load-image-placeholder"><?php echo __('Loading Image placeholder:') ?></label>
                            <input type="file" class="form-control" id="load-image-placeholder" name="image" data-required="true">
                        </div>
                        <div class="form-group field">
                            <label for="load-more-button-text"><?php echo __('Load More button text') ?></label>
                            <input type="text" class="form-control" id="load-more-button-text" name="loadMoreButtonText">
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo __('Save Config') ?></button>

                    </form>
                    @else
                        @include('edit')
                    @endif
                    @include('guide')
                </div>
            </div>
        </div>
        @extends('shopify-app::layouts.default')

        @section('content')
            <!-- You are: (shop domain name) -->
            <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
            <div id="root"></div>
        @endsection

        @section('scripts')
            @parent

            <script>

                const app = useAppBridge();

                const handleCreate = (app, backdrop) => {
                backdrop.setBackdrop(true);
                const redirect = Redirect.create(app);
                redirect.dispatch(Redirect.Action.APP, '/funnels/create' );
                }
                // window.location.replace(window.location.origin);
                actions.Redirect.Action.APP;
                console.log(actions.Redirect.Action.APP);
                console.log(actions);
                actions.TitleBar.create(app, { title: window.location.origin });
            </script>
        @endsection
        <script type="text/javascript">
            $(document).ready(function(){
                var dataMessage = {
                    errors: '{{ __('This is a required field.') }}'
                };
                var form = $('#add-infinite-scroll-form');
                $(document).submit('#add-infinite-scroll-form', function(event){
                    $(this).find('input[data-required="true"]').each(function(){
                        if(!$(this).val()){
                            if($(this).next().length == 0){
                                $('<div class="error alert alert-danger">' + dataMessage.errors+ "</div>").insertAfter(this);
                            }
                            $(this).parent('field').addClass('_error');
                            event.preventDefault();
                        }else{
                            $(this).parent('field').removeClass('_error');
                            $(this).next().remove();
                        }
                    });
                });
                $('.form-control').on('keydown', function(){
                    setTimeout(() => {
                        if(!$(this).val() && $(this).data('required')){
                            if($(this).next().length == 0){
                                $('<div class="error alert alert-danger">' + dataMessage.errors+ "</div>").insertAfter(this);
                            }
                            $(this).parent('field').addClass('_error');
                        }else if($(this).data('required')){
                            $(this).parent('field').removeClass('_error');
                            $(this).next().remove();
                        }
                    }, 100);
                })
                $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(event) {
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        $('.resource-list__item a[href*="#"]').each(function(){
                            var hideForm = $(this).attr('href');
                            $(this).parent().removeClass('active');
                            $(hideForm).hide();
                        });
                        $(this).parent().addClass('active');
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        target.show();
                        if (target.length) {
                            event.preventDefault();
                            $('html, body').animate({
                                scrollTop: target.offset().top - 50
                            }, 1000, function() {
                                var $target = $(target);
                                $target.focus();
                                if ($target.is(":focus")) {
                                    return false;
                                } else {
                                    $target.attr('tabindex','-1');
                                    $target.focus();
                                };
                            });
                        }
                    }
                });
            });
        </script>
    </body>
</html>
