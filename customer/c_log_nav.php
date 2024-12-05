
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>/* General Navbar Styling */
nav {
  background-color: rgba(0, 128, 128, 0.9);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 50px;
  position: sticky;
  top: 0;
  z-index: 1000;
  color: white;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

nav .logo {
  font-size: 26px;
  font-weight: bold;
  color: white;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
}

nav .logo img {
  height: 35px;
  margin-right: 10px;
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
  font-size: 18px;
  color: white;
  padding: 8px 15px;
  text-transform: capitalize;
  transition: 0.3s;
  display: flex;
  align-items: center;
  border-radius: 30px;
  text-decoration: none; /* Removes underline */
}

nav ul li a i {
  margin-right: 8px;
}

nav ul li a:hover {
  background-color: rgba(0, 153, 153, 0.8);
  color: #ffc107;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Dropdown Menu Styling */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 150px;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
  top: 30px;
  z-index: 1000;
}

.dropdown-content a {
  color: #333;
  padding: 10px 15px;
  text-decoration: none; /* Removes underline */
  display: block;
  font-size: 14px;
}

.dropdown-content a:hover {
  background-color: rgba(0, 153, 153, 0.8);
  color: #ffc107;
}

nav ul li:hover .dropdown-content {
  display: block;
}

/* Responsive Menu */
@media (max-width: 768px) {
  nav {
    flex-direction: column;
    align-items: flex-start;
  }

  nav ul {
    flex-direction: column;
    width: 100%;
  }

  nav ul li {
    margin: 10px 0;
  }

  .dropdown-content {
    position: static;
    box-shadow: none;
  }

  nav ul li:hover .dropdown-content {
    display: none;
  }
}
</style>
<nav>
    <div class="logo">AgroWave</div>
    <ul>
      <li><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="../contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
      <li class="dropdown">
        <a href="#"><i class="fas fa-sign-in-alt"></i> Login</a>
        <div class="dropdown-content">
      
          <a href="customer/clogin.php"><i class="fas fa-user"></i> Customer</a>
         
        </div>
      </li>
      <li class="dropdown">
        <a href="#"><i class="fas fa-user-plus"></i> Signup</a>
        <div class="dropdown-content">
          <a href="../customer/cregister.php"><i class="fas fa-user-plus"></i> Customer</a>
        </div>
      </li>
  </ul>
</nav>