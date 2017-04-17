<!doctype html>
<html>
  <head>
    <meta charset="utf-8" name="author" content="ktedid">
    <link rel="icon" href="IMAGES/flag.png">

    <title>KC</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <?php
    // variables for validation of contact form
    $nameError = "";
    $emailError = "";
    $name = "";
    $email = "";
    $comment = "";
    $valid = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $valid = true;
      if (empty($_POST["name"])) {
        $nameError = "Please enter a name";
        $valid = false;
      } else {
        $name = test_input($_POST["name"]);
        //checking for only letters or spaces input
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
          $nameError = "Name can only contain letters and spaces";
          $valid = false;
        }
      }
      if (empty($_POST["email"])) {
        $emailError = "Please enter an email";
        $valid = false;
      } else {
        $email = test_input($_POST["email"]);
        //checking for correct email content
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailError = "Invalid email";
          $valid = false;
        }
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if ($valid) {
      submitRequest();
      //exit();
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    function submitRequest() {
      require 'PHP/connect.php';
      $conn = Connect();
      $name = $conn->real_escape_string($_POST['name']);
      $email = $conn->real_escape_string($_POST['email']);
      $message = $conn->real_escape_string($_POST['comment']);
      $query = "INSERT into dbTable (u_name, u_email, message) VALUES('" . $name . "','" . $email . "','" . $message . "')";
      $success = $conn->query($query);

      if (!$success) {
          die("Couldn't enter data: ".$conn->error);
      }

      echo "<script type='text/javascript'>alert('Thank you for contacting me!')</script>";

      $conn->close();
    }

    ?>

    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">KC</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <?php
                  $links=array(
                    array("About","#about"),
                    array("Contact","#contact"),
                    array("Pitt","#school"),
                    array("HERL", "#work"),
                    array("Serve", "#serve"),
                    array("Fun", "#hobbies")
                  );

                  for($i = 0; $i < 6; $i++)
                  {
                    for($j = 0; $j < 1; $j++)
                    {
                      $term = $links[$i][$j];
                      $codeword = $links[$i][$j+1];
                      echo "<li><a href='$codeword'>$term</a></li>";
                    }
                  }
                ?>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Hello!</h1>
              <p>Welcome to the online home of Katee Coleman. You'll find information about my professional endeavors and personal hobbies throughout the page. Use the navigational buttons above to explore, and click below to view my resume.</p>
              <p><a class="btn btn-lg btn-primary" href="#resume" role="button">Resume</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Just a girl, in her city.</h1>
              <p>I've only been located in Pittsburgh for 4 years, but that was enough to fall in love.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Love, you say?</a></p>
            </div>
          </div>
        </div>
        <!-- <div class="item">
          <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Probably don't need this one.</h1>
              <p>Worth a try.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div> -->
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->

    <!-- ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <section id="about">
        <div class="row">
          <div class="col-lg-4">
            <img class="img-circle" src="IMAGES/Pitt.png" alt="Generic placeholder image" width="180" height="140">
            <h2>University of Pittsburgh</h2>
            <p>Senior Computer Science student at the University of Pittsburgh. U.S. Army ROTC cadet.</p>
            <p><a class="btn btn-default" href="#school" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="img-circle" src="IMAGES/herl.png" alt="Generic placeholder image" width="140" height="140">
            <h2>HERL</h2>
            <p>The Human Engineering Research Laboratories (HERL) has provided me the opportunity to work as a research intern for 2 years!</p>
            <p><a class="btn btn-default" href="#work" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="img-circle" src="IMAGES/me1.jpg" alt="Generic placeholder image" width="150" height="140">
            <h2>PA National Guard</h2>
            <p>Before my time as a student, I was a soldier.</p>
            <p><a class="btn btn-default" href="#serve" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
      </section>


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <section id="school">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">H2P!<span class="text-muted"></span></h2>
            <p class="lead">Class of 2018</p>
          </div>
          <div class="col-md-5">
            <!-- <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image"> -->
            <p>
              I attend the University of Pittsburgh, majoring in Computer Science, and minoring in Mathematics. Along with my
              studies, I participate in the Pitt Army ROTC (Reserve Officers' Training Corps). I received a 3-year full tuition scholarship,
              funded through ROTC, for my acheivements. After completion of my Bachelors of Science degree in CS, I will also
              commission as a Second Lieutenant in the Pennsylvania Army National Guard.
            </p>
          </div>
          <p class="pull-right"><a href="#">Back to top</a></p>
        </div>
      </section>

      <hr class="featurette-divider">

      <section id="work">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">HERL<span class="text-muted"></span></h2>
            <p class="lead">Research Intern</p>
            <p class="pull-right"><a href="#">Back to top</a></p>
          </div>
          <div class="col-md-5">
            <!-- <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image"> -->
            <p>
              Starting in the summer of 2015, I worked at HERL, the Human Engineering Research Laboratories, as a veteran intern.
              I participated in the research iternship ELeVATE (Experiential Learning for Veterans in Assistive Technology and Engineering),
              which is designed to re-integrate veterans to college and introduce them to academic research and vocational opportunities.
              At the end of the internship, I won the internal "Elevator Pitch" and was awarded the chance to present my summer
              research the Annual HERL Summer Research Symposium. Since completion of ELeVATE, I have been working as a part-time
              intern, specializing in Android app development for assistive technology.
            </p>
          </div>
        </div>
      </section>

      <hr class="featurette-divider">

      <section id = "serve">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">U.S. Army<span class="text-muted"></span></h2>
            <p class="lead">National Guard</p>
          </div>
          <div class="col-md-5">
            <!-- <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image"> -->
            <p>
              In May 2011, I enlisted into the Pennsylvania Army National Guard. I went to basic training and went on to
              complete advanced individual training, graduating as honor graduate, first in class. My job in the Army is known
              as a Biomedical Maintenance Equipment Technician (BMET), meaning I maintained medical equipment with routine
              preventive maintenance and made repairs when necessary. I made the rank of Specialist, E-4, before I made the decision
              to attend college. Once in college, I joined the Pitt Army ROTC, attaining the rank of Cadet, E-5. I am sill a
              member of the PA National Guard, and I will continue to be a Guardsman after completion of my BS and commissioning.
            </p>
          </div>
          <p class="pull-right"><a href="#">Back to top</a></p>
        </div>
      </section>

      <hr class="featurette-divider">

      <section id="contact">
        <div class="row featurette">
          <div class="col-md-7">
            <?php
              echo"<h2 class='featurette-heading'>You wanna chit-chat?</h2>";
              echo"<p class='lead'>Leave me a comment!</p>";
            ?>
          </div>
          <div class="col-md-5">
            <div type="form">
              <p><span class="error">* required field.</span></p>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label>Name:
                  <input type="text" name="name">
                  <span class="error">*
                    <?php
                      if ($nameError != "") {
                        echo "<script type='text/javascript'>alert('$nameError')</script>";
                      }
                    ?>
                  </span>
                </label>
                <br>
                <label>Email:
                  <input type="text" name="email">
                  <span class="error">*
                    <?php
                      if ($emailError != "") {
                        echo "<script type='text/javascript'>alert('$emailError')</script>";
                      }
                    ?>
                  </span>
                </label>
                <br><br>
                <label>Comment:
                  <br><textarea name="comment" rows="6" cols="40"></textarea>
                </label>
                <br><br>
                <input type="submit">
                <br><br>
              </form>
            </div>
          </div>
          <p class="pull-right"><a href="#">Back to top</a></p>
        </div>
      </section>

      <section id = "resume">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Resume</h2>
          </div>
            <?php
              echo "<object data='IMAGES/Resume2016.pdf' type='application/pdf' width='800' height='500'></object>";
            ?>
        </div>
      </section>

      <!-- /END THE FEATURETTES -->

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017 Katee Coleman. &middot;</p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
