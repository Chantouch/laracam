$(document).ready(function () {
    'use strict';
    //Add or Edit user
    let html = '<div class="col-md-12"><input type="password" class="form-control" name="password" id="password" placeholder="Manually give a password to this user"></div>';
    $('input:radio[name=password_options]').change(function () {
        if (this.value === 'manual') {
            $('#password_manual').append(html);
            //$('.form-line input').slideDown("slow");
        }
        else {
            $('#password_manual .col-md-12').remove();
        }
    });
    // //Add permission
    // $('input:radio[name=permission_type]').change(function () {
    //     if (this.value === 'basic') {
    //         $('#basic_form').removeClass('hidden');
    //         $('#crud_form').addClass('hidden');
    //     }
    //     else {
    //         $('#crud_form').removeClass('hidden');
    //         $('#basic_form').addClass('hidden');
    //     }
    // });
});

//Function to ad dynamic of resource permission
let resource = $("#resource");
let tbody = $('#crud_table tbody'), props = ["Name", "Slug", "Description"];
let crudSelected = ['create', 'read', 'update', 'delete'];
$(resource).on('input', function () {
    if (resource.val().length >= 3) {
        $.each(crudSelected, function (i, crudSelected) {
            let tr = $('<tr>');
            $.each(props, function (i, prop) {
                $('<td>').html(crudSelected[prop]).appendTo(tr);
            });
            tbody.append(tr);
        });
    }
});

/**
 *
 * @param item
 * @returns {string}
 */
function crudName(item) {
    'use strict';
    return item.substr(0, 1).toUpperCase() + item.substr(1) + " " + resource.val().substr(0, 1).toUpperCase() + resource.val().substr(1);
}

$(function () {
    $(".select2").select2();
    $('.summernote').summernote({
        height: 450, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false, // set focus to editable area after initializing summernote,
        callbacks: {
            onImageUpload: function (image) {
                let sizeKB = image[0]['size'] / 1000;
                let tmp_pr = 0;
                if (sizeKB > 200) {
                    tmp_pr = 1;
                    alert("pls, select less then 200kb image.");
                }
                if (image[0]['type'] !== 'image/jpeg' && image[0]['type'] !== 'image/png') {
                    tmp_pr = 1;
                    alert("pls, select png or jpg image.");
                }
                if (tmp_pr === 0) {
                    let file = image[0];
                    let reader = new FileReader();
                    reader.onloadend = function () {
                        let image = $('<img>').attr('src', reader.result);
                        $('#editor').summernote("insertNode", image[0]);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    });
});