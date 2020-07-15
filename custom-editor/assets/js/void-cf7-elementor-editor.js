(function($) {

    var formId;

    let windowParent = window.parent;
    let modal,
        modalContainer,
        close,
        iframe;
    
    var formIdCatch = function( $scope, $ ) {

        var elForm = $scope.find( '.void-cf7-form-widget-wrapper' );
        formId = elForm.data('void-cf7-contact-form-id');

        modal = windowParent.jQuery('#cf7_widget_elementor_contact_form_control_modal');
        modalContainer = modal.find('.cf7-widget-elementor-modal-content');
        close = modal.find('.cf7-widget-elementor-modal-close');
        iframe = modal.find('.cf7-widget-elementor-modal-iframe');

    };

    // elementor edit panel call back function from hook
    var eventCatchFunction = function (panel, model, view) {
        // form edit button element selector
        var $elementEdit = panel.$el.find( '.void-cf7-edit-form-btn' ).find( '#void-cf7-edit-form-btn' );

        // elementor update preview button selector
        var elUpdateButtonPreview = panel.$el.find('.elementor-update-preview');
        // hide button from edit panel
        elUpdateButtonPreview.hide();

        // form edit button click event function
        $elementEdit.on('click', function(e){
            e.preventDefault();
            // insert src in iframe with edit link of selected form
            iframe.attr('src', voidCf7Admin.url+'admin.php?page=wpcf7&post='+formId+'&action=edit');
            // open modal with contact form edit url
            modal.show();
            // modal close button click event
            close.on('click', function(){
                // modal closed
                modal.fadeOut(500);
                // reload frondend panel to show updated data
                panel.$el.find('[data-setting="cf7"]').trigger('change');
                elUpdateButtonPreview.find('.elementor-update-preview-button').trigger('click');
            });
        });

        var $elementAdd = panel.$el.find( '.void-cf7-add-form-btn' ).find( '#void-cf7-add-form-btn' );
        $elementAdd.on('click', function(e){
            e.preventDefault();
            iframe.attr('src', voidCf7Admin.url+'admin.php?page=wpcf7-new');
            modal.show();
            close.on('click', function(){
                //get current number of forms
                var currentOption = panel.$el.find('[data-setting="cf7"] option').length;
                var data = new FormData();
                // append info
                data.append('action', 'void_cf7_data');
                // create http request
                var xhr = new XMLHttpRequest();
                // set the type , url, asynchronous
                xhr.open('POST', voidCf7Admin.ajaxUrl, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        var count = 0;
                        $.each(response, function(key, value) {
                            if (count < currentOption) {
                                count++;
                                return true;
                            }
                            count++;
                            panel.$el.find('[data-setting="cf7"]').append('<option selected value="' + key + '">' + value + '</option>');
                            ElementorConfig['widgets']['void-section-cf7']['controls']['cf7'].options[key] = value;
                        });
                        modal.fadeOut(500);
                        console.log(ElementorConfig['widgets']['void-section-cf7']['controls']['cf7'].options);
                    }
                };
                // send data
                xhr.send(data);

                panel.$el.find('[data-setting="cf7"]').trigger('change');
                elUpdateButtonPreview.find('.elementor-update-preview-button').trigger('click');
            });
        });
    };

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/void-section-cf7.default', formIdCatch);
        
        elementor.hooks.addAction('panel/open_editor/widget/void-section-cf7', eventCatchFunction);

    });

})(jQuery);
