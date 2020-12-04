quiz_id = document.getElementById("id_quiz").classList;
quiz_title = document.getElementById("title_quiz").classList; 
about_quiz = document.getElementById("about_quiz").classList;
question_id = document.getElementById("id_question").classList;
question = document.getElementById("question_hehe").classList;
option_id = document.getElementById("id_option").classList;
option_answer = document.getElementById("answer_option").classList;
is_correct = document.getElementById("correct_is").classList;
image = document.getElementById("image_quiz").classList;

function _clickRadioButton(choice) {

    if(choice.value == "choice1") {
        quiz_id.add("show-fields");
        quiz_title.add("show-fields");
        about_quiz.add("show-fields");
        question_id.remove("show-fields");
        question.remove("show-fields");
        option_id.remove("show-fields");
        option_answer.remove("show-fields");
        is_correct.remove("show-fields");
        image.add("show-fields");
    } else if(choice.value == "choice2") {
        quiz_id.add("show-fields");
        quiz_title.remove("show-fields");
        about_quiz.remove("show-fields");
        question_id.add("show-fields");
        question.add("show-fields");
        option_id.remove("show-fields");
        option_answer.remove("show-fields");
        is_correct.remove("show-fields");
        image.remove("show-fields");
    } else if(choice.value == "choice3") {
        quiz_id.remove("show-fields");
        quiz_title.remove("show-fields");
        about_quiz.remove("show-fields");
        question_id.add("show-fields");
        question.remove("show-fields");
        option_id.add("show-fields");
        option_answer.add("show-fields");
        is_correct.add("show-fields");
        image.remove("show-fields");
    } else if(choice.value == "choice4") {
        quiz_id.add("show-fields");
        quiz_title.remove("show-fields");
        about_quiz.remove("show-fields");
        question_id.remove("show-fields");
        question.remove("show-fields");
        option_id.remove("show-fields");
        option_answer.remove("show-fields");
        is_correct.remove("show-fields");
        image.remove("show-fields");
    } else if(choice.value == "choice5") {
        quiz_id.remove("show-fields");
        quiz_title.remove("show-fields");
        about_quiz.remove("show-fields");
        question_id.add("show-fields");
        question.remove("show-fields");
        option_id.remove("show-fields");
        option_answer.remove("show-fields");
        is_correct.remove("show-fields");  
        image.remove("show-fields");
    }
}

(function ($) {
    "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input3').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
            

    /*==================================================================
    [ Chose Radio ]*/
    $("#radio1").on('change', function(){
        if ($(this).is(":checked")) {
            $('.input3-select').slideUp(300);
        }
    });

    $("#radio2").on('change', function(){
        if ($(this).is(":checked")) {
            $('.input3-select').slideDown(300);
        }
    });
        
  
    
    /*==================================================================
    [ Validate ]*/
    var name = $('.validate-input input[name="name"]');
    var email = $('.validate-input input[name="email"]');
    var message = $('.validate-input textarea[name="message"]');


    $('.validate-form').on('submit',function(){
        var check = true;

        if($(name).val().trim() == ''){
            showValidate(name);
            check=false;
        }


        if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            showValidate(email);
            check=false;
        }

        if($(message).val().trim() == ''){
            showValidate(message);
            check=false;
        }

        return check;
    });


    $('.validate-form .input3').each(function(){
        $(this).focus(function(){
           hideValidate(this);
       });
    });

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);