


jQuery(document).ready(function ($) {

    function mediaUploader(uploadBtn, removeBtn, inputField, preview) {

        $(uploadBtn).on('click', function (e) {

            e.preventDefault();

            var frame = wp.media({
                title: 'Select Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });

            frame.on('select', function () {

                var attachment = frame.state().get('selection').first().toJSON();

                $(inputField).val(attachment.id);

                $(preview).html(
                    '<img src="' + attachment.url + '" style="max-width:300px;">'
                );

            });

            frame.open();

        });

        $(removeBtn).on('click', function () {

            $(inputField).val('');

            $(preview).html('');

        });

    }

    // Banner
    mediaUploader(
        '#upload_banner',
        '#remove_banner',
        '#banner_image',
        '#banner-preview'
    );

    // Intro
    mediaUploader(
        '#upload_intro_image',
        '#remove_intro_image',
        '#intro_image',
        '#intro_preview'
    );

    mediaUploader(
    '#upload_academic_image',
    '#remove_academic_image',
    '#academic_image',
    '#academic_preview'
);

// Benefit Upload
$(document).on('click', '.upload-benefit', function (e) {

    e.preventDefault();

    var parent = $(this).closest('.benefit-item');

    var frame = wp.media({
        title: 'Select Icon',
        button: {
            text: 'Use this image'
        },
        multiple: false
    });

    frame.on('select', function () {

        var attachment = frame.state().get('selection').first().toJSON();

        parent.find('.benefit-icon').val(attachment.id);

        parent.find('.benefit-preview')
            .attr('src', attachment.url)
            .show();

    });

    frame.open();

});
$(document).on('click', '.remove-benefit-image', function () {

    var parent = $(this).closest('.benefit-item');

    parent.find('.benefit-icon').val('');

    parent.find('.benefit-preview')
        .attr('src', '')
        .hide();

});

});



// repeater add benefit
jQuery(function ($) {

    // Add Benefit
    $('#add-benefit').on('click', function () {

        var index = $('#benefits-wrapper .benefit-item').length;

        var template = $('#benefit-template').html();

        template = template.replace(/{{INDEX}}/g, index);

        $('#benefits-wrapper').append(template);

    });

    // Remove Benefit
    $(document).on('click', '.remove-benefit', function () {

        $(this).closest('.benefit-item').remove();

    });

});


//CTA

jQuery(function($){

    var MAX_CTA = 1;

    function renumber(){
        $('#selected-cta-list li').each(function(i){
            $(this).find('.cta-num').text(i + 1);
        });
    }

    function updateCount(){
        $('#cta-count').text($('#selected-cta-list li').length + '/' + MAX_CTA);
    }

    // Initial numbering on page load
    renumber();
    updateCount();

    // Search
    $('#search-cta').on('keyup', function(){
        var value = $(this).val().toLowerCase();
        $('#available-cta-list .cta-row').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Add / Remove via checkbox
    $(document).on('change', '.cta-check', function(){

        var row   = $(this).closest('.cta-row');
        var id    = row.data('id');
        var title = row.data('title');

        if ($(this).is(':checked')) {

            // Enforce max limit
            if ($('#selected-cta-list li').length >= MAX_CTA) {
                alert('You can select a maximum of ' + MAX_CTA + ' CTAs.');
                $(this).prop('checked', false);
                return;
            }

            row.addClass('selected');

            $('#selected-cta-list').append(
                '<li data-id="' + id + '">' +
                    '<span class="dashicons dashicons-menu"></span>' +
                    '<span class="cta-num"></span>' +
                    '<span class="cta-title">' + title + '</span>' +
                    '<span class="remove-cta">✕</span>' +
                    '<input type="hidden" name="selected_cta[]" value="' + id + '">' +
                '</li>'
            );

        } else {

            row.removeClass('selected');
            $('#selected-cta-list li[data-id="' + id + '"]').remove();
        }

        renumber();
        updateCount();
    });

    // Remove via ✕ button
    $(document).on('click', '.remove-cta', function () {
        var li = $(this).closest('li');
        var id = li.data('id');

        $('.cta-row[data-id="' + id + '"]')
            .removeClass('selected')
            .find('.cta-check')
            .prop('checked', false);

        li.remove();
        renumber();
        updateCount();
    });

    // Drag & Drop reorder
    $('#selected-cta-list').sortable({
        placeholder: 'ui-sortable-placeholder',
        axis: 'y',
        update: function(){
            renumber();
        }
    });

});


//statistics
jQuery(function($){

    var maxSelection = 4;

    function renumber(){
        $('#selected-statistics li').each(function(i){
            $(this).find('.stat-num').text(i + 1);
        });
    }

    function updateCounter(){
        $('#statistics-count').text(
            $('#selected-statistics li').length + '/' + maxSelection
        );
    }

    // Initial state on page load
    renumber();
    updateCounter();

    // Search
    $('#statistics-search').on('keyup', function(){
        var value = $(this).val().toLowerCase();
        $('#statistics-list .statistics-item').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Add / Remove via checkbox
    $(document).on('change', '.statistics-check', function(){

        var checkbox = $(this);
        var row       = checkbox.closest('.statistics-item');
        var id        = row.data('id');
        var title     = row.data('title');

        if (checkbox.is(':checked')) {

            if ($('#selected-statistics li').length >= maxSelection) {
                alert('Maximum ' + maxSelection + ' statistics allowed.');
                checkbox.prop('checked', false);
                return;
            }

            row.addClass('selected');

            $('#selected-statistics').append(
                '<li data-id="' + id + '">' +
                    '<span class="dashicons dashicons-menu"></span>' +
                    '<span class="stat-num"></span>' +
                    '<span class="stat-title">' + title + '</span>' +
                    '<span class="remove-statistics">✕</span>' +
                    '<input type="hidden" name="selected_statistics[]" value="' + id + '">' +
                '</li>'
            );

        } else {

            row.removeClass('selected');
            $('#selected-statistics li[data-id="' + id + '"]').remove();
        }

        renumber();
        updateCounter();
    });

    // Remove via ✕
    $(document).on('click', '.remove-statistics', function(){

        var li = $(this).closest('li');
        var id = li.data('id');

        $('.statistics-item[data-id="' + id + '"]')
            .removeClass('selected')
            .find('.statistics-check')
            .prop('checked', false);

        li.remove();
        renumber();
        updateCounter();
    });

    // Drag & Drop reorder
    $('#selected-statistics').sortable({
        placeholder: 'ui-sortable-placeholder',
        axis: 'y',
        update: function(){
            renumber();
        }
    });

});



// Add Academic Item
jQuery(function ($) {
$('#add-academic').on('click', function(){

    var index = $('#academic-wrapper .academic-item').length;

    var template = $('#academic-template').html();

    template = template.replace(/{{INDEX}}/g,index);

    $('#academic-wrapper').append(template);

});


// Remove Academic Item

$(document).on('click','.remove-academic',function(){

    $(this)
        .closest('.academic-item')
        .remove();

});
});



