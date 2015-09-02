jQuery(document).ready(function($){
	var base_url = 'http://weblogestaan.ir/';
	var current = 0; // Progress bar
	var interval;    // Progressbar
	var logged_in = $('body').hasClass('logged-in');
	/**  Auto Pagination variables :  **/
	var isLoading = false;
	var isDataAvailable = true;
	var page = 1;
	/***********************************/
	function resetAutoPaginationVariables(){
		isLoading = false;
		isDataAvailable = true;
		page = 1;		
	}
	var NEWS_PAGE_CLASS = 'gishe';
	var view_name = NEWS_PAGE_CLASS;
	var view_id = 2;
	var need_scroll = true;
	var opt = {
		'subjects':[0,1,1], // [view_id,isGrid]
		'bookmarks':[1,0,1],
		'gishe':[2,0,1],
		'timeline':[3,0,1],
	};	
	/*** #main selector for isotope ***/
	var $container = '';

	function resetMainStyle(){
		$container.attr('style','');
	}
	$.Isotope.prototype._positionAbs = function( x, y ) {
	    return { right: x+20, top: y };
	};
	$('ul#dashboard li a').click(function(e){
		//e.preventDefault();
		e.stopPropagation();
		resetAutoPaginationVariables();
		$('ul#dashboard li a').removeClass('hit');
		$(this).addClass('hit');
		var code = $(this).attr('href').replace('#/','');
		if(code=='' || code == ' ')
			code = NEWS_PAGE_CLASS;
		var title = $(this).text();
		var view = opt[code][0];
		var grid = opt[code][1];
		var xhr = new XMLHttpRequest();
		xhr.open('GET', base_url+"v/"+view+"/0/l?ok=BEZAR17");
		xhr.addEventListener("load", uploadAfterSuccess, false);
		xhr.addEventListener("error", uploadOnError, false);
		xhr.addEventListener("progress", uploadOnProgress, false);
		xhr.mod_grid = grid;
		xhr.mod_title = title;
		xhr.mod_code = code;
		current = 0;
		uploadBeforeSubmit(xhr);
		xhr.send();
	});
	function uploadAfterSuccess(e){
		hideProgress();
		var res = e.currentTarget.response;
		if(res.indexOf('-+-error-+-')<0)
		{
			$('#main').removeClass();
        	$('#main').addClass('page-id-'+e.currentTarget.mod_code);
			$('#main').html(res);
        	Drupal.attachBehaviors();
        	if(e.currentTarget.mod_grid == 0)
        		$('#main').removeClass('grid');
        	else
        		$('#main').addClass('grid');
        	$('#midd-header').removeClass().addClass('icon-'+e.currentTarget.mod_code)
        	$('#midd-header h2').text(e.currentTarget.mod_title);
        	if(e.currentTarget.mod_code == NEWS_PAGE_CLASS)
        	{
	        	$container.isotope('reloadItems').isotope();
        	}
        	else
        		resetMainStyle();
        	view_name = e.currentTarget.mod_code;
        	need_scroll = opt[view_name][2];
        	view_id = opt[view_name][0];
        	$("html, body").animate({ scrollTop: 0 }, "slow");
		}
	}
	function uploadBeforeSubmit(e){
		current = 0;
		$('#currentProgress').attr('style','width:'+current+'%');
		$('#progressbar').hide().show();
		interval = setInterval(progressSimulate,100);
	}
	function uploadOnError(event){

	}
	function uploadOnProgress(e)
	{

	}
	
	function hideProgress(){
		$('#currentProgress').attr('style','width:100%');
		setTimeout(function(){$('#progressbar').hide();},600);
		clearInterval(interval);
	}
	function progressSimulate(){
		current += 20;
		if(current <= 80)
			$('#currentProgress').attr('style','width:'+current+'%');
		else
			clearInterval(interval);
	}

	function initiso()
	{
		$container = $('#main').imagesLoaded( function() {
		    iso();
		});
	}
	function iso(){
		resetMainStyle();
		$container.isotope({
			itemSelector: '.mag-item',
		    layoutMode: 'masonry',
		    masonry: {
		      columnWidth: 266,
		      gutter: 200,
		      isOriginLeft: false,
		    },
		    isOriginLeft: false,
		    transformsEnabled: false,
		});		
	}


	$(window).scroll(function () {
		console.log(view_name,view_id,need_scroll);
		if(logged_in == false)
			return;
		if(need_scroll == 0 || need_scroll == false)
			return;
        if ($(document).height() <= ($(window).scrollTop() + $(window).height() + 350)) {
            if(isLoading == false && isDataAvailable)
            {
            	isLoading = true;
            	$.ajax({
		          type: "GET",
		          url: base_url+"v/"+view_id+"/0/l?ok=BEZAR17&page="+page,
		          success: function (result) {
		            isLoading = false;
		            page++;
		            switch(view_name)
		            {
		            	case NEWS_PAGE_CLASS :
		            		$container.isotope( 'insert', $(result) );
		            	break;

		            	default:
		            		$container.append($(result));
		            	break;
		            }
		            Drupal.attachBehaviors();
		            if (result == '') 
                		isDataAvailable = false;
		          },
		          error: function (error) {
		          	isLoading = false;
		            console.log(error);
		          }
		        });
            }
        }
    });
    if(logged_in)
    {
    	$('#edit-search-block-form--2').attr('placeholder',Drupal.t('Search'));	
    }
    
    if(logged_in && $('.view-user-main-subject-menu').length>0)
    {
    	var limit = 6;
    	$('.view-user-main-subject-menu li').slice(limit).hide(function(){
	    	$(this).addClass('outed-li');
    	});
    	if($('.view-user-main-subject-menu li').length>limit)
    	{
    		$('.view-user-main-subject-menu .inline-list').append('<li class="more-li">&nbsp;<div></div></li>');    		
    	}
    };
	$('.more-li').live('click',function(){
		if($(this).hasClass('open') == false){
			$('.outed-li a').each(function(){
				$('.more-li div').append($(this));
			});
			$('.more-li div').show();			
		}
		else
		{
			$('.more-li div').hide();
		}
		$(this).toggleClass('open');
	});    

    initiso();

});