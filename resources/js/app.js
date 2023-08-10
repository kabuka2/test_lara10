
import $ from "jquery";
import 'bootstrap-datepicker';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
$(document).ready(function() {

    const class_btn_save_comment = $('.save-comment-page-comment');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

    class_btn_save_comment.on('click',function () {

        const text = $(this).prev('textarea').val();
        const data_info = $(this).parent().parent('.posts-block-body');
        console.log(ajaxSend(
            '/comment-create',
            'html',
            'put',
            {
                'post_id': data_info.attr('data-post-id'),
                'parent_comment_id':data_info.attr('data-id'),
                'message':text
                },
            addPost
        ));

    });

    function ajaxSend(action,type,method,data,callback)
    {
        $.ajax({
            url: action,
            method: method,
            dataType: 'json',
            data: data,
            success:(data)=>{
                callback(data);
            },
            error:(e)=>{
                console.log(e.responseJSON);
            }
        });
    }

    function addPost(data)
    {
        console.log(data);
    }


});
