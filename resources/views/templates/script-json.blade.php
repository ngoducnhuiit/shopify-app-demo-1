<script class="config-infinite" type="text/javascript">
    if(window.jQuery){
       var scriptJquey = '{{ "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" | script_tag }}';
       scriptJquey.insertBefore('head script:first');
    }
    $(document).ready(function(){
        var laravelConfig = $('#magepow_config_scroll_laravel_app');
        var infiniteConfigText = $('#magepow_config_scroll_laravel_app').text();
        if(laravelConfig != null && infiniteConfig['enabled']){
            var options = {
	            container 	: "infiniteConfig['container']",
	            item      	: "infiniteConfig['item']",
	            pagination  : "infiniteConfig['pagination']",
	            next   		: "infiniteConfig['next']",
	            delay  		: "infiniteConfig['delay']",
	            src 		: "infiniteConfig['image']",
	            htmlLoading : "<div class=\"iass-spinner\" style=\" margin-bottom: -150px; padding: 150px;\"><img src=\"{src}\"/><span><em>Loading - please wait...</em></span></div>",
	            htmlLoadMore: "<div class=\"ias-trigger ias-trigger-next\"><button class=\"load-more\">Load more items</button></div>",
	            htmlLoadEnd : "<div class=\"ias-noneleft\" style=\" margin-bottom: -150px; padding: 150px;\">{text}</div>",
	            textLoadEnd : "infiniteConfig['doneText']",
	            textLoadMore: "infiniteConfig['loadMoreButtonText']",
	            textPrev 	: "Load more items",
	            htmlPrev 	: "<div class=\"ias-trigger ias-trigger-prev\"><button class=\"load-more\">Load more items</button></div>",
	            offset 		: 3
	        };
			$('body').addClass('infinitescroll-pro');
            if(!jQuery().ias){
            	console.warn('Plugin "jQuery.ias" does not exist!');
            	return;
            }
            window.ias = jQuery.ias({
                container : options.container,
                item 	  : options.item,
                pagination: options.pagination,
                next 	  : options.next,
                delay     : options.delay
            });
            window.ias.extension(new IASSpinnerExtension({
                src : options.src,
                html: options.htmlLoading
            }));
            window.ias.extension(new IASNoneLeftExtension({
                text: options.textLoadEnd,
                html: options.htmlLoadEnd,
            }));
          	window.ias.extension(new IASTriggerExtension({
                text    : options.textLoadMore,
                html    : options.htmlLoadMore,
                textPrev: options.textPrev,
                htmlPrev: options.htmlPrev,
                offset  : options.offset,
            }));
        }
	});
</script>
