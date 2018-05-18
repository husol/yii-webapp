// Show loading image
function loading_show(){
	$('#loading').html("<img class='loading' src='"+getBaseUrlApp()+"/img/loading.gif'/>").fadeIn('fast');
}

// Hide loading image
function loading_hide(){
	$('#loading').fadeOut('fast');
}             

// Load result
function loadData(pageAjax){
	loading_show();
	$.ajax ({
		type: "POST",
		url: "index.php?r="+ $_GET['r']+"/list",
		data: {page : pageAjax, data : $_GET['data']},
		success: function(msg) {
			loading_hide();
			document.getElementById('containerPagination').innerHTML = msg;
		}
	});
}

$(document).ready(function(){
    // LOAD result to page
    $('#containerPagination .pagination li.active').live('click',function(){
        var page = $(this).attr('p');
        loadData(page);
    });

    // Show result after inputing page value to textbox
    $('#go_btn').live('click',function(){
        var page = parseInt($('#goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loadData(page);
        } else{
            alert('Please input value from 1 to '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
    });
});