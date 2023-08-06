import './bootstrap';
import $ from "jquery";
import 'bootstrap-datepicker';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
$(document).ready(function() {
    $('.expand-btn').on('click', function() {
        $(this).prev('p').toggleClass('expanded');

        if ($(this).prev('p').hasClass('expanded')) {
            $(this).text('Read less');
        } else {
            $(this).text('Read more');
        }
    });

    $("#date_publish").datepicker({
        calendarWeeks:false,
        clearBtn:true,
        format:"dd-mm-yyyy",
        startDate:'currentDate',
        todayBtn:true,
        todayHighlight:true,
        autoclose: true,
    }).datepicker('setDate', $('#date_publish').val());

});
