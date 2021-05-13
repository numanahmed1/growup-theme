jQuery(document).ready(function($){
	var mediaUploder;
	
	$( '#upload-button' ).on('click',function(e){
		e.preventDefault();
		if( mediaUploder ){
			mediaUploder.open();
			return;
		}
		
		mediaUploder = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture'
			},
			multiple: false
		});
		
		mediaUploder.on('select', function(){
			attachment = mediaUploder.state().get('selection').first().toJSON();
			$('#profile-picture').val(attachment.url);
			$('#profile-picture-preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploder.open();
	});
	$('#remove-picture').on('click', function(e){
		e.preventDefault();
		var answer = confirm("Are You Sure Want To Remove Profile Picture");
		if( answer == true ){
			$('#profile-picture').val('');
			$('.growup-general-form').submit();
		}
		return;
	});
});