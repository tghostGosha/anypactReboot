$(document).ready(function () {

    $(document).on('click', '.more-info-link', function () {

        let targetContainer = $('.extra-hide-offers'),
            url = $('.more-info-link').attr('data-url');
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                    $('.more-info-link').remove();
                    let elements = $(data).find('.tender-block'),
                        pagination = $(data).find('.text-center');
                    targetContainer.addClass('show-extra-offers');
                    $('.tenders__row').css({ 'max-height': 100 + "%", 'overflow': 'visible' });
                    targetContainer.append(elements);
                    targetContainer.append(pagination);
                }
            })
        }
    });

});