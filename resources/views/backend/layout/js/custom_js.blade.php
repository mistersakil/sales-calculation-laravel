<script>
	function custom_loading_timer(status = true){

	var i = 1;

	$('<h1></h1')
	.attr('id', 'custom_loading_timer')
	.css({
		'width'				: '200px', 
		'height'			: '200px', 
		'display'			: 'block', 
		'margin'			: '10px auto',
		'position'			: 'fixed',
		'top'				: '200px',	
		'left'				: '45%',
		'bottom'			: '10px',
		'background-color'	: 'white',
		'border'			: '40px solid black',
		'border-radius'		: '0%',
		'text-align'		: 'center',
		'line-height'		: '120px',
		'color'				: 'black',
		'font-size'			: '50px',
		'font-weight'		: '700',
	})
	.text(i)
	.appendTo('body');
	if(status){		
		var timerStart = setInterval(function(){
			$('#custom_loading_timer').text(i++);
		}, 1000)
	}else{
		clearInterval(timerStart);
		$('body #custom_loading_timer').remove();
		i = 1;
	}

}

function ajax_loading(status = true) {
	var width  = 200;
	var height = 200;
	var loaderHeight = (document.documentElement.clientHeight - height) / 2;
	var loaderWidth = (document.documentElement.clientWidth - width) / 2;

	
	if(status){
		$('<img src="{{ asset('public/image/loading.gif') }}" class="custom_loading">').css({
		'width'				: width  + 'px', 
		'height'			: height + 'px', 
		'display'			: 'block', 
		'margin'			: '10px auto',
		'position'			: 'fixed',
		'top'				: loaderHeight + 'px',	
		'left'				: loaderWidth + 'px',
		'z-index'			: 9999999,
		'background' 		: 'rgb(255, 255, 255)',
	    'border-radius' 	: '50%',
	    'border' 			: '0px solid red',
	    'padding' 			: '5px 0 15px 0',
	    'border-left-color' : 'green',
	    'border-right-color': 'orange',
	    'border-bottom-color': 'blue'

		})
		.appendTo('body');
	}else{
		$('body .custom_loading').remove();
	}

}
function custom_loading() {
	return $('<img src="public/image/dokkanloader.gif" class="custom_loading">').css({
		'width'				: '40px', 
		'height'			: '40px', 
		'display'			: 'block', 
		'margin'			: '10px auto',
		'position'			: 'absolute',
		'left'				: '45%',
		'bottom'			: '10px'
	});
}
function custom_message(image = 'green-tick.png', title= 'Successfully created') {
	return $('<img title="'+title+'" src="../public/image/'+image+'" class="alert_message">').css({
		'width'				: '40px', 
		'height'			: '40px', 
		'display'			: 'block', 
		'margin'			: '10px auto',
		'position'			: 'absolute',
		'left'				: '45%',
		'bottom'			: '10px'
	});
}

$(document).ready(function(){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	/** Remove all modal code by default **/
	$('.view_container').on('hidden.bs.modal',function(){
		$('.modal.fade').remove();
	});

	/** Change product name color on mouse move **/

	$(document).mousemove(function(event) {
        var x = Math.ceil((event.pageX / 10) * 1.5);
        var y = Math.ceil((event.pageY / 10) * 1.5);
        var z = Math.ceil((x + y) / 2);
        var scale = (x / z).toFixed(2);
        var color  = 'rgb('+x+','+y+','+z+')';
        if(scale > 1.1) scale = 1.1
        	else if(scale < 1) scale = 1
        var transform = 'scale('+scale+')';

        // console.log(x,y,z,transform);
        $('.product_name').css({'color' : color });
    });

    $('.btn_reload').click(function(){
    	window.location.reload();
    });



});
</script>