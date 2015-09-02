var moreText  = 'More';
var lessText  = 'Less';
var filterDiv = '#filters';
var menus     = ".context-menu,.search-options,.has-option .options,.custom-menu";
var expects   = "li.more,span,#srch-down,.right-icon,#details-btn";
var menu_dimmer = "#wrapper, .fixed";
var fav_btns = '.faved,.notfaved';
var details_btn = '#details-btn';
var last_select = '';
var time = 1;
var max_filename_lenght = 21;
$('document').ready(function() {
	var namespace = $('body');
	var __sidebar_menu = $('#sideBarMenu');
	var __mobile_menu = $('#mobileMenu');
	$('#tabs').tab();

	function isPreviewOpen() {
		return ($('#preview').css('right') === '0px');
	}

	function togglePreview(open) {
		var value;
		if (open) {
			value = '0px';
		} else {
			value = '-282px';
		}
		$('#preview').animate({
		  	right: value
		}, function(){
			hideMenus();
		}).removeClass('hidden');
		$('body').toggleClass('compactvu');
	}

	function closeAllFilters() {
		var filter = $(filterDiv);
		$('.filter-group',$(filter)).removeClass('max').addClass('min');
	}

	function hideMenus() {
		$(menus).hide();
	}

	function showMenu() {
		$('#top .menu').css({'visibility':'visible'});
	}

	function restoreMenu() {
		$('.menu').css({'visibility':'hidden'});
		setActivePath('',false);
	}

	function hSelect(that,triggerName) {
		last_select = that;
		$(that).addClass('hh').trigger(triggerName);
		$(details_btn).show();
	}

	function unSelect(restore) {
		$('.hh').removeClass('hh');
		$(details_btn).hide();
		if(restore)
			restoreMenu();
	}

	function isMoreOpen()
	{
		return $('.menu li.more .context-menu').is(':visible');
	}

	function shortenName(name)
	{
		if(name.length > max_filename_lenght)
			return name.substr(0,max_filename_lenght)+'...';
		return name;
	}

	function setActivePath(name,show) {
		name = shortenName(name);
		$('.path .active a').text(name);
		if (show) {
			$('.path .active').show();
			$('.path').addClass('hf');
		}
		else {	
			$('.path .active').hide();
			$('.hf').removeClass('hf');
		}

	}

	$('a',$(menus)).click(function(){
		hideMenus();
	});

	$('button#details-btn, #close-prev button').click(function(event){
		/*togglePreview($('#preview').css('right') === '-282px');
		if(isPreviewOpen()==false)
			$('button#details-btn, #close-prev button').addClass('preOpen');
		else
			$('button#details-btn, #close-prev button').removeClass('preOpen');
		*/
		
	});

	$(namespace).on('click','.right-icon, .user-login img',function(event){
		$(this).toggleClass('expanded');
		if($('#user-context ul.context-menu').is(':visible'))
			$('#user-context ul.context-menu').hide();
		else
		{
			hideMenus();
			$('#user-context ul.context-menu').show();			
		}
	});

	$(namespace).on('click','.fv',function(event){
		$('#tabs a[href="#versions"]').tab('show');
		$('#preview').modal();
	});	

	$(namespace).on('click', '.menu ul li',function(e){		
		if($('.context-menu',this).is(':visible'))
			$('.context-menu',this).hide();
		else
		{
			hideMenus();
			$('.context-menu',this).show();			
		}
	});

	$(namespace).on('click', '#srch-inp-btn',function(e){
		if($('#mobSrch').is(':visible'))
			$('#mobSrch').fadeOut();
		else
		{
			hideMenus();
			$('#mobSrch').fadeIn();			
		}		
	});	

	$(namespace).on('click', '.ur button.bk',function(e){
		if($('#mobSrch').is(':visible'))
			$('#mobSrch').fadeOut();
		else
		{
			hideMenus();
			$('#mobSrch').fadeIn();			
		}	
	});	

	$(namespace).on('click', '#spaces li.more',function(ev){
		var open = $(this).hasClass('open');
		if(open)
		{
			$('#spaces .extra-div').slideUp();
			$(this).text(moreText);			
		}
		else
		{
			$(this).text(lessText);				
			$('#spaces .extra-div').slideDown();
			var f = $('.block-prefs button.sm-btn').hasClass('min');
			var y = screen.height;
			if(f && y <= 800){
				$('.block-prefs button.sm-btn').trigger('click');
			}			
		}
		$(this).toggleClass('open');
	});

	$(namespace).on('click', '.block-prefs button.sm-btn',function(e){
		e.preventDefault();
		var open = $(this).hasClass('min');
		if(open)
		{
			$(filterDiv + ' .block-wrapper').slideUp();
		}
		else
		{
			$(filterDiv + ' .block-wrapper').slideDown();
			var f = $('#spaces li.more').hasClass('open');
			if(f){
				$('#spaces li.more').trigger('click');
			}
		}
		$(this).toggleClass('min');
	});

	$(namespace).on('click', 'button.btn-act',function(e){
	    $(filterDiv + ' input:checkbox').attr('checked',false);
	});	

	$(namespace).on('click', '.filter-title',function(e){
		var parent = $(this).parent();
		if($(parent).hasClass('min')){
			//closeAllFilters();
			$(parent).removeClass('min').addClass('max');
			$('ul',$(parent)).show();
		}
		else{
			$('ul',$(parent)).hide();
			$(parent).removeClass('max').addClass('min');
		}
		$(this).parent().parent().toggleClass('inScrolling');
	});

	$(namespace).on('click', '#srch-down',function(e){
		e.preventDefault();
		e.stopPropagation();
		if($('.search-options').is(':visible'))
			$('.search-options').hide();
		else
		{
			hideMenus();
			$('.search-options').show();			
		}			
	});

	$('.has-option span').click(function(){
		if($('ul.options',$(this).parent()).is(':visible'))
			$('ul.options',$(this).parent()).hide();
		else
		{
			hideMenus();
			$('ul.options',$(this).parent()).show();			
		}		
	});

	$(namespace).on('click', '#grid-view-btn',function(r){
		$('#grid-files').show();
		$('#files').hide();
		$('#row-view-btn').removeClass('enable');
		$(this).addClass('enable right');
		$('.table-header').hide();
		$('body').removeClass('rowView').addClass('gridView');
	});
	$(namespace).on('click', '#row-view-btn',function(r){
		$('#files').show();
		$('#grid-files').hide();
		$('#grid-view-btn').removeClass('enable');
		$(this).addClass('enable');
		$('.table-header').show();
		$('body').removeClass('gridView').addClass('rowView');
	});	

	$(namespace).on('click', '.file-row,.grid-item',function(e){
		showMenu();
		var name = $('.filename',$(this)).text();
		if(!name)
			name = $('.fn',$(this)).text();
		setActivePath(name,true);
		unSelect(false);
		hSelect(this,'');
	});
	/* Remove these two in productive site : : : */
	$(namespace).on('click', '#wsp',function(){
		$('#files').hide();
		$('#grid-files').hide();
		$('.table-header').hide();
		$('#nofiles').show();
		$('.selected').removeClass('selected');
		$(this).parent().addClass('selected');
	});
	$(namespace).on('click', '#doc',function(){
		$('#files').show();
		$('#grid-files').hide();
		$('.table-header').show();
		$('#nofiles').hide();
		$('.selected').removeClass('selected');
		$(this).parent().addClass('selected');
	});

	/* : : : */

	$(document).mouseup(function (e)
	{
		if(e.which > 1) // Left Click
			return;
	    var container = $(".context-menu,.search-options,.has-option .options,.custom-menu");

	    if($(e.target).is($(expects))) {
	    	return true;
	    }

	    var canDeSelect = true;
	    if($(e.target).is($(menu_dimmer))) {		    	
	    	var isOpen = isMoreOpen() ? 1 : 0;	     	
	    	if(isOpen)
	    	{
		    	canDeSelect = false;
		    	hideMenus();
	    	}
	    	else
	    		restoreMenu();
	    	time++;	    	
	    }

	    if($(e.target).is($(__sidebar_menu))) {
	    	$(__sidebar_menu).css({'background-color':'transparent'});
	        setTimeout( function() {
		    	$(__sidebar_menu).animate({
		            left: '-100%'
		        }, function(){	            
		        });
	        }, 200);	    	
	    }	

	    if($(e.target).is($(__mobile_menu))) {
	    	$(__mobile_menu).hide();
	    }

	    if (!container.is(e.target) // if the target of the click isn't the container...
	        && container.has(e.target).length === 0) // ... nor a descendant of the container
	    {
	        container.hide();
	        if (canDeSelect)
	        {
	            unSelect(true);
	        }
	    }

	    container.hide();
	});

	$('.file-row,.grid-item').bind("contextmenu", function(event) {
	    event.preventDefault();
	    unSelect(false);
	    hideMenus();
	    var file_id = $(this).attr('data-fid');
	    $('.custom-menu').remove();
	    $('li a',$('#custom-right-menu')).attr('data-fid',file_id);
	    var customMenu = $('#custom-right-menu').html();
	    var x = screen.width;
	    var y = screen.height;
	    var m = $('#custom-right-menu').width();
	    var n = $('#custom-right-menu').height();
	    var xp = event.pageX;
	    var yp = event.pageY;
	    if(xp + (1.5)*m >= (x-100))
	    	xp = xp - (1.5)*m;
	    if(yp + (1.5)*n >= y)
	    	yp = yp - (1.5)*n;
	    else
	    	yp -= 130;
	    $("<ul class='custom-menu'>"+customMenu+"</ul>")
	        .appendTo("body")
	        .css({top: yp + "px", left: xp+ "px"});
	    hSelect(this,'click');
	});

	$('div#filters .block-wrapper').enscroll({
	    showOnHover: false,
	    verticalTrackClass: 'track3',
	    verticalHandleClass: 'handle3'
	});

	$(namespace).on('click', '.prop-dialog', function() {
		var open = isPreviewOpen();
		if ( open == false ) {
			togglePreview(!open);
		}
   	});	

   	$('#filters .block-header span',$(namespace)).click(function(){
   		$('.block-prefs button.sm-btn').trigger('click');
   	});

   	$(namespace).on('click', fav_btns,function(e){
		var faved = $(this).hasClass('faved');
		if(faved)
			$(this).removeClass('faved').addClass('notfaved');
		else
			$(this).removeClass('notfaved').addClass('faved');
	});
	$(details_btn).hide();
});