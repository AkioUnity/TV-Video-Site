(function ($) {
    "use strict";

    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

    var isTouchDevice = function () {
        return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
    }

    $('[data-bg-image]').each(function () {
        $(this).css({'background-image': 'url(' + $(this).data('bg-image') + ')'});
    });

    $('[data-bg-color]').each(function () {
        $(this).css({'background-color': $(this).data('bg-color')});
    });

    $('[data-width]').each(function () {
        $(this).css({'width': $(this).data('width')});
    });

    $('[data-height]').each(function () {
        $(this).css({'height': $(this).data('height')});
    });

    $('[data-alpha]').each(function () {
        $(this).css({'opacity': $(this).data('alpha')});
    });
    let video_id=-1;
    $(document).ready(function () {

        // check supports mix-blend-mode
        if ('CSS' in window && 'supports' in window.CSS) {
            var supportsMixBlendMode = window.CSS.supports('mix-blend-mode', 'multiply');
            if (!supportsMixBlendMode) {
                $('.fs-slide.fn-slide').addClass('no-blend-mode');
            }
        }

        /* Sub menu */
        $('nav.main-nav li:has(> ul)').addClass('menu-item-has-children');

        /* Mega Menu */
        $('nav.main-nav').find('.menu-item-mega').each(function () {
            var _mega = $(this);
            var _left = $('nav.main-nav').offset().left;
            _left = _left - _mega.offset().left;
            _mega.find('> ul').css({
                'left': _left + 'px',
                'width': $('nav.main-nav').width() + 'px'
            });
        });
        // responsive for mega menu
        $(window).resize(function () {
            $('nav.main-nav').find('.menu-item-mega').each(function () {
                var _mega = $(this);
                var _left = $('nav.main-nav').offset().left;
                _left = _left - _mega.offset().left;
                _mega.find('> ul').css({
                    'left': _left + 'px',
                    'width': $('nav.main-nav').width() + 'px'
                });
            });
        });


        /* Push Menu */
        $('.burger-menu').on('click', function () {
            if ($(this).hasClass('pm-right')) {
                if (!$('.push-menu').hasClass('pm-right')) {
                    $('.push-menu').addClass('pm-right');
                    setTimeout(function () {
                        $('.push-menu').addClass('show-pm');
                    }, 200);
                }
                else {
                    $('.push-menu').addClass('show-pm');
                }
            }
            else {
                if ($('.push-menu').hasClass('pm-right')) {
                    $('.push-menu').removeClass('pm-right');
                    setTimeout(function () {
                        $('.push-menu').addClass('show-pm');
                    }, 200);
                }
                else {
                    $('.push-menu').addClass('show-pm');
                }
            }
        });
        // click close pm
        $('.push-menu .close-menu').on('click', function () {
            $('.push-menu').removeClass('show-pm');
        });
        // click overlay white space
        $('.push-menu .pm-overlay').on('mouseup', function (e) {
            var container = $('.push-menu .pm-container');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('.push-menu .close-menu').trigger('click');
            }
        });
        // press ESC button
        $(document).keyup(function (e) {
            if (e.keyCode == 27) {
                if ($('.push-menu').hasClass('show-pm')) {
                    $('.push-menu .close-menu').trigger('click');
                }
            }
        });


        // fixed footer
        if ($('body').hasClass('fixed-footer')) {
            $('body > .wrapper > .content-area').css({'margin-bottom': $('#footer').height() + 'px'});
            $(window).resize(function () {
                $('body > .wrapper > .content-area').css({'margin-bottom': $('#footer').height() + 'px'});
            });
        }


        /* Scroll to top anchor */
        $('.scroll-to-top').on('click', function () {
            $('html,body').animate({scrollTop: 0}, 'slow');
            return false;
        });


        /* News slider block */
        $('.image').each(function () {
            if (typeof $(this).data('src') !== 'undefined' && $(this).data('src') != '') {
                $(this).css('background-image', 'url(' + $(this).data('src') + ')');
            }
        });

        /* Modal video player */
        $('.video-player').each(function () {
            var _video = $(this);
            let link = _video.attr("href");
            if (link.indexOf('s3-ap-southeast-2.amazonaws.com') > 0) {
                console.log("video-player: aws video " + link);
                video_id++;
                let aws_video_id='aws-video'+video_id;
                _video.attr("href", '#'+aws_video_id);
                let popup = "<div id='"+aws_video_id+"' class=\"video-popup mfp-hide\">\n" +
                    "                                                        <video controls width=\"100%\" preload=\"auto\">\n" +
                    "                                                            <source src='"+link+"' type=\"video/mp4\">\n" +
                    "                                                        </video>\n" +
                    "                                                    </div>";
                _video.after(popup);
                _video.magnificPopup({
                    type: 'inline',
                    callbacks: {
                        open: function () {
                            console.log("aws-video popup");
                            // https://github.com/dimsemenov/Magnific-Popup/issues/125
                            $('html').css('margin-right', 0);
                            // Play video on open:
                            $(this.content).find('video')[0].play();
                        },
                        close: function () {
                            // Reset video on close:
                            $(this.content).find('video')[0].load();
                        }
                    }
                });
            }
            else
                _video.magnificPopup({
                    type: 'iframe'
                });
        });
        $('.video-frame').on('click', function () {
            console.log("video-frame clicked");
            $(this).find('.video-player').click();
        });

        var msLayerAnimater = function (_active) {
            _active.find('.animate-element').each(function (ai) {
                var _el = $(this),
                    _anim = _el.data('anim');

                _el.css({
                    '-webkit-animation-duration': "0.5s",
                    '-moz-animation-duration': "0.5s",
                    '-ms-animation-duration': "0.5s",
                    '-o-animation-duration': "0.5s",
                    'animation-duration': "0.5s"
                });

                _el.css({
                    '-webkit-animation-delay': (ai * 0.2) + "s",
                    '-moz-animation-delay': (ai * 0.2) + "s",
                    '-ms-animation-delay': (ai * 0.2) + "s",
                    '-o-animation-delay': (ai * 0.2) + "s",
                    'animation-delay': (ai * 0.2) + "s"
                });
                _el.addClass('animated ' + _anim);

                _el.one(animationEnd, function () {
                    $(this).removeClass('animated ' + _anim);
                });
            });
        };

        /* News slider */
        $('.news-slider').each(function () {
            var _news_slider = $(this);
            var _id = _news_slider.find('.master-slider').attr('id');
            var slider = new MasterSlider();
            var sliderHeight = 640;

            slider.control('circletimer', {color: "#FFFFFF", stroke: 9});

            if (_news_slider.hasClass('news-slider-hover')) {

                slider.control('thumblist', {
                    autohide: false,
                    dir: 'v',
                    type: 'tabs',
                    align: 'right',
                    margin: 0,
                    space: 25,
                    width: 0,
                    height: 105,
                    hideUnder: 640
                });
                slider.control('scrollbar', '');
                sliderHeight = 600;

            } else {
                slider.control('arrows');
                slider.control('thumblist', {
                    autohide: false,
                    dir: 'v',
                    type: 'tabs',
                    align: 'right',
                    margin: 10,
                    space: 25,
                    width: 280,
                    height: 175,
                    hideUnder: 640
                });
                slider.control('scrollbar', {dir: "v"});
            }

            slider.setup(_id, {
                width: 1170,
                height: sliderHeight,
                space: 0,
                speed: 100,
                view: 'fade'
            });

            setTimeout(function () {
                slider.api.addEventListener(MSSliderEvent.CHANGE_END, function () {
                    msLayerAnimater(_news_slider.find('.ms-slide.ms-sl-selected'));
                });
            }, 400);

        });


        /* Entertainment slider */
        $('.entertainment-slider').each(function () {
            var _news_slider = $(this);
            var _id = _news_slider.find('.master-slider').attr('id');
            var slider = new MasterSlider();
            var sliderHeight = 840;

            slider.control('thumblist', {
                autohide: false,
                dir: 'v',
                type: 'tabs',
                align: 'right',
                margin: 0,
                space: 10,
                width: 0,
                height: 150,
                hideUnder: 640
            });
            slider.control('scrollbar', '');

            slider.setup(_id, {
                width: 1170,
                height: sliderHeight,
                space: 0,
                view: 'fade',
                layout: 'fillwidth'
            });

            setTimeout(function () {
                slider.api.addEventListener(MSSliderEvent.CHANGE_END, function () {
                    msLayerAnimater(_news_slider.find('.ms-slide.ms-sl-selected'));
                });
            }, 400);

        });


        /* Gallery slider */
        $('.gallery-slider').each(function () {
            var _news_slider = $(this);
            var _id = _news_slider.find('.master-slider').attr('id');
            var slider = new MasterSlider();
            var sliderHeight = 640;
            var _speed = parseInt(_news_slider.data('speed'), 10);
            _speed = _speed > 0 ? _speed : 0;

            var _thumb_width = 90;
            var _thumb_height = 60;
            var _thumb_space = 10;

            if (_news_slider.hasClass('movie-slider')) {
                _thumb_width = 270;
                _thumb_height = 160;
                _thumb_space = 30;
            }

            slider.control('thumblist', {
                autohide: false,
                dir: 'h',
                type: 'tabs',
                width: _thumb_width,
                height: _thumb_height,
                align: 'bottom',
                space: _thumb_space,
                margin: 0,
                hideUnder: 400
            });
            slider.control('arrows', {autohide: false});
            slider.control('scrollbar', {
                dir: 'h',
                color: '#444',
                align: 'bottom',
                autohide: false,
                margin: 20,
                width: 2
            });

            var _options = {
                width: 1170,
                height: sliderHeight,
                space: 0,
                preload: 'all',
                view: 'basic'
            };

            if (_speed > 0) {
                _options = $.extend(_options, {speed: _speed});
            }

            slider.setup(_id, _options);

            setTimeout(function () {
                slider.api.addEventListener(MSSliderEvent.CHANGE_END, function () {
                    msLayerAnimater(_news_slider.find('.ms-slide.ms-sl-selected'));
                });
            }, 400);

        });


        // Personal Blog Main Slider
        $('.fs-slide').each(function () {
            var _slider = $(this);

            _slider.find('.swiper-container').swiper({
                slidesPerView: 1,
                spaceBetween: 0,
                speed: 800,
                loop: true,
                nextButton: _slider.find('.fs-arrow-next'),
                prevButton: _slider.find('.fs-arrow-prev'),
                pagination: _slider.find('.fs-pagination'),
                paginationClickable: true,
                onSlideNextStart: function (swiper) {
                    var _active = _slider.find('.swiper-slide').eq(swiper.activeIndex);

                    _active.find('.fs-animate-text').each(function (ai) {
                        var _el = $(this);
                        _el.css({
                            '-webkit-animation-delay': (ai * 0.2) + "s",
                            '-moz-animation-delay': (ai * 0.2) + "s",
                            '-ms-animation-delay': (ai * 0.2) + "s",
                            '-o-animation-delay': (ai * 0.2) + "s",
                            'animation-delay': (ai * 0.2) + "s"
                        });
                        _el.addClass('animated fadeInRight');

                        _el.one(animationEnd, function () {
                            $(this).removeClass('animated fadeInRight');
                        });
                    });
                },
                onSlidePrevStart: function (swiper) {
                    var _active = _slider.find('.swiper-slide').eq(swiper.activeIndex);
                    _active.find('.fs-animate-text').each(function (ai) {
                        var _el = $(this);
                        _el.css({
                            '-webkit-animation-delay': (ai * 0.2) + "s",
                            '-moz-animation-delay': (ai * 0.2) + "s",
                            '-ms-animation-delay': (ai * 0.2) + "s",
                            '-o-animation-delay': (ai * 0.2) + "s",
                            'animation-delay': (ai * 0.2) + "s"
                        });
                        _el.addClass('animated fadeInLeft');

                        _el.one(animationEnd, function () {
                            $(this).removeClass('animated fadeInLeft');
                        });
                    });
                }
            });

        });


        /* fn fullwidth slide */
        $('.fn-fullslide').each(function () {
            var _slider = $(this);

            _slider.find('.swiper-container').swiper({
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 80,
                speed: 800,
                loop: true,
                nextButton: _slider.find('.fn-arrow-next'),
                prevButton: _slider.find('.fn-arrow-prev'),
                pagination: _slider.find('.fn-pagination'),
                paginationClickable: true
            });
        });


        /* welcome slider */
        $('.wslider').each(function () {
            var _slider = $(this);

            _slider.find('.swiper-container').swiper({
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 80,
                speed: 800,
                loop: true,
                nextButton: _slider.find('.ws-arrow-next'),
                prevButton: _slider.find('.ws-arrow-prev'),
                pagination: _slider.find('.ws-pagination'),
                paginationClickable: true
            });
        });


        /* Swiper carousel */
        $('.article-carousel').each(function () {
            var $this = $(this);
            $this.find('.swiper-container').css('width', '100%');
            $this.find('.swiper-container').swiper({
                slidesPerView: 1,
                spaceBetween: 30,
                nextButton: $this.find('.swiper-button-next'),
                prevButton: $this.find('.swiper-button-prev'),
            });
        });


        $('.m-dimension-carousel').each(function () {
            var $this = $(this),
                _col = $this.data('col'),
                _row = $this.data('row'),
                _perView = _col * _row;

            $this.find('.swiper-container').css('width', '100%');
            $this.find('.swiper-container').swiper({
                slidesPerView: _col,
                slidesPerGroup: _col,
                slidesPerColumn: _row,
                spaceBetween: 30,
                nextButton: $this.find('.swiper-button-next'),
                prevButton: $this.find('.swiper-button-prev'),
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        slidesPerGroup: 3
                    },
                    640: {
                        slidesPerView: 2,
                        slidesPerGroup: 2
                    },
                    480: {
                        slidesPerView: 1,
                        slidesPerGroup: 1
                    }
                }
            });
        });


        // Personal Blog footer instagram
        $('.footer-instagram .swiper-container').swiper({
            slidesPerView: 6,
            breakpoints: {
                1024: {
                    slidesPerView: 6
                },
                768: {
                    slidesPerView: 3
                },
                640: {
                    slidesPerView: 3
                },
                320: {
                    slidesPerView: 2
                }
            }
        });


        // carousel travel
        $('.carousel-travel').each(function () {
            var $this = $(this);
            var _col = $this.data('columns');
            var _space = $this.data('space');
            $this.find('.swiper-container').swiper({
                slidesPerView: _col,
                spaceBetween: _space,
                nextButton: $this.find('.swiper-button-next'),
                prevButton: $this.find('.swiper-button-prev'),
                breakpoints: {
                    996: {
                        slidesPerView: 3
                    },
                    767: {
                        slidesPerView: 2
                    },
                    500: {
                        slidesPerView: 1
                    }
                }
            });

            $this.addClass('loaded');
        });


        $('.tt-el-ticker').each(function () {
            var _ticker = $(this);
            var _strings = [];
            _ticker.find('.entry-ticker').find('span').each(function () {
                _strings.push($(this).html());
            });
            _ticker.find('.entry-ticker').html('');

            var option_tick = {
                strings: _strings,
                startDelay: 0,
                typeSpeed: -500,
                backSpeed: -800,
                backDelay: 5000,
                loop: true,
                onStringTyped: function (curStrPos) {
                },
                preStringTyped: function (curStrPos) {
                    _ticker.attr('data-current', curStrPos);
                }
            };

            _ticker.find('.entry-ticker').typed(option_tick);

            _ticker.find('.ticker-arrow-prev').on('click', function () {
                _ticker.attr('data-current', 0);

                var _cur = parseInt(_ticker.attr('data-current'), 10);
                var _cur_str = [];
                _cur = (_cur == 0) ? (_strings.length - 1) : _cur - 1;

                for (var i = _cur; i < _strings.length; i++) {
                    _cur_str.push(_strings[i]);
                }

                for (var i = 0; i < _cur; i++) {
                    _cur_str.push(_strings[i]);
                }

                option_tick = $.extend(option_tick, {strings: _cur_str});
                _ticker.find('.entry-ticker').text(_cur_str[0]);
                _ticker.find('.entry-ticker').typed(option_tick);
            });

            _ticker.find('.ticker-arrow-next').on('click', function () {
                _ticker.attr('data-current', 0);

                var _cur = parseInt(_ticker.attr('data-current'), 10);
                var _cur_str = [];
                _cur = (_cur == _strings.length - 1) ? 0 : _cur + 1;

                for (var i = _cur; i < _strings.length; i++) {
                    _cur_str.push(_strings[i]);
                }

                for (var i = 0; i < _cur; i++) {
                    _cur_str.push(_strings[i]);
                }

                option_tick = $.extend(option_tick, {strings: _cur_str});
                _ticker.find('.entry-ticker').text(_cur_str[0]);
                _ticker.find('.entry-ticker').typed(option_tick);
            });

            /*
            strings: ["First sentence.", "Second sentence."],
            stringsElement: null,
            typeSpeed: 0,
            startDelay: 0,
            backSpeed: 0,
            backDelay: 500,
            loop: false,
            loopCount: false,
            showCursor: true,
            cursorChar: "|",
            attr: null,
            contentType: 'html',
            callback: function() {},
            preStringTyped: function() {},
            onStringTyped: function() {},
            resetCallback: function() {}
            */

        });


        $('#search_handler').on('click', function () {
            $('#header').toggleClass('show-search');
            setTimeout(function () {
                $('#header .search-panel input').eq(0).focus();
            }, 100);
        });

        $('#header .search-panel a.close-search').on('click', function () {
            $('#header').removeClass('show-search');
        });

        // Sticky header on scroll action
        var headerHeight = $('#header.sticky').height();
        $('#header.sticky').next().css('margin-top', headerHeight);

        var lastScroll = $(window).scrollTop;
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll > lastScroll && headerHeight < lastScroll) {
                $("#header").addClass('unpinned');
            } else if (scroll < lastScroll && scroll < lastScroll - 20 || scroll < headerHeight) {
                $("#header").removeClass('unpinned');
            }
            lastScroll = scroll;
        });


        // Profile dropdown
        $('.entry-name').on('click', function () {
            $(this).find('.entry-dropdown').toggleClass('open');
        });

        // Search form handler
        $('.search-handler.search-fashion').on('click', function () {
            $(this).parent().toggleClass('show-form');
            if ($(this).parent().hasClass('show-form')) {
                $(this).parent().find('form input[type="text"]').eq(0).focus();
            }
        });


        // Simple Tab
        $('.simple-tab-space').each(function () {
            var _tab = $(this);
            _tab.find('.tab-title a').on('click', function (event) {
                event.preventDefault();
                _tab.find(".tab-title a").removeClass('active');
                $(this).addClass('active');
                _tab.find(".tab-panel .tab-content").removeClass('active');
                _tab.find(".tab-panel .tab-content").eq(_tab.find(".tab-title a").index($(this))).addClass('active');
            });
        });


        // Circle chart
        $('.circle-chart').each(function (ci) {
            var _circle = $(this),
                _id = 'circle-chart' + ci,
                _width = _circle.data('circle-width'),
                _percent = _circle.data('percent'),
                _text = _circle.data('text');

            _percent = (_percent + '').replace('%', '');
            _width = parseInt(_width, 10);

            _circle.attr('id', _id);
            var _cc = Circles.create({
                id: _id,
                value: _percent,
                text: _text,
                radius: 100,
                width: _width,
                colors: ['rgba(255,255,255, .05)', '#f84432']
            });

        });


        // Twitter share
        $('.twitter-shareable').on('click', function () {
            var _share = $(this);
            var _addr = window.location.href;
            window.open("http://twitter.com/share?url=" + _addr + "&text=" + _share.text(), "twitterwindow", "height=450, width=550, top=" + ($(window).height() / 2 - 225) + ", left=" + ($(window).width() / 2 - 275));
        });


        // Personal blog carousel
        $('.fs-blog-carousel').each(function () {
            var $fs = $(this),
                _col = $fs.data('col'),
                _row = $fs.data('row'),
                _responsive = $fs.data('responsive'),
                _pager = 0,
                _perView = _col * _row,
                _arr_responsive = [3, 2, 1];

            var _space = 30;
            if ($fs.hasClass('testimonial-slider') == true) {
                _space = 0;
            }

            if (_responsive !== 'undefined') {
                var _exp = _responsive.split(',');
                if (_exp.length > 2) {
                    _arr_responsive[0] = parseInt(_exp[0], 10);
                    _arr_responsive[1] = parseInt(_exp[1], 10);
                    _arr_responsive[2] = parseInt(_exp[2], 10);
                }
            }

            _pager = ($fs.find('.swiper-slide').length % _perView) > 0 ? parseInt($fs.find('.swiper-slide').length / _perView, 10) + 1 : parseInt($fs.find('.swiper-slide').length / _perView, 10);

            $fs.find('.fs-current-total').html(_pager);
            //fs-current-index

            $fs.find('.swiper-container').swiper({
                pagination: '.swiper-pagination',
                slidesPerView: _col,
                slidesPerGroup: _col,
                slidesPerColumn: _row,
                paginationClickable: true,
                spaceBetween: _space,
                prevButton: $fs.find('.swiper-prev'),
                nextButton: $fs.find('.swiper-next'),
                onSlideChangeEnd: function (swiper) {
                    var _current = (swiper.activeIndex % _col) > 0 ? parseInt(swiper.activeIndex / _col) + 2 : parseInt(swiper.activeIndex / _col) + 1;
                    $fs.find('.fs-current-index').html(_current);
                },
                breakpoints: {
                    768: {
                        slidesPerView: _arr_responsive[0]
                    },
                    640: {
                        slidesPerView: _arr_responsive[1]
                    },
                    320: {
                        slidesPerView: _arr_responsive[2]
                    }
                }
            });
        });


        // Scroll indicator
        $(window).scroll(function () {
            var _document_height = $(document).height(),
                _window_height = $(window).height(),
                _scroll_top = $(window).scrollTop(),
                _w = 0;

            _w = _scroll_top * 100 / (_document_height - _window_height);

            $('.scroll-window-indicator').find('> div').width(_w + '%');
        });


        // animated blocks
        $('.animated-blocks').each(function () {
            var _block = $(this);

            _block.waypoint({
                handler: function (direction) {
                    if (!_block.hasClass('ab-animated')) {
                        _block.find('.ab-item').each(function (bi) {
                            var _el = $(this);
                            _el.css({
                                '-webkit-animation-delay': (bi * 0.2) + "s",
                                '-moz-animation-delay': (bi * 0.2) + "s",
                                '-ms-animation-delay': (bi * 0.2) + "s",
                                '-o-animation-delay': (bi * 0.2) + "s",
                                'animation-delay': (bi * 0.2) + "s"
                            });
                            _el.addClass('animated fadeInUp ab-visible');

                            _el.one(animationEnd, function () {
                                $(this).removeClass('animated fadeInUp');
                            });
                        });

                        _block.addClass('ab-animated');
                    }
                },
                continuous: false,
                offset: '75%'
            });
        });


        $('a.ms-love').on('click', function () {
            $(this).toggleClass('active');
        });

    });


    if ($('#msplayer').length) {
        var svg_pp = new SVGMorpheus('#ms_play_pause');
        var svg_vol = new SVGMorpheus('#ec_volume');

        $('#msplayer').mediaelementplayer({
            features: ['current', 'progress', 'duration', 'tracks'],
            success: function (media, node, player) {
                var events = ['loadstart', 'play', 'pause', 'ended'];
                var playlist = {playing: 0, list: []};

                $('#music_player .pl-list').find('.tr-item').each(function () {
                    var _row = $(this);
                    var _rid = _row.data('id');
                    var _audio = _row.find('.pl-audio-item').data('url');
                    var _thumb = _row.find('.pl-audio-item').data('thumb');
                    var _title = _row.find('.pl-audio-item').find('.pl-item-title').text();
                    var _artist = _row.find('.pl-audio-item').find('.pl-item-artist').text();

                    playlist.list.push({id: _rid, audio: _audio, thumb: _thumb, title: _title, artist: _artist});
                });


                // load song
                var load_song = function (load_index) {
                    if (playlist.list.length > 0 && playlist.list.length > load_index && load_index > -1) {
                        var _current_media = playlist.list[load_index];
                        playlist.playing = load_index;
                        media.setSrc(_current_media.audio);
                        media.load();

                        $('#music_player .ms-nowplaying').find('.np-thumb').attr('src', _current_media.thumb);
                        $('#music_player .ms-nowplaying').find('.np-title').text(_current_media.title);
                        $('#music_player .ms-nowplaying').find('.np-artist').text(_current_media.artist);
                        $('#music_player .pl-list').find('.tr-item .td-num .number.playing').removeClass('playing');
                        $('#music_player .pl-list').find('.tr-item').eq(load_index).find('.td-num .number').addClass('playing');
                    }
                }

                // play song
                var play_song = function () {
                    media.play();
                }

                // play previous previous
                var play_prev = function () {
                    if (playlist.playing == 0 && playlist.list.length > 0) {
                        playlist.playing = playlist.list.length - 1;
                    }
                    else {
                        playlist.playing = playlist.playing - 1;
                    }
                    load_song(playlist.playing);
                    play_song();
                }

                // play next song
                var play_next = function () {
                    if (playlist.list.length > 0 && playlist.playing == playlist.list.length - 1) {
                        playlist.playing = 0;
                    }
                    else {
                        playlist.playing = playlist.playing + 1;
                    }

                    if ($('#music_player .ms-control-shuffle').hasClass('active')) {
                        playlist.playing = Math.floor(Math.random() * playlist.list.length - 1);
                    }

                    load_song(playlist.playing);
                    play_song();
                }

                // set first audio file
                if (playlist.list.length) {
                    load_song(0);
                }

                // player events
                for (var i = 0, il = events.length; i < il; i++) {
                    var eventName = events[i];
                    media.addEventListener(events[i], function (e) {
                        if (e.type == 'play') {
                            $('#music_player .ms-play').addClass('ms-pause');
                            svg_pp.to('ms_pause', {duration: 400, rotation: 'none'});
                        }
                        else if (e.type == 'pause') {
                            $('#music_player .ms-play').removeClass('ms-pause');
                            svg_pp.to('ms_play', {duration: 400, rotation: 'none'});
                        }
                        else if (e.type == 'loadstart') {

                        }
                        else if (e.type == 'ended') {
                            var _current_number = playlist.playing;

                            if (playlist.playing == playlist.list.length - 1) {
                                if ($('#music_player .ms-control-repeat').hasClass('active')) {
                                    _current_number = 0;
                                }
                                else {
                                    _current_number = -1;
                                }
                            }
                            else {
                                if ($('#music_player .ms-control-shuffle').hasClass('active')) {
                                    _current_number = Math.floor(Math.random() * playlist.list.length - 1);
                                }
                                else {
                                    _current_number += 1;
                                }

                            }

                            console.log('ended', _current_number);

                            if (_current_number > -1) {
                                load_song(_current_number);
                                play_song();
                            }
                        }
                    });
                }

                // play action
                $('#music_player .ms-play').on('click', function () {
                    if (media.paused) {
                        media.play();
                    }
                    else {
                        media.pause();
                    }
                });

                // previous action
                $('#music_player .ms-prev').on('click', function () {
                    play_prev();
                });

                // next action
                $('#music_player .ms-next').on('click', function () {
                    play_next();
                });

                // Volume
                $('#music_player .ec-vol-el').slider({
                    orientation: "vertical",
                    range: "min",
                    min: 0,
                    max: 100,
                    value: 80,
                    slide: function (event, ui) {
                        media.setVolume(ui.value / 100);
                    }
                });

                $('#music_player .ms-controls .ec-volume a').on('click', function () {
                    $(this).toggleClass('ec-vol-mute');
                    if ($(this).hasClass('ec-vol-mute')) {
                        media.setVolume(0);
                        svg_vol.to('vol_mute', {duration: 400, rotation: 'none'});
                        $('#music_player .ec-vol-el').slider('value', 0);
                    }
                    else {
                        media.setVolume(0.8);
                        svg_vol.to('vol_max', {duration: 400, rotation: 'none'});
                        $('#music_player .ec-vol-el').slider('value', 80);
                    }
                });

                // shuffle
                $('#music_player .ms-control-shuffle').on('click', function () {
                    $('.ms-control-shuffle').toggleClass('active');
                });

                // repeat
                $('#music_player .ms-control-repeat').on('click', function () {
                    $(this).toggleClass('active');
                });

                // playlist
                $('#music_player .pl-list .tr-item .pl-audio-item').on('click', function () {
                    var _index = $('#music_player .pl-list .tr-item').index($(this).parents('.tr-item'));
                    load_song(_index);
                    play_song();
                });

            }
        });
    }


    $(window).load(function () {

        // page loaded
        $('body').addClass('page-loaded');

        // parallax columns
        $('.parallax-columns-container').parallaxColumn();

        //sticky
        $('.sticky-parent').each(function () {
            var _sticky = $(this),
                _this = this;
            _sticky.find('.sticky-column').theiaStickySidebar({
                containerSelector: _this,
                additionalMarginTop: 30,
                minWidth: 768
            });
        });


        // masonry layout
        $('.masonry-layout').each(function () {
            var _masonry = $(this);
            var _col_width = _masonry.data('col-width') + '';
            if (_col_width.indexOf('col-') < 0) {
                _col_width = '.col-sm-2';
            }

            _masonry.isotope({
                itemSelector: '.masonry-item',
                masonry: {
                    columnWidth: _col_width
                }
            });

            _masonry.find('.fs-post-filter a').on('click', function () {
                var filter = $(this).data('filter');
                _masonry.isotope({filter: filter});

                _masonry.find('.fs-post-filter li').removeClass('active');
                $(this).parent().addClass('active');
            });

        });


        $('.masonry-layout1.masonry-no-col').each(function () {
            var _masonry = $(this);

            _masonry.isotope({
                itemSelector: '.masonry-item',
                masonry: {
                    columnWidth: 1
                }
            });
        });


        // Fullwidth section
        var fullscreen_func = function () {
            $('.fullwidth-section, .fullscreen-section').each(function () {
                var $this = $(this);
                var $wrapper = $('body');

                $this.css('margin-left', '0px');

                var margin_left = $this.offset().left - $wrapper.offset().left;
                var _width = $wrapper.width();

                $this.css({
                    'margin-left': -margin_left,
                    'width': _width + 'px'
                });

                if ($this.hasClass('fullscreen-section') && !$this.hasClass('tt-slider'))
                    $this.height($(window).height());
            });
        };
        fullscreen_func();
        $(window).resize(function () {
            fullscreen_func();
        });


        // Parallax
        $('[data-section-type="parallax"]').each(function () {
            var _this = $(this);
            var _bg = _this.css('background-image') + '';
            _bg = _bg.replace('url("', '').replace('")', '');

            _this.attr('data-stellar-ratio', '2');
            _this.attr('data-stellar-background-ratio', '0.5');
            _this.css('background-attachment', 'fixed');
        });

        if (!isTouchDevice() && $('[data-section-type="parallax"]').length) {
            $(window).stellar({
                horizontalScrolling: false,
                verticalScrolling: true,
                responsive: true,
                verticalOffset: 0,
                parallaxBackgrounds: true,
                parallaxElements: false
            });
        }


        /* Welcome page portfolio */
        $('.welcome-folio').each(function () {
            var _folio = $(this);

            _folio.find('.wpf-viewport').isotope({
                itemSelector: '.masonry-item',
                masonry: {
                    columnWidth: '.col-lg-3'
                }
            });

            _folio.find('.wpf-filter a').on('click', function () {
                var filter = $(this).data('filter');
                _folio.find('.wpf-viewport').isotope({filter: filter});

                _folio.find('.wpf-filter a.active').removeClass('active');
                $(this).addClass('active');
            });
        });


    });


})(jQuery);