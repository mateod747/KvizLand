<?php
    require "./controller/DbHandler.php";

    use Db\DbHandler;
 
	$db = new DbHandler();
	
	$db->connect();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>Quiz Land</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="css/owl.carousel.css" rel="stylesheet">
		<link href="css/owl.theme.default.min.css"  rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="page-top">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand page-scroll" href="https://kvizland.herokuapp.com/"><img src="images/mylogo.png" alt="Quiz Land"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li>
							<a class="page-scroll" href="https://www.instagram.com/mateodubinjak/">@mateodubinjak</a>
						</li>
						<li>
							<a class="page-scroll" href="edit_page.html">Edit Quizzes</a>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		<!-- Header -->
		<header>
			<div class="container">
				<div class="slider-container">
					<div class="intro-text">
						<div class="intro-lead-in">Quiz Collection!</div>
						<div class="intro-heading">Lets see how smart you are hehe</div>
						<a href="edit_page.html" class="page-scroll btn btn-xl">Edit Quizzes</a>
					</div>
				</div>
			</div>
		</header>
		
		<section id="portfolio" class="light-bg">
			<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">						
						<form name="form" action="https://kvizland.herokuapp.com#portfolio" method="get">
							<input type="hidden" id="hiddencontainer" name="hiddencontainer">
							<input type="submit" id="clicked" value="Take a Quiz!">
						</form>						
						<?php
							$hidden_id=$_GET["hiddencontainer"];
							$hidden_id_int = intval($hidden_id);
							$quiz_id = $db->select("SELECT id, title, about FROM quiz WHERE id=$hidden_id_int;");
							$quiz_questions = $db->select("SELECT id, question FROM quiz_question WHERE quiz_id=$hidden_id;");
							$row_id = $quiz_id->fetch_assoc();
						?>
						<h2 id="title"><?=$row_id["title"]?></h2>
						<h4 id="about"></h4>

						<div id="hide">
						<?php
							$question_ids = [];
							$answers_array;
							$counter = 0;
							$option_ids = [];
							$option_corrects = [];
							if($quiz_questions->num_rows > 0):
							while($question_row = $quiz_questions->fetch_assoc()):
								array_push($question_ids, $question_row["id"]);
								$needed_id = $question_row["id"];
								$answers_array = $db->select("SELECT id, answer, is_correct FROM quiz_question_option WHERE quiz_question_id=$needed_id;");
								$counter = $counter + 1;							
						?>

						<div id="num<?=$question_row["id"]?>" >
							
							<h3><?=$question_row["question"]?></h3>

							<form>

							<?php 
								if($answers_array->num_rows > 0):
								while($option = $answers_array->fetch_assoc()):
									array_push($option_ids, $option["id"]);
									array_push($option_corrects, $option["is_correct"]);
							?>

							<input type="checkbox" label="<?=$option["id"]?>" id="check<?=$option["id"]?>">
							<label for="<?=$option["id"]?>" id="option<?=$option["id"]?>"><?=$option["answer"]?></label><br>

							<?php endwhile;
								endif; ?>

							<?php if($counter == $quiz_questions->num_rows): ?>
								<button onClick='_checkAnswers(<?php echo json_encode($option_ids) ?>, <?php echo json_encode($option_corrects) ?>); return false;'>See results</button>

							<?php $counter = 0; 
								endif; ?>

							</form>
						</div>
								
						<?php endwhile;
							endif; ?>	
						
						<h4 id="result"></h4>

						</div> 		
					</div>
				</div>
			</div>
			</div>	
		</section>
		
		<section id="quiz_section" class="light-bg">
			<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>Quizzes</h2>
						<p>Choose from quizzes and press the button to start.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- start portfolio item -->
				<form>
				<?php 
					$quizzes = $db->select("SELECT id, title, about, image FROM quiz");
					$questions = $db->select("SELECT id, quiz_id, question FROM quiz_question");
					$answers = $db->select("SELECT id, quiz_question_id, answer, is_correct FROM quiz_question_option");

                    if($quizzes->num_rows > 0):
					while($row = $quizzes->fetch_assoc()):
                ?>				
				<div class="col-md-4">
					<input type="radio" class="hide_radio_button" id="<?=$row["id"]?>" name="radio" value="<?=$row["title"]?>">
					<div class="ot-portfolio-item" id="new">
						<figure class="effect-bubba show_border box_hover" onClick="_radio_button_click(<?php echo $row["id"] ?>);" id="pls<?=$row["id"]?>">
							<img src="<?=$row["image"]?>" alt="img02" class="img-responsive" />
							<figcaption>
								<h2><?=$row["title"]?></h2>
								<p><?=$row["about"]?></p>
							</figcaption>
						</figure>
					</div>
				</div>
				</form>
				<?php endwhile;
                        endif;?> 

			</div><!-- end container -->
		</section>
		
		<p id="back-top">
			<a href="#top"><i class="fa fa-angle-up"></i></a>
		</p>
		<footer>
			<div class="container text-center">
				<p>Designed by <a href="http://moozthemes.com"><span>MOOZ</span>Themes.com</a></p>
			</div>
		</footer>

		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/cbpAnimatedHeader.js"></script>
		<script src="js/theme-scripts.js"></script>
		<script src="js/index.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>