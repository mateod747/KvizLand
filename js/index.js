var current_id;
var current_question;

_remove_checks()

window.addEventListener('click', function(e){   
    if (!document.getElementById('pls' + current_id).contains(e.target)){
        _remove_checks()
    } 
});

function _radio_button_click(id) {
    current_id = id;
    id_int = parseInt(id);

    _takequiz(id);

    _remove_checks()

    document.getElementById(id).checked = true;
    document.getElementById("pls" + id).classList.add("show_border");
    document.getElementById("hide").classList.add("hide_hehe");
}

function _takequiz(id) {
    document.getElementById("hiddencontainer").value = id;
    document.getElementById("title").innerHTML = document.getElementById(id).value;
}

function _remove_checks() {
    var inputs = document.querySelectorAll('input[type="radio"]');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].checked = false;
        document.getElementById("pls" + inputs[i].id).classList.remove("show_border");
    }
}

var answer_ids = [];
var answer_corrects = [];

function _checkAnswers(ids, corrects) {
    answer_ids = ids;
    answer_corrects = corrects;
    var num_correct = 0;
    var num_incorrect = 0;
    var correct_answers = 0;

    console.log(answer_ids);

    for(var i = 0; i < answer_ids.length; i++) {
        document.getElementById("option" + answer_ids[i]).classList.remove("label_correct");
        document.getElementById("option" + answer_ids[i]).classList.remove("option_incorrect");
        document.getElementById("option" + answer_ids[i]).classList.remove("option_correct");
    }  

    for(var i = 0; i < answer_ids.length; i++) {
        if(answer_corrects[i] == 1) {
            correct_answers++;
            document.getElementById("option" + answer_ids[i]).classList.add("label_correct");
        }
        
        if(document.getElementById("check" + answer_ids[i]).checked == true) {
            if(answer_corrects[i] == 0) {
                num_incorrect++;
                document.getElementById("option" + answer_ids[i]).classList.add("option_incorrect");
            } else {
                num_correct++;
                document.getElementById("option" + answer_ids[i]).classList.add("option_correct");
            }
        }
        
        document.getElementById("result").innerHTML = "Result = " + (num_correct-num_incorrect) + "/" + correct_answers;
    }
}