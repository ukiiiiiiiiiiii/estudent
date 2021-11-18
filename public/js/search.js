/*$(document).ready(function () {
    var query = $(this).val();
    $.ajax({
        url: "search",
        type: "GET",
        data: {'search': query},
        success: function (data) {
            $('#search-list').html(data);
        }
    });
    $('#search').on('keyup', function () {
        var query = $(this).val();
        $.ajax({
            url: "search",
            type: "GET",
            data: {'search': query},
            success: function (data) {
                $('#search-list').html(data);
            }
        });
    });
});*/

$(document).ready(function () {
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url:"/admin/fetch_employees_data?page="+page,
            success: function (data) {
                $('#employees_data').html(data);
            }
        });
    }
});
