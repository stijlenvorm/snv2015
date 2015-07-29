(function($){

	$(document).ready(function() {
		togglePageHeaderChoices();
		$('#_header_type').change(togglePageHeaderChoices);

        // initiate it
        mediaInputControl();
    });

    // toggle for header choices in de backoffice on the single page/post edit pages
	function togglePageHeaderChoices(){
		var option = $('#_header_type').val();
		var hide  = {
			'image'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(1).hide() },
			'shortcode' : function(){ jQuery('#_header_type').closest('tr').siblings().eq(0).hide() },
		}
		var show = {
			'image'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(1).show() },
			'shortcode' : function(){ jQuery('#_header_type').closest('tr').siblings().eq(0).show() },	
		}

		switch(option){
			case 'noHeader' : 	
			hide.image();
			hide.shortcode();
			console.log('noheader');
			break;
			case 'image' : 	
			show.image();
			hide.shortcode();
			console.log('image');
			break;
			case 'shortcode' : 	
			hide.image();
			show.shortcode();
			console.log('shortcode');
			break;
		}
	}

    // adds option to open media library and select an url
    function mediaInputControl(){
        var currentPrepend = '';
        var formfield;

        /* user clicks button on custom field, runs below code that opens new window */
        jQuery('.onetarek-upload-button').click(function() {
            currentPrepend =jQuery(this).attr('data-name');
            formfield = jQuery(this).prev('input'); //The input field that will hold the uploaded file url
            tb_show('','media-upload.php?TB_iframe=true');
            return false;
        });

        //adding my custom function with Thick box close function tb_close() .
        window.old_tb_remove = window.tb_remove;
        window.tb_remove = function() {
            window.old_tb_remove(); // calls the tb_remove() of the Thickbox plugin
            formfield=null;
        };

        // user inserts file into post. only run custom if user started process using the above process
        // window.send_to_editor(html) is how wp would normally handle the received data

        window.original_send_to_editor = window.send_to_editor;
        window.send_to_editor = function(html){
            if (formfield) {

                fileurl = jQuery('img',html).attr('src');
                jQuery('#'+currentPrepend+'_logo_show').attr('src' , fileurl);
                jQuery(formfield).val(fileurl);

                tb_remove();
            } else {
                window.original_send_to_editor(html);
            }
        };
    }

})(jQuery);
