$(document).ready(function () {
    $('.js-example-basic-multiple').select2();
});

//Datepicker for dynamically added fields
$(document).on("focus", ".datepicker", function(){
    $(this).datepicker({
        dateFormat:"yy-mm-dd",
        minDate:0,
        autocomplete:0,
    });
});


$(document).ready(function () {
    $('#smartwizard').on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
        if ($('button.sw-btn-next').hasClass('disabled')) {
            $('.sw-btn-group-extra').show(); // show the button extra only in the last page
        } else {
            $('.sw-btn-group-extra').hide();
        }
    }).smartWizard({
        keyNavigation: false,
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'left', // left, right
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            // toolbarExtraButtons: [
            //     $('<button></button>').text('Finish')
            //         .addClass('btn btn-info')
            //         .on('click', function () {
            //             alert('Adding Package...');
            //         }),
            // ]
        },
        theme: 'arrows',
        transitionEffect: 'slide', // Effect on navigation, none/slide/fade
        transitionSpeed: '400',
    });

});

//{{--images script multiple add--}}

function generateRandomInteger() {
    return Math.floor(Math.random() * 90000) + 10000;
}

jQuery(document).on('click', '.btn-delete-images', function (e) {
    e.preventDefault();
    var $this = $(this);
    $this.closest("tr").remove();
});

jQuery(document).on('click', '.btn-add-images', function (e) {
    e.preventDefault();
    // console.log('tgd');
    var lastRow = $('table.table-images > tbody > tr').last().attr('data-row');
    var counter = lastRow ? parseInt(lastRow) + 1 : 1;
    var randomInteger = generateRandomInteger();
    var newRow = jQuery('<tr data-row="' + counter + '">' +
        '<td>' + counter + '</td>' +
        '<td><input type="file" name="image[' + randomInteger + ']" class="form-control" required></td>' +
        '<td><input type="radio" name="image_main" value="' + counter + '" required></td>' +
        '<td><button type="button" class="btn btn-danger btn-sm btn-delete-images" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
        '</tr>');
    jQuery('table.table-images').append(newRow);
});

//{{--features script multiple add--}}

function generateRandomInteger() {
    return Math.floor(Math.random() * 90000) + 10000;
}

jQuery(document).on('click', '.btn-delete-features', function (e) {
    e.preventDefault();
    var $this = $(this);
    $this.closest("tr").remove();
});

jQuery(document).on('click', '.btn-add-features', function (e) {
    e.preventDefault();
    // console.log('tgd');
    var lastRow = $('table.table-features > tbody > tr').last().attr('data-row');
    var counter = lastRow ? parseInt(lastRow) + 1 : 1;
    var randomInteger = generateRandomInteger();
    var newRow = jQuery('<tr data-row="' + counter + '">' +
        '<td>' + counter + '</td>' +
        '<td><input type="text" name="feature[' + randomInteger + ']" class="form-control" required></td>' +
        // '<td><input type="text" name="features[feature][' + randomInteger + ']" class="form-control" required/></td>' +

        '<td><button type="button" class="btn btn-danger btn-sm btn-delete-features" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
        '</tr>');
    jQuery('table.table-features').append(newRow);
});


//{{--specifications script multiple add--}}

function generateRandomInteger() {
    return Math.floor(Math.random() * 90000) + 10000;
}

jQuery(document).on('click', '.btn-delete-specifications', function (e) {
    e.preventDefault();
    var $this = $(this);
    $this.closest("tr").remove();
});

jQuery(document).on('click', '.btn-add-specifications', function (e) {
    e.preventDefault();
    // console.log('tgd');
    var lastRow = $('table.table-specifications > tbody > tr').last().attr('data-row');
    var counter = lastRow ? parseInt(lastRow) + 1 : 1;
    var randomInteger = generateRandomInteger();
    var newRow = jQuery('<tr data-row="' + counter + '">' +
        '<td>' + counter + '</td>' +
        '<td><textarea name="spec[title][' + randomInteger + ']" class="form-control" required></textarea></td>' +
        // '<td><input type="text" name="features[feature][' + randomInteger + ']" class="form-control" required/></td>' +
        '<td>' + '<textarea name="spec[specification][' + randomInteger + ']" class="form-control" required></textarea>' +
        '</td>' +
        '<td><button type="button" class="btn btn-danger btn-sm btn-delete-specifications" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
        '</tr>');
    jQuery('table.table-specifications').append(newRow);
});





//{{--faqs script multiple add--}}


function generateRandomInteger() {
    return Math.floor(Math.random() * 90000) + 10000;
}

jQuery(document).on('click', '.btn-delete-faqs', function (e) {
    e.preventDefault();
    var $this = $(this);
    $this.closest("tr").remove();
});

jQuery(document).on('click', '.btn-add-faqs', function (e) {
    e.preventDefault();
    // console.log('tgd');
    var lastRow = $('table.table-faqs > tbody > tr').last().attr('data-row');
    var counter = lastRow ? parseInt(lastRow) + 1 : 1;
    var randomInteger = generateRandomInteger();
    var newRow = jQuery('<tr data-row="' + counter + '">' +
        '<td>' + counter + '</td>' +
        '<td><textarea name="faqs[question][' + randomInteger + ']" class="form-control" required></textarea></td>' +
        // '<td><input type="text" name="features[feature][' + randomInteger + ']" class="form-control" required/></td>' +
        '<td>' + '<textarea name="faqs[answer][' + randomInteger + ']" class="form-control" required></textarea>' +
        '</td>' +
        '<td><button type="button" class="btn btn-danger btn-sm btn-delete-faqs" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
        '</tr>');
    jQuery('table.table-faqs').append(newRow);
});

