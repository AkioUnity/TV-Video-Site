/*!
 * Parallax Columns
 * #
 *
 * Website's scrolling parallax scolumns
 */

(function($){

	$.fn.parallaxColumn = function(options){

		var defaults = {
            'column_class': '.parallax-column',
            'content_class': '.parallax-content'
        };
        options = $.extend(defaults, options);


        this.each(function(){
        	var $this = $(this),
        		$content = $this.find(options.content_class),
        		content_height = 0,
        		offset_top = 0,
        		offset_bottom = 0,
        		bottom_scroll_point = 0,

        		scrollTop = $(window).scrollTop(),
    			bottom_offset = scrollTop + $(window).height(),
    			window_height = $(window).height(),
    			_scroll_percent = (scrollTop - offset_top)*100/(bottom_scroll_point - offset_top);


    		var init_columns = function(){
        		content_height = $content.height();
        		offset_top = $this.offset().top;
        		offset_bottom = offset_top + content_height;
        		bottom_scroll_point = offset_bottom - $(window).height();

    			$this.find(options.column_class).each(function(){
    				// reset classes
    				$(this).removeClass('pc-small-xs pc-small pc-large');
    				// add classes
	    			if( $(this).outerHeight() <= $(window).height() ){
	    				$(this).addClass('pc-small-xs');
	    				$(this).parent().css('position', 'relative');
	    			}
	    			else if( $(this).outerHeight() < content_height ){
	    				$(this).addClass('pc-small');
	    				$(this).parent().css('position', 'relative');
	    			}
	    			else if( $(this).outerHeight() > content_height ){
	    				$(this).addClass('pc-large');
	    				$(this).parent().height(content_height);
	    			}
	    		});
    		};

    		var reset_columns = function(){
    			$this.find('.pc-small-xs, .pc-small, .pc-large').each(function(){
					var $col = $(this);
					$col.css({
						'position': 'relative',
						'left': 'auto',
						'top': 'auto',
						'width': '100%',
						'-webkit-transform': 'none',
						   '-moz-transform': 'none',
								'transform': 'none'
					});
					$col.parent().css('height', 'auto');
				});
    		};

    		var reset_positions = function(){
    			$this.find('.pc-small-xs, .pc-small, .pc-large').each(function(){
    				var $col = $(this);
					$col.css({
						'position': 'relative',
						'left': 'auto',
						'top': 'auto',
						'width': '100%',
						'-webkit-transform': 'none',
						   '-moz-transform': 'none',
								'transform': 'none'
					});
				});
    		}

    		// calculate column that less 
    		var calculate_small_xs = function(){

    			$this.find('.pc-small-xs').each(function(){
					var $col = $(this);
					if( (scrollTop > offset_top && bottom_offset < offset_bottom) || (scrollTop < offset_bottom - $col.height()) ){
						$col.css({
							'top': '0px',
							'left': $col.offset().left+'px',
							'width': $col.width()+'px',
							'position': 'fixed'
						});
					}
					else if( scrollTop >= offset_bottom - $col.height() ){
						var diff_height = content_height - $col.height();
						if( offset_bottom-$col.height() < scrollTop ){
							$col.css({
								'top': diff_height + 'px',
								'left': 'auto',
								'width': $col.width()+'px',
								'position': 'absolute'
							});
						}
					}
				});

    		};

    		var calculate_small = function(){

    			$this.find('.pc-small').each(function(){
					var $col = $(this);

					var diff_height = content_height-$col.height();
					var sp = scrollTop-offset_top;

					if( scrollTop + window_height >= offset_top + content_height ){
						var diff = diff_height = content_height-$col.height();
						$col.css({
							'top': diff + 'px',
							'left': 'auto',
							'width': $col.width()+'px',
							'position': 'absolute'
						});
					}
					else if( (scrollTop > offset_top && bottom_offset < offset_bottom) && ($col.height() - window_height + offset_top <= scrollTop) ){
						var diff = window_height - $col.height();
						$col.css({
							'top': diff + 'px',
							'left': $col.offset().left+'px',
							'width': $col.width()+'px',
							'position': 'fixed'
						});
					}
					else if( (scrollTop > offset_top && bottom_offset < offset_bottom) && (offset_top+diff_height <= scrollTop) ){
						$col.css({
							'top': '0',
							'left': '0',
							'width': '100%',
							'position': 'relative'
						});
					}
					

					if( scrollTop > offset_top && bottom_offset < offset_bottom && (sp >= content_height - $col.height()) ){
						
					}
					if( (scrollTop > offset_top && bottom_offset < offset_bottom) || scrollTop > offset_bottom || (scrollTop < offset_bottom - $col.height()) ){
						if( offset_bottom - window_height - 50 < scrollTop ){
							
						}
						else if( sp >= diff_height ){
							
						}
					}

				});
    		};

    		var calculate_large = function(){

    			if( scrollTop > offset_top && bottom_offset < offset_bottom ){
    				// scroll inside
    				$this.find('.pc-large').each(function(){
						var $col = $(this),
							pHeight = content_height,
							cHeight = $col.height(),
							translateY = parseInt((cHeight - pHeight)/100*_scroll_percent, 10);

						$col.css({
							'-webkit-transform': 'translate3d(0px, -'+translateY+'px, 0px)',
							   '-moz-transform': 'translate3d(0px, -'+translateY+'px, 0px)',
									'transform': 'translate3d(0px, -'+translateY+'px, 0px)'
						});
					});
    			}
    			else if( scrollTop > offset_bottom ){
    				// scroll out down
    				$this.find('.pc-large').each(function(){
						var $col = $(this),
							pHeight = content_height,
							cHeight = $col.height(),
							translateY = parseInt(cHeight - pHeight, 10);

						$col.css({
							'-webkit-transform': 'translate3d(0px, -'+translateY+'px, 0px)',
							   '-moz-transform': 'translate3d(0px, -'+translateY+'px, 0px)',
									'transform': 'translate3d(0px, -'+translateY+'px, 0px)'
						});
					});
    			}

    		};

    		// resize
    		$(window).resize(function(){
    			window_height = $(window).height();

    			if( $(window).width() >= 768 ){
	    			init_columns();
	    		}
	    		else{
	    			reset_columns();
	    		}
    		});


        	$(window).scroll(function(){
    			scrollTop = $(window).scrollTop();

    			if( scrollTop < offset_top ){
					reset_positions();
				}
				else{
					bottom_offset = scrollTop + $(window).height();
    				_scroll_percent = (scrollTop - offset_top)*100/(bottom_scroll_point - offset_top);

					calculate_small_xs();
					calculate_small();
					calculate_large();
				}

        	});
			
        	// init function
    		init_columns();
    		setTimeout(function(){
				calculate_large();
    		}, 400);

        });
		
	}

})(jQuery);