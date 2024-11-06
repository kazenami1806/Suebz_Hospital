<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="fontawesome/css/all.css" />
  <link rel="stylesheet" href="clinic.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <title>Suebz Hospital</title>
  <nav>
    <div class="nav-content">
      <img src="img/logo.png" alt="logo" class="img_logo" />
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="layanan.php">Layanan</a></li>
        <li><a href="index.php#1">About</a></li>
      </ul>
    </div>
  </nav>
</head>

<body>
  <div class="wp">
    <section id="0">
      <div class="slider">
        <?php
              include './config/koneksi.php';
              $data = mysqli_query($conn, "select img from gambar");
              while ($row = mysqli_fetch_assoc($data)) {
                $gambar=$row['img'];
                echo '<div><img src="./img/slideshow/' . $gambar . '"></div>';
              }
            ?>
      </div>
    </section>
    <section id="1" style="background-image: url('img/bgabout.png'); background-size: cover;">
      <div class="container">
        <div class="about">
          <div class="box-about-1">
            <h2>
              BODY MASS INDEX (BMI)
            </h2>
            <p>
              Merupakan salah satu cara mengetahui berat badan ideal yang diukur berdasarkan berat dan tinggi badan
              Anda. Dengan menghitungnya menggunakan rumus BMI, Anda bisa melihat apakah status berat badan Anda
              termasuk kategori normal, kurang, berlebih, atau bahkan obesitas.
            </p>
          </div>
          <div class="box-about-2">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/Zg0Aokvgc0A"
              title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </section>
    <section id="2">
      <div class="judul-bmi">
        <h2><span>BMI</span> CALCULATOR</h2>
      </div>
      <div class="container2">
        <div class="katalog-card" style="height: fit-content; padding: 30px;  transform: none;">
          <div class="column">
            <div class="bmi-card">
              <h1>INPUT DATA</h1>

              <form>
                <label for="weight">Berat Badan (kg):</label>
                <input type="text" id="weight" required>

                <label for="height">Tinggi Badan (cm):</label>
                <input type="text" id="height" required>
                <br>
                <button type="button" onclick="calculateBMI()">Calculate BMI</button>
              </form>

              <div id="result"></div>
            </div>
            <table id="myTable">
              <thead>
                <tr>
                  <th>Skor</th>
                  <th>Output</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Dibawah 18.6</td>
                  <td>Berat Kurang</td>
                </tr>
                <tr>
                  <td>Diatas 18.6 dan Dibawah 24.9</td>
                  <td>Berat Ideal</td>
                </tr>
                <tr>
                  <td>Diatas 24.9</td>
                  <td>Berat Berlebih</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>
    <!-- footer -->
    <footer class="footer">
      <div class="footer-left">
        <h3>KENALI<span>LEBIH DEKAT</span></h3>

        <p class="footer-about">
          Sueb Hospital juga terdapat pada beberapa sosial media untuk dapat terhubung lebih dekat dengan anda. kunjungi sosial media kami dan jika anda mempunyai kritik maupun saran, jangan segan untuk berhubungan dengan kami. 
        </p>

        <p class="footer-company-name">Sueb Klinik © 2023</p>
      </div>
      <div class="footer-center">
        <div>
          <i class="fas fa-map-marker-alt"></i>
                    <p><span>Jl. Karangrejo II/59</span> Surabaya, Jawa Timur</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+62 31 5444</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:support@company.com">support@suebzclinic.xyz</a></p>
        </div>
      </div>

      <div class="footer-right">
        <button style="cursor: pointer;" onclick="showPopup(); return false;">
          Kritik & Saran
        </button>

        <div class="footer-icons">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
        </div>
      </div>
    </footer>
  </div>
  <div id="popup" class="popup">
    <i class="fa fa-xmark x-icon" onclick="document.getElementById('popup').style.display = 'none';"></i>
    <div class="contact-form">
			<h2 class="footer-paragraph">Kritik & Saran</h2>
			<form method="POST" action="m_add_saran.php" enctype="multipart/form-data">
				<label>Name</label>
				<input type="text" id="name" name="name" placeholder="Enter your name" />

				<label>Email</label>
				<input type="email" id="email" name="email" placeholder="Enter your email" />

				<label>Subject</label>
				<input type="text" id="subject" name="subject" placeholder="Enter subject" />

				<label>Message</label>
				<textarea id="message" name="message" placeholder="Enter your message"></textarea>

				<input type="submit" value="Send Message" />
			</form>
		</div>
  </div>
  <script>
    // nav sticky
    var nav = document.querySelector("nav");
    window.addEventListener("scroll", () => {
      if (document.documentElement.scrollTop > 20) {
        nav.classList.add("sticky");
      } else {
        nav.classList.remove("sticky");
      }
    });

    // popup kritik&saran 
    function showPopup() {
      var popup = document.getElementById("popup");
      popup.style.display = "block";

    }

    // scroll to top
    let mybutton = document.getElementById("myBtn");
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }

    // BMI
    window.onload = () => {
      let button = document.querySelector("#btn");

      // Function for calculating BMI
      button.addEventListener("click", calculateBMI);
    };

    function calculateBMI() {

      /* Getting input from user into height variable.
      Input is string so typecasting is necessary. */
      let height = parseInt(document
        .querySelector("#height").value);

      /* Getting input from user into weight variable. 
      Input is string so typecasting is necessary.*/
      let weight = parseInt(document
        .querySelector("#weight").value);

      let result = document.querySelector("#result");

      // Checking the user providing a proper
      // value or not
      if (height === "" || isNaN(height))
        result.innerHTML = "Provide a valid Height!";

      else if (weight === "" || isNaN(weight))
        result.innerHTML = "Provide a valid Weight!";

      // If both input is valid, calculate the bmi
      else {

        // Fixing upto 2 decimal places
        let bmi = (weight / ((height * height)
          / 10000)).toFixed(1);

        // Dividing as per the bmi conditions
        if (bmi < 18.6) result.innerHTML =
          `Skor : <span>${bmi}</span> (Berat Kurang)`;

        else if (bmi >= 18.6 && bmi < 24.9)
          result.innerHTML =
            `Skor : <span>${bmi}</span> (Berat Ideal)`;

        else result.innerHTML =
          `Skor : <span>${bmi}</span> (Berat Berlebih)`;
      }
    }
  </script>
  <!-- Header Slideshow -->
	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Slick JS -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.slider').slick({
				autoplay: true,
				autoplaySpeed: 2500
			});
		});
	</script>
</body>

</html>