<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroWave</title>
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <style>
    /* General Styles */
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background: url('assets/img/x.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    a:hover {
      color: #007bff;
    }

    /* Hero Section */
    header {
      height: 100vh;
      background: rgba(0, 0, 0, 0.6);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      padding: 0 20px;
    }

    header h1 {
      font-size: 4rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    header p {
      font-size: 1.5rem;
      margin-bottom: 30px;
      max-width: 700px;
    }

    header button {
      background: #ffc107;
      border: none;
      color: #333;
      padding: 15px 30px;
      font-size: 16px;
      border-radius: 30px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    header button:hover {
      background: #e0a800;
    }

    /* Features Section */
    .features {
      padding: 80px 20px;
      background: rgba(255, 255, 255, 0.9);
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 80%;
      margin: -60px auto 0 auto; /* Adjusted for better spacing */
      border-radius: 20px;
      z-index: 1;
      position: relative;
    }

    .features h3 {
      font-size: 2.5rem;
      font-weight: bold;
      color: #28a745;
      margin-bottom: 40px;
    }

    .features .row {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }

    .features .card {
      background: #f9f9f9;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 300px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-top: 20px;
    }

    .features .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .features .card i {
      margin-bottom: 20px;
      font-size: 3rem;
      color: #007bff;
    }

    .features .card h4 {
      font-size: 1.5rem;
      margin-bottom: 10px;
      color: #333;
    }

    .features .card p {
      font-size: 1rem;
      color: #666;
    }

    /* Innovations and News Section */
    .innovations, .news, .content {
      padding: 50px 20px;
      text-align: center;
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      margin: 50px auto;
      width: 80%;
      border-radius: 20px;
      position: relative;
    }

    .innovations h3, .news h3, .content h3 {
      font-size: 2.5rem;
      font-weight: bold;
      color: #28a745;
      margin-bottom: 30px;
    }

    .innovation-item, .news-item, .content-item {
      margin-bottom: 20px;
      font-size: 1.2rem;
      color: #333;
      line-height: 1.6;
      transition: transform 0.3s ease;
    }

    .innovation-item:hover, .news-item:hover, .content-item:hover {
      transform: translateX(10px);
    }

    /* Footer */
    footer {
      background: #333;
      color: white;
      text-align: center;
      padding: 20px;
      position: relative;
      bottom: 0;
      width: 100%;
    }

    footer p {
      margin: 0;
      font-size: 14px;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
      header h1 {
        font-size: 3rem;
      }

      header p {
        font-size: 1.2rem;
      }

      .features .row {
        flex-direction: column;
        gap: 20px;
      }

      .features .card {
        width: 100%;
      }
    }
    /* Simple Footer Styles */
.simple-footer {
  background-color: #333;
  color: white;
  text-align: center;
  padding: 20px;
  font-size: 14px;
  position: relative;
  bottom: 0;
  width: 100%;
}

.simple-footer .social-icons {
  margin-top: 10px;
}

.simple-footer .social-icons a {
  margin: 0 10px;
  color: white;
  font-size: 1.2rem;
  transition: color 0.3s ease;
}

.simple-footer .social-icons a:hover {
  color: #ffc107;
}

.simple-footer i {
  color: #e74c3c;
}

  </style>
</head>
<body>
  <?php include('navbar.php'); ?>

  <!-- Hero Section -->
  <header>
    <h1>Welcome to AgroWave</h1>
    <p>Your Trusted Partner in Modern Agriculture</p>
    <button onclick="scrollToFeatures()">Explore Features</button>
  </header>

  <!-- Features Section -->
  <section class="features" id="features">
    <h3>Features</h3>
    <div class="row">
      <div class="card">
        <i class="fas fa-leaf"></i>
        <h4>Sustainable Practices</h4>
        <p>We promote eco-friendly and sustainable farming techniques.</p>
      </div>
      <div class="card">
        <i class="fas fa-chart-line"></i>
        <h4>Data Analytics</h4>
        <p>Data-driven solutions for optimizing agriculture practices.</p>
      </div>
      <div class="card">
        <i class="fas fa-tools"></i>
        <h4>Modern Tools</h4>
        <p>Advanced tools to empower farmers with technology.</p>
      </div>
    </div>
  </section>

  <!-- Bangladeshi Agriculture News Section -->
  <section class="news">
    <h3>Latest Bangladeshi Agriculture News</h3>
    <div class="news-item">
      <strong>Government Pushes for Organic Farming to Boost Agriculture</strong><br>
      The Bangladeshi government is increasing efforts to promote organic farming, aiming to improve soil health and reduce the environmental impact of conventional agriculture.
    </div>
    <div class="news-item">
      <strong>Bangladesh Farmers to Receive Subsidies for Climate-Smart Agriculture</strong><br>
      In an effort to combat climate change, the government has announced subsidies for farmers who adopt climate-smart practices, including water-saving irrigation systems and drought-resistant crops.
    </div>
    <div class="news-item">
      <strong>New Agricultural Technology to Improve Rice Yield</strong><br>
      Researchers in Bangladesh have developed a new rice cultivation technology that promises to increase yields by 30%, addressing the food security challenges in the country.
    </div>
    <div class="news-item">
      <strong>Bangladesh's Agriculture Exports Surge Amid Global Demand</strong><br>
      Bangladesh's agricultural export sector has experienced a significant boost, with a growing demand for crops like mangoes, jute, and rice from international markets.
    </div>
  </section>

  <!-- Content for Farmers Section -->
  <section class="content">
    <h3>Content to Empower Farmers</h3>
    <div class="content-item">
      <strong>Crop Protection Tips:</strong><br>
      Learn how to protect your crops from pests and diseases using eco-friendly methods, ensuring healthy harvests and better yields.
    </div>
    <div class="content-item">
      <strong>Climate-Smart Agriculture:</strong><br>
      Adopt climate-smart practices to improve productivity and ensure the sustainability of your farm despite climate challenges.
    </div>
  </section>

  <!-- Footer -->
  <!-- Footer -->
<!-- Simple Footer -->
<footer class="simple-footer">
  <p>&copy; 2024 AgroWave | Designed by AgroWave Team</p>
  <div class="social-icons">
    <a href="https://www.facebook.com/AgroWave" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <a href="https://www.instagram.com/AgroWave" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/AgroWave" target="_blank"><i class="fab fa-twitter"></i></a>
    <a href="https://www.linkedin.com/company/agrowave" target="_blank"><i class="fab fa-linkedin"></i></a>
  </div>
</footer>


  <script>
    function scrollToFeatures() {
      document.getElementById('features').scrollIntoView({ behavior: 'smooth' });
    }
  </script>
</body>
</html>
