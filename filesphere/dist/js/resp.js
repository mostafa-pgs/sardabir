$('document').ready(function(){
    var namespace = $('body');
	var __window = $(window);
    var __nav_btn = '#nav-btn';
	var __nav_button = $('#nav-btn-holder');
	var __left_side = $('#left-side');
    var __sidebar_menu = $('#sideBarMenu');
	var __sidebar_holder = $('#sideBarMenu div.h');
    var __upload_button = $('#upload-btn');
    var __mobSrch_holder = $('#mobSrch');
    var __mobSrch = $('#mobSrch .ur');
    var __srch_form = $('#srch-box form');
    var _last_upload_btn_text = '';
    var __username_tag = $('.right-icon');
    var __filter_div = $('div#filters .block-wrapper');
    var _last_username = '';
    var _username_length = 14;
	var TABLET_MAX_WIDTH = 1000;
    var MOBILE_MAX_WIDTH = 600;
    var MOBLIE_MIN_WIDTH = 320;

    var LARGE_SCREEN_HEIGHT = 1200;
    var MEDUIM_SCREEN_HEIGHT = 800;


	__window.on('resize', function ()
    {
        _width  = __window.width();
        _height = __window.height();

        if (_width <= TABLET_MAX_WIDTH) {
        	CreateSideBar();
            TrimMenu();
            trimUsername(true);
            console.log(1);
            uploadBtn(true);
        }
        else
        {
        	unTrimMenu();
            trimUsername(false);
            uploadBtn(false);
            console.log(2);
        }

        if (_width <= MOBILE_MAX_WIDTH) {
            uploadBtn(true);
            unTrimMenu();
            console.log(3);
            setMoblieView(true);
        }
        else {
            setMoblieView(false);
        }

        if(_width > MOBLIE_MIN_WIDTH) {
            $('body').addClass('tf');
        }
        else
            $('body').removeClass('tf');   

        sameSize();
        setFilterHeight();
    });

    $(namespace).on('click', __nav_btn, function() {
        if($(this).hasClass('open')) {
            // close it
            Sidebar(false).removeClass('open');
        }
        else
            // open it
        {
            Sidebar(true).addClass('open');
        }
    });

    $(namespace).on('click','.tdr.mob button',function(e){
        e.preventDefault();
        e.stopPropagation();
        CreateMobileContextMenu(this);
    });

    function setFilterHeight()
    {
        var y = screen.height;
        if(y <= MEDUIM_SCREEN_HEIGHT)
            $(__filter_div).height(215);
        else if (y>MEDUIM_SCREEN_HEIGHT && y<=LARGE_SCREEN_HEIGHT)
            $(__filter_div).height(500);
        else
            $(__filter_div).height(600);
    }

    function Sidebar(show) {
        var value;
        if (show) {
            value = '0';
        } else {
            value = '-100%';
        }
        $('#sideBarMenu').animate({
            left: value
        }, function(){
            //hideMenus();
            if(show)
                $('#sideBarMenu').css('background-color','rgba(0,0,0,0.4)');
            else
                $('#sideBarMenu').css('background-color','transparent');
        });

        return $(__nav_button);
    }

	function NavButton(show) {
		if(show)
			$(__nav_button).show();
		else
			$(__nav_button).hide();

        return $(__nav_button);
	}

    function CreateSideBar() {
    	var html = $(__left_side).html();
    	$(__sidebar_holder).html(html);
    }

    function DestroySidebar() {
    	$(__sidebar_holder).hide();
    }

    var trimmed = false;
    function TrimMenu() {
        if(trimmed)
            return;
        var extra = $('.id-share').parent();
        extra = extra[0];
        $('.context-group.first').prepend($(extra));
        extra = $('.id-download').parent();
        extra = extra[0];
        $('.context-group.first').prepend($(extra));
        trimmed = true;
    }

    function unTrimMenu() {
        if(trimmed == false)
            return;
        var extra = $('.id-download').parent();
        extra = extra[0];
        $('.menu li.more').before($(extra));
        //$(extra).remove();
        trimmed = false;
    }

    function setLastUploadName() {
        _last_upload_btn_text = $(__upload_button).text();
    }

    function uploadBtn(min) {
        if(min) {
            $(__upload_button).text('').addClass('md');
        }
        else {
            $(__upload_button).text(_last_upload_btn_text).removeClass('md');
        }
    }

    function setLastUsername() {
        _last_username = $(__username_tag).text();
    }

    function trimUsername(trim) {
        if(trim) {
            var name = _last_username;
            if(name.length > _username_length)
            {
                name = name.substring(0, _username_length) + '...';
                $(__username_tag).text(name).addClass('trimmed');
            }
        }
        else
            $(__username_tag).text(_last_username).removeClass('trimmed');
    }

    function setMoblieView(set) {
        if(set)
            $('body').addClass('mobile-view');
        else
            $('body').removeClass('mobile-view');
    }

    function sameSize() {
        var w = ($('body').hasClass('rowView')) ? $('#files').width() : $('#grid-files').width();
        $('#nav').css(
            'width', w+'px'
        );
    }

    function CreateMobileContextMenu(that) {
        var top = $('.path').html();
        var content = $('#top .menu').html();
        var inMenu = $('.context-menu',$(content)).html();

        var name = $('.filename',$(that).parent().parent()).text();
        if(!name)
            name = $('.fn',$(that).parent().parent()).text();  
        $('.hk').html('');

        $('.hk').append($('<div>').addClass('kmm').append($(top)));
        $('.hk').append($('<div>').addClass('kll').append($(content)));
        $('.hk .more').remove();
        $('.ajo').remove();
        $('.kll').append($('<ul>').addClass('ajo').append($(inMenu)));

        $('ul .active a',$('.hk')).text(name);
        $('.kmm .active').css('display','inline-block');
        $('#mobileMenu').show();
    }

    function CreateSearchBox() {
        $(__mobSrch).append(__srch_form);
    }
  

    function init() {
        $('body').addClass('rowView');
        setLastUsername();
        setLastUploadName();
        sameSize();
        setFilterHeight();
        $(__window).resize();
    }

    init();
});