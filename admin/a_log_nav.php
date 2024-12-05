
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>nav {
      background-color: rgba(0, 128, 128, 0.9);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 50px;
      position: sticky;
      top: 0;
      z-index: 1000;
      color: white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    nav .logo {
      font-size: 24px;
      font-weight: bold;
      color: white;
      text-transform: uppercase;
    }

    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    nav ul li {
      margin-left: 20px;
      position: relative;
    }

    nav ul li a {
      font-size: 16px;
      color: white;
      padding: 5px 10px;
      text-transform: capitalize;
      transition: 0.3s;
      display: flex;
      align-items: center;
    }

    nav ul li a i {
      margin-right: 8px;
    }

    nav ul li a:hover {
      border-bottom: 2px solid white;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 150px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      overflow: hidden;
      top: 30px;
      z-index: 1000;
    }

    .dropdown-content a {
      color: #333;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
      font-size: 14px;
    }

    .dropdown-content a:hover {
      background-color: #f4f4f4;
    }

    nav ul li:hover .dropdown-content {
      display: block;
    }</style>
<nav>
    <div class="logo">AgroWave</div>
    <ul>
      <li><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="../contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
      <li class="dropdown">
        <a href="#"><i class="fas fa-sign-in-alt"></i> Login</a>
        <div class="dropdown-content">
       
          <a href="../admin/alogin.php"><i class="fas fa-user-shield"></i> Admin</a>
        </div>
      </li>
     
  </ul>
</nav>