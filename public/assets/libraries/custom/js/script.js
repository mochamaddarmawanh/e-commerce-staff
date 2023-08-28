function blockUIMyCustom() {
    $.blockUI({
        message:
            '<div class="d-justify-content-center align-items-center"><p>Please wait...</p><p class="spinner-border"></p></div>',
        css: {
            backgroundColor: 'transparent',
            color: '#fff',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        },
    });
}

function blockUIMyCustom_verification_email_person() {
    $.blockUI({
        message:
            '<div class="d-justify-content-center align-items-center"><p>Please wait, we are sending you an email verification...</p><p class="spinner-border"></p></div>',
        css: {
            backgroundColor: 'transparent',
            color: '#fff',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        },
    });
}

function blockUIMyCustom_verification_email_admin() {
    $.blockUI({
        message:
            '<div class="d-justify-content-center align-items-center"><p>Please wait, we are sending an email verification to this new user...</p><p class="spinner-border"></p></div>',
        css: {
            backgroundColor: 'transparent',
            color: '#fff',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        },
    });
}

function copy_password(id, button) {
    var passwordField = document.getElementById(id);

    passwordField.select();
    document.execCommand("copy");

    if (window.innerWidth < 768) {
        button.innerHTML = "<i class='ri-check-line'></i>";
    } else {
        button.innerHTML = "<i class='ri-check-line'></i>&nbsp; Text copied!";
    }

    setTimeout(function () {
        button.innerHTML = "<i class='ri-file-copy-line'></i>";
    }, 2000);
}


function generate_password() {
    const length = 10;
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let password = "";

    for (let i = 0; i < length; i++) {
        const random_index = Math.floor(Math.random() * charset.length);
        password += charset[random_index];
    }

    return password;
}

function delete_selected_rows(event) {
    event.preventDefault();

    // const selectedRows = $("input[name^='select_row_']:checked");

    // if (selectedRows.length === 0) {
    //     alert("Please select at least one row to delete.");
    //     return;
    // }

    // if (confirm("Are you sure you want to delete the selected rows?")) {
    //     selectedRows.each(function () {
    //         const productId = $(this).attr("data-product-id");
    //         const form = $(this).closest("form");
    //         form.attr("action", "/products/" + productId);
    //         form.submit();
    //     });
    // }

    const selectedRows = $("input[name^='select_row_']:checked");

    if (selectedRows.length === 0) {
        alert("Please select at least one row to delete.");
        return;
    }

    if (confirm("Are you sure you want to delete the selected rows?")) {
        const selectedProductIds = selectedRows.map(function () {
            return $(this).attr("data-product-id");
        }).get();

        $("#selected-rows-input").val(selectedProductIds);
        $("#delete-selected-form").submit();
    }
}

$(document).ready(function () {
    // User table
    if ($('#user_table').length > 0) {
        $('#user_table').DataTable({
            dom: 'Bfrtipl',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            'order': [
                [4, 'desc']
            ],
            scrollX: true,
        });
    }

    // Product table
    if ($('#product_table').length > 0) {
        $('#product_table').DataTable({
            dom: 'Bfrtipl',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            'order': [
                [16, 'desc']
            ],
            scrollX: true,
            responsive: true,
        });
    }

    // Product * table
    if ($('#product_star_table').length > 0) {
        $('#product_star_table').DataTable({
            dom: 'Bfrtipl',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            'order': [
                [3, 'desc']
            ],
            scrollX: true,
        });
    }
});
