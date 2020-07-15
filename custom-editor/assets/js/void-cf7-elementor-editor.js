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

        close.on('click', function(){
            modal.hide();
        });

        // windowParent.jQuery('body').onclick = function(event) {
        //     console.log('body click');
        //     if (event.target == modal) {
        //         modal.hide();
        //     }
        // }

    };

    var eventCatchFunction = function (panel, model, view) {
        var $elementEdit = panel.$el.find( '.void-cf7-edit-form-btn' ).find( '#void-cf7-edit-form-btn' );
        $elementEdit.on('click', function(e){
            e.preventDefault();
            iframe.attr('src', voidCf7Admin.url+'admin.php?page=wpcf7&post='+formId+'&active-tab=0');
            modal.show();
        });

        var $elementAdd = panel.$el.find( '.void-cf7-add-form-btn' ).find( '#void-cf7-add-form-btn' );
        $elementAdd.on('click', function(e){
            e.preventDefault();
            iframe.attr('src', voidCf7Admin.url+'admin.php?page=wpcf7-new');
            modal.show();
        });
    };

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/void-section-cf7.default', formIdCatch);
        
        elementor.hooks.addAction('panel/open_editor/widget/void-section-cf7', eventCatchFunction);

    });

})(jQuery);
