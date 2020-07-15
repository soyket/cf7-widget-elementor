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
                modal.hide();
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
                modal.hide();
                $('[data-setting="cf7"]').trigger('change');
                $('.elementor-update-preview-button').trigger('click');
            });
        });
    };

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/void-section-cf7.default', formIdCatch);
        
        elementor.hooks.addAction('panel/open_editor/widget/void-section-cf7', eventCatchFunction);

    });

})(jQuery);
