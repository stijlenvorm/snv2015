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
            'shortcode' : function(){ jQuery('#_header_type').closest('tr').siblings().eq(0).hide() },
            'image'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(1).hide() },
            'video'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(2).hide() },
            'title'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(3).hide() },
            'titleAs'   : function(){ jQuery('#_header_type').closest('tr').siblings().eq(4).hide() },
            'subtitle'  : function(){ jQuery('#_header_type').closest('tr').siblings().eq(5).hide() },
			'subtitleAs': function(){ jQuery('#_header_type').closest('tr').siblings().eq(6).hide() },
		}
		var show = {
			'shortcode' : function(){ jQuery('#_header_type').closest('tr').siblings().eq(0).show() },
            'image'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(1).show() },
            'video'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(2).show() },
            'title'     : function(){ jQuery('#_header_type').closest('tr').siblings().eq(3).show() },
            'titleAs'   : function(){ jQuery('#_header_type').closest('tr').siblings().eq(4).show() },
            'subtitle'  : function(){ jQuery('#_header_type').closest('tr').siblings().eq(5).show() },
            'subtitleAs': function(){ jQuery('#_header_type').closest('tr').siblings().eq(6).show() },
		}
        
        // move select titleAs to title and hide parent (also for subtitleAs)
        jQuery('#_header_titel').parent().prepend(jQuery('#_header_titelals'))
        jQuery('#_header_subtitel').parent().prepend(jQuery('#_header_subtitelals'))
        hide.titleAs();
        hide.subtitleAs();

		switch(option){
			case 'noHeader' : 	
			hide.image();
            hide.shortcode();
			hide.video();
            hide.title();
            // hide.titleAs();
            hide.subtitle();
            // hide.subtitleAs();
			break;
			case 'image' : 	
			hide.shortcode();
            hide.video();
            show.image();
            show.title();
            // show.titleAs();
            show.subtitle();
            // show.subtitleAs();
			break;
			case 'shortcode' : 	
			hide.image();
            hide.video();
			show.shortcode();
            show.title();
            // show.titleAs();
            show.subtitle();
            // show.subtitleAs();
			break;
            case 'video' :  
            hide.image();
            show.video();
            hide.shortcode();
            show.title();
            // show.titleAs();
            show.subtitle();
            // show.subtitleAs();
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
