// How many people online
var _wau = _wau || [];
_wau.push(["tab", "ffi277rwmtho", "cys", "left-middle"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/tab.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();

// Get $_GET
function getQueryParams(qs) {
	qs = qs.split("+").join(" ");
	var params = {}, tokens, re = /[?&]?([^=]+)=([^&]*)/g;
	while (tokens = re.exec(qs)) {
		params[decodeURIComponent(tokens[1])]
			= decodeURIComponent(tokens[2]);
	}
	return params;
}
var $_GET = getQueryParams(document.location.search);

// Jquery
//////////////////////// Popup Fancybox ///////////////////////////////////////
function popupCenter(pageURL, w, h,modal) {
        /*var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var popupWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        popupWin.focus();
        */
        if (modal == "undefined") modal = false;
        $.fancybox({
            'autoDimensions': false,
            'hideOnOverlayClick': false,
            'modal'             : modal,
            'transitionIn'	: 'fade',
            'transitionOut'	: 'fade',
            'width'		: w,
            'height'            : h,
            'href'		: pageURL+'&pop_up=1'
	});
}
jQuery(function($){
	// Show tipsy tooltip
	$('*[title]').tipsy({gravity: $.fn.tipsy.autoWE, html:true});

	// Scrollup
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});
 
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

	// Fancybox
	$('a.fancy').fancybox({
		'autoDimensions': false,
		'hideOnOverlayClick':false,
		'showCloseButton'   : false,
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
		'width'		: '70%',
		'height'	: '100%'
	});

    // Jcarousellite jquery
    $(".jcarouse").jCarouselLite({  // Lấy class của ul và g�?i hàm jCarouselLite() trong thư viện
        vertical: true,             // Chạy theo chi�?u d�?c
        hoverPause:true,            // Hover vào nó sẽ dừng lại
        visible: 7,                 // Số bài viết cần hiện
        auto:500,                   // Tự động scroll
        speed:1000                  // Tốc độ scroll
    });
    // Slide jquery
    $('#slides').slides({
        preload: true,
        preloadImage: 'js/jquery/slides/img/loading.gif',
        play: 5000,
        pause: 2500,
        hoverPause: true,
        animationStart: function(current){
            $('.caption').animate({
                bottom:-35
            },100);
            if (window.console && console.log) {
                // example return of current slide number
                console.log('animationStart on slide: ', current);
            };
        },
        animationComplete: function(current){
            $('.caption').animate({
                bottom:0
            },200);
            if (window.console && console.log) {
                // example return of current slide number
                console.log('animationComplete on slide: ', current);
            };
        },
        slidesLoaded: function() {
            $('.caption').animate({
                bottom:0
            },200);
        }
    });

	// Slider bar jquery
	$("#slider").slider({
		value:0,
		min: 0,
		max: 100,
		step: 5,
		slide: function( event, ui ) {
			if(ui.value == 100){
				$('#validate').show();
				$('#sliderdiv').fadeOut();
			}
		}
	});

	// Tablesorter
	$(".tablesorter").tablesorter({
		widthFixed : false,

		// initialize zebra striping, filter and resizable widgets
		widgets: ["zebra", "filter", "resizable"]
	}).tablesorterPager({container: $(".pager")});
	$( "#accordion" ).accordion();
});
/////////////////// Check file type //////////////////////////////////////////
/**
* file : int
* ext : string array()
* Note: Extention of file with dot in front of ext.
* Ex: ext = new Array(".png", ".jpeg", ".jpg")
*/
function checkFileExt(file, ext) {
    var pathLength = file.length;
    var lastDot = file.lastIndexOf(".");
    var fileType = file.substring(lastDot, pathLength);

    for (i = 0; i < ext.length; i++) {
            if (fileType == ext[i])
            {
                    return true;
            }
    }
    return false;
}
/////////////////// Sort alphabet option select list /////////////////////////
function sortAlphabet(id) {
    var prePrepend = "#";
    if (id.match("^#") == "#") prePrepend = "";
    selectedValue = $('#' + id).val();
    $(prePrepend + id).html($(prePrepend + id + " option").sort(
        function (a, b) {   
            if (a.value <= 0){
                //alert(a.value);
                return -1;
            }
            else if (b.value <= 0){
                return 1;
            }
            else 
                return a.text.toUpperCase() == b.text.toUpperCase() ? 0 : (a.text.toUpperCase() < b.text.toUpperCase() ? -1 : 1);
        }
    ));

    $('#' + id).val(selectedValue);
}
function getBaseUrlApp() {
	var url = location.href;
	if (url.indexOf('index.php') != -1){
		var baseURL = url.substring(0, url.indexOf('index.php')-1);
		return baseURL;
	}
	return url;
}
function getBaseUrlAjax() {
	var url = location.href;
	if (url.indexOf('index.php') != -1){
		var baseURL = url.substring(0, url.indexOf('index.php')+9);
		return baseURL + "?r=";
	}
	return url + "index.php?r=";
}
/////////////////////// ajax jQuery //////////////////////////////////////
/* Usage:
var dataReps = callAjaxJquery({
	'businessName',
	'functionName',
	{ parameter_1_name: value_1, parameter_2_name: value_2, parameter_n_name: value_n }
);
Then we can use 'dataResp' variable with 'dataResp.content'. Note: Default dataType is 'json'
*/
function callAjaxJquery(business,func,args) {
    var defs = {
		type: 'json', method: 'POST', args: null, 
        error: function(msg){},
        begin: function(){},
        success: function(result){}
    };

	var parameter = {args: args};
    opts = $.extend({}, defs, parameter);

	// convert args from boolean(true,false) to number(1,0)
	$.each(opts.args, function(key, value){
		if (typeof(value) === 'undefined') {
			opts.args[key] = 'null';
		}
		if (typeof(value) == 'boolean') {
			opts.args[key] = value ? 1 : 0;
		}
	});
	opts.args.ajaxcall = true;

    var dataresponse = $.ajax({
        cache: false, async: false,
        data: {business:business,func:func,parameters:opts.args}, dataType: opts.type, 
		type: opts.method, url: getBaseUrlAjax() + "ajax",
		error: function(xhr, stt, err) {
		    opts.error(xhr, stt, err);
		},
		beforeSend: function(xhr) {
		    opts.begin(xhr);
            xhr.setRequestHeader("ajaxcall", "true");
        },
		success: function(result) {
			opts.success(result);
		}
	});
	dataresponse.content = dataresponse.responseText;
	if(opts.type == 'json') {
	    dataresponse.content = $.parseJSON(dataresponse.content);
	}
	return dataresponse;
}

// Show tooltip when input data is not valid or successful
function showMessageBubble(id, type, msg, seconds)
{
    var delay = seconds || 5000;
    jQuery.showMessage({
        thisMessage:	    [msg],
        className:		    type,
        position:		    'top',
        opacity:		    90,
        displayNavigation:	true,
        autoClose:		    true,
        delayTime:		    delay
    });
	document.getElementById(id).focus();
    return false;
}

// Set cookie
function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}

/////////////////////// auto load Data per x seconds ajax jQuery //////////////////////////////////////
/* Usage:
// On page html:
$(document).ready(function(){
			autoAjaxCall("input_url","input_html_object",time_second_unit);
		});
// On page input_url php:
echo "<p>".$row['field']."</p>"
*/
function autoAjaxCall(url, HTMLObject, jumpTime) {
	var callAjax = function(){
		$.ajax({
		  method:'POST',
		  url:url,
		  success:function(data){
			$(HTMLObject).html(data);
		  }
		});
	}
	setInterval(callAjax,jumpTime*1000);
}