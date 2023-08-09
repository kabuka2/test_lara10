
import $ from "jquery";
import 'bootstrap-datepicker';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
$(document).ready(function() {

    const class_btn_save_comment = $('.save-comment-page-comment');

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

    class_btn_save_comment.on('click',function (){
        console.log($(this).prev('textarea').val());



    });


});
