<?php
require __DIR__ . "/DbHandler.php";

use Db\DbHandler;

$choice = $_POST['choice'];
$quiz_id = $_POST['quiz_id'];
$quiz_title = $_POST['quiz_title'];
$quiz_about = $_POST['quiz_about'];
$question_id = $_POST['question_id'];
$question = $_POST['question'];
$option_id = $_POST['option_id'];
$option_answer = $_POST['option_answer'];
$is_correct = $_POST['is_correct'];
$image = $_POST['quiz_image'];

$quiz_id = intval($quiz_id);
$question_id = intval($question_id);
$option_id = intval($option_id);

$db = new DbHandler();

if($choice == "choice1") {

    $add_new = "INSERT INTO quiz(id, title, about, image) VALUES ($quiz_id, '$quiz_title','$quiz_about', '$image')";
    $edit_old = "UPDATE quiz SET title='$quiz_title', about='$quiz_about', image='$image' WHERE id=$quiz_id";
    $result = $db->select("SELECT * FROM quiz WHERE id=$quiz_id");

    if(mysqli_num_rows($result)) {
        $db->edit($edit_old);
    } else {
        $db->insert($add_new);
    }

} else if($choice == "choice2") {

    $add_new = "INSERT INTO quiz_question(id, quiz_id, question) VALUES ($question_id, $quiz_id, '$question')";
    $edit_old = "UPDATE quiz_question SET quiz_id=$quiz_id, question='$question' WHERE id=$question_id";
    $result = $db->select("SELECT * FROM quiz_question WHERE id=$question_id");

    if(mysqli_num_rows($result)) {
        $db->edit($edit_old);
    } else {
        $db->insert($add_new);
    }

} else if($choice == "choice3") {

    $add_new = "INSERT INTO quiz_question_option(id, quiz_question_id, answer, is_correct) VALUES ($option_id, $question_id, '$option_answer', $is_correct)";
    $edit_old = "UPDATE quiz_question_option SET quiz_question_id=$question_id, answer='$option_answer', is_correct=$is_correct WHERE id=$question_id";
    $result = $db->select("SELECT * FROM quiz_question_option WHERE id=$option_id");

    if(mysqli_num_rows($result)) {
        $db->edit($edit_old);
    } else {
        $db->insert($add_new);
    }

} else if($choice == "choice4") { 

    
    $result = $db->select("SELECT * FROM quiz WHERE id=$quiz_id");
    $delete_quiz = "DELETE FROM quiz WHERE id=$quiz_id;";

    if(mysqli_num_rows($result)) {
        $db->edit($delete_quiz);
    } 

} else if($choice == "choice5") { 

    $result1 = $db->select("SELECT * FROM quiz_question_option WHERE quiz_question_id=$question_id");
    $result = $db->select("SELECT * FROM quiz_question WHERE id=$question_id");

    $delete_question1 = "DELETE FROM quiz_question_option WHERE quiz_question_id=$question_id;";
    $delete_question = "DELETE FROM quiz_question WHERE id=$question_id;";

    if(mysqli_num_rows($result)) {
        if(mysqli_num_rows($result1)) {
            $db->edit($delete_question1);
        }
        $db->edit($delete_question);
    } 

}

?>

<!DOCTYPE html>
<html lang="en">

<body>
<form action="../edit_page.html" method="get">
    <input type="submit" value="Get back">
</form>

</body>

</html>

