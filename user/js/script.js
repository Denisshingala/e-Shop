$(document).ready(function() {

    filter_data();

    $('.price-range').on('click', function() {
        filter_data();
    });
    $('.brand').on('click', function() {
        filter_data();
    });

    // setTimeout(() => {
    //     filter_data();
    // }, 5000);

    function filter_data() {
        let action = 'fetch_data';
        let priceRange = get_filter('price-range');
        let brand = get_filter('brand');

        console.log(priceRange);
        console.log(brand);

        let categoryID = $('#category-id').val();
        let pageNo = $('#page-no').val();

        console.log("page:" + pageNo);

        $.ajax({
            url: 'action/fetch-products-data.php',
            method: 'POST',
            data: { priceRange, brand, action, categoryID, pageNo },
            success: function(data) {
                $('#show-products-category-wise').html(data);
            }
        })
    }

    function get_filter(className) {
        let filter = [];
        $('.' + className + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }
})