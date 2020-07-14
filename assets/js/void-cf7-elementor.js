(function($) {
    var eventCatchFunction = function (panel, model, view) {
        var $elementEdit = panel.$el.find( '.void-cf7-edit-form-btn' ).find( '#void-cf7-edit-form-btn' );
        console.log($elementEdit);
        $elementEdit.on('click', function(e){
            e.preventDefault();
            console.log('edit event Clicked!');
        });

        var $elementAdd = panel.$el.find( '.void-cf7-add-form-btn' ).find( '#void-cf7-add-form-btn' );
        console.log($elementAdd);
        $elementAdd.on('click', function(e){
            e.preventDefault();
            console.log('add event Clicked!');
        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementor.hooks.addAction('panel/open_editor/widget/void-section-cf7', eventCatchFunction);
    });

})(jQuery);
