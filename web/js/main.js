$(function () {
    $("#date_drop").change(function () {
        $('#submit-filter').trigger('click');
    });

    $('.house-calendar-month-dolg').on('click', function (e) {
        e.preventDefault(); //предотвращение действия по умолчанию
        house_mondolg_href = $(this).attr('href');
        $('#house-calendar-kvdate .kv-date-calendar').trigger('click');
        $('.datepicker.datepicker-dropdown').css({
            'top': ($(this).offset().top + 16) + 'px',
            'left': ($(this).offset().left - 14) + 'px'
        })
    });
});
