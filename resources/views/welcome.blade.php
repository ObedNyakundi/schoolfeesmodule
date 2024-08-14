<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Fee Payment Management System</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles */
    .hero {
      background: #goldenrod;
      padding: 50px 0;
      text-align: center;
    }
    .features, .testimonials, .cta {
      padding: 30px 0;
    }
    img {
      max-width: 100%;
      height: auto;
    }
    @media (min-width: 768px) {
      .hero {
        text-align: left;
      }
      .cta {
        text-align: left;
      }
    }
  </style>
</head>
<body>

<header class="container">
  <div class="row">
    <div class="col-6">
      <div class="logo">School Fee Management System</div>
    </div>
    <div class="col-6 text-right">
      <button onclick="window.location.href='{{ route('filament.admin.auth.login') }}'" class="btn btn-primary">Login</button>
      <button onclick="window.location.href='{{ route('filament.admin.auth.register') }}'" class="btn btn-secondary">Sign Up</button>

        </div>
  </div>
</header>

<section class="hero container">
  <div class="row">
    <div class="col-md-6">
      <h1>Effortlessly Track and Manage School Fees</h1>
      <p>Streamline fee tracking and payment processes with our comprehensive School Management System.</p>
      <button onclick="window.location.href='{{ route('filament.admin.auth.register') }}'" class="btn btn-secondary">Get Started</button>
    </div>
</section>

<section class="about container">
  <h2>About Our System</h2>
  <p>Our School Management System is designed to simplify the process of tracking and managing school fees. It provides an easy-to-use platform for administrators, teachers, and parents to stay on top of payments and ensure financial transparency.</p>
</section>

<section class="features container">
  <h2>Features</h2>
  <div class="row">
    <div class="col-md-4">
      <img src="{{ asset('images/img.jpeg') }}" alt="Feature 1 Icon">
         <h3>Real-time Fee Tracking</h3>
             <p>Monitor fee payments in real-time and stay updated with instant notifications.</p>
    </div>
    <div class="col-md-4">
      <img src="{{ asset('images/Untitled.jpeg') }}" alt="Feature 2 Icon">
      <h3>Automated Dashboard</h3>
      <p>Automated Dashboard to see perfomance on fee payment</p>
 </div>
    <div class="col-md-4">
     <img src="{{ asset('images/images.jpeg') }}" alt="Feature 3 Icon">

      <h4>Automated Receipt</h4>
      <p>Fee payment receipts are automatically printed</p>
</section>

<section class="cta container">
  <h2>Ready to Get Started?</h2>
  <p>Contact us: info@schoolfeemanagementsystem.com</p>
  <p>254706748162 or 254798808796</p>
</section>

<footer class="section">
  <div class="hero container">
      <div class="container">
          
        <div> <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">LinkedIn</a> <div>
        <div class="col-md-4"> 
        <div style="max-width: 500px; margin-left:auto;margin-right:auto;">
          <div>
         <a>&copy 2024 School Fee Management System</a>
         <div>
           <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        
     </div>
     </div>
     </div>
     </div>
   </div>
</footer>

</body>
</html>

