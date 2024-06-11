<?php
// header('Location: apps'); /* Redirect browser */

// /* Make sure that code below does not get executed when we redirect. */
// exit;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warebox - Your safest digital locker</title>

  <!-- 
    - favicon
  -->
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
    rel="stylesheet">


</head>

<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="#" class="logo">
        <img src="./assets/images/logowarebox.svg" alt="Warebox logo">
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li>
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li>
            <a href="#book-locker" class="navbar-link" data-nav-link>Explore Lockers</a>
          </li>

          <li>
            <a href="#how-it-works" class="navbar-link" data-nav-link>How it works</a>
          </li>

          <li>
            <a href="#Testimonials" class="navbar-link" data-nav-link>Testimonials</a>
          </li>

        </ul>
      </nav>

      <div class="header-actions">

        <a href="topup.php" class="btn" aria-labelledby="aria-label-txt">
          <span id="aria-label-txt">Top Up</span>
      </a>      

        <a href="register.php" class="btn" aria-labelledby="aria-label-txt">


          <span id="aria-label-txt">Register</span>
        </a>

        <a href="login.php" class="btn user-btn" aria-label="Profile">
          <ion-icon name="person-outline"></ion-icon>
      </a>      

        <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

      </div>

    </div>
  </header>


  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero" id="home">
        <div class="container">

          <p class="hero-description">100% Trusted Locker in Indonesia</p>

          <div class="hero-content">
            <h2 class="h1 hero-title">SECURE YOUR BELONGINGS WITH OUR DIGITAL LOCKERS</h2>

            <p class="hero-text">
              Experience ultimate convenience and security with our state-of-the-art digital lockers. Whether you need a temporary storage solution or a long-term safe space, our lockers provide the perfect answer.
            </p>
            
          </div>

          <div class="hero-banner"></div>

          <form action="" class="hero-form">

            <div class="input-wrapper">
              <label for="input-1" class="input-label">Locations</label>

              <select name="car-model" id="input-1" class="input-field">
                <option value="" selected disabled>Select your city</option>
                <option value="city1">Batam</option>
                <option value="city2">Jakarta</option>
                <option value="city3">Bandung</option>
              </select>
            </div>

            <div class="input-wrapper">
              <label for="input-2" class="input-label">Date</label>
              <input type="date" name="monthly-pay" id="input-2" class="input-field" placeholder="Select your date">
          </div>

          <div class="input-wrapper">
            <label for="input-3" class="input-label">Time</label>
            <input type="time" name="year" id="input-3" class="input-field" placeholder="Select your time">
        </div>        

            <button type="submit" class="btn">Search</button>

          </form>

        </div>
      </section>





      <!-- 
        - #BOOK LOCKER
      -->

      <section class="section book-locker" id="book-locker">
        <div class="container">
          <div class="title-wrapper">
            <h2 class="h2 section-title">Book Your Locker</h2>
          </div>
          <ul class="book-locker-list">
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">1</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">2</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card unavailable">
                <div class="badge">Online</div>
                <span class="locker-number big">3</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn unavailable" disabled>Unavailable</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">4</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">5</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card unavailable">
                <div class="badge">Offline</div>
                <span class="locker-number big">6</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn unavailable">Unavailable</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">7</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">8</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">9</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">10</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">11</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">12</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">13</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">14</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">15</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">16</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">17</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">18</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Online</div>
                <span class="locker-number big">19</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <a href="booknow.html" class="btn">Book Now</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="book-locker-card">
                <div class="badge">Offline</div>
                <span class="locker-number big">20</span>
                <div class="card-content">
                  <div class="card-title-wrapper"></div>
                  <div class="card-price-wrapper">
                    <p class="card-price">
                      <strong>2.000</strong> / 2 hours
                    </p>
                    <button class="btn">Available</button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </section>




      <!-- 
        - #HOW IT WORKS
      -->

      <section class="section how-it-works" id="how-it-works">
        <div class="container">

          <h2 class="h2 section-title">How It Works</h2>

          <p class="section-description">Access your belongings whenever you need, day or night.</p>

          <br>
          <br>

          <ul class="how-it-works-list">

            <li>
              <div class="how-it-works-card">

                <div class="card-icon icon-1">
                  <ion-icon name="person-add-outline"></ion-icon>
                </div>

                <h3 class="card-title">Create a profile</h3>

                <p class="card-text">
                  Set up your personal or professional profile to get started.
                </p>

                <a href="#" class="card-link">Get started</a>

              </div>
            </li>

            <li>
              <div class="how-it-works-card">

                <div class="card-icon icon-2">
                  <ion-icon name="car-outline"></ion-icon>
                </div>

                <h3 class="card-title">Book the locker</h3>

                <p class="card-text">
                  Select the number on the locker and book the locker you want.
                </p>

              </div>
            </li>

            <li>
              <div class="how-it-works-card">

                <div class="card-icon icon-3">
                  <ion-icon name="person-outline"></ion-icon>
                </div>

                <h3 class="card-title">Payment</h3>

                <p class="card-text">
                  Top up your money and make a payment.
                </p>

              </div>
            </li>

            <li>
              <div class="how-it-works-card">

                <div class="card-icon icon-4">
                  <ion-icon name="card-outline"></ion-icon>
                </div>

                <h3 class="card-title"></h3>

                <p class="card-text">
                  Take the card at the locker you ordered
                </p>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #Testimonials
      -->

      <section class="section Testimonials" id="Testimonials">
        <div class="container">

          <h2 class="h2 section-title">Testimonials</h2>

          <ul class="Testimonials-list has-scrollbar">

            <li>
              <div class="Testimonials-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/Testimonials-1.jpg" alt="Udin" loading="lazy"
                      class="w-100">
                  </a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Udin</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="Testimonials-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/Testimonials-2.jpg" alt="Bella" loading="lazy"
                      class="w-100">
                  </a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Bella</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="Testimonials-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/Testimonials-3.jpg" alt="Ema" loading="lazy"
                      class="w-100">
                  </a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Ema</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="Testimonials-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/Testimonials-4.jpg" alt="Dini" loading="lazy"
                      class="w-100">
                  </a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Dini</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="Testimonials-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="./assets/images/Testimonials-5.jpg" alt="Sapi" loading="lazy"
                      class="w-100">
                  </a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Sapi</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="container">

      <div class="footer-top">

        <div class="footer-brand">
          <a href="#" class="logo">
            <img src="./assets/images/logowarebox.svg" alt="Warebox logo">
          </a>

          <p class="footer-text">
            Your Trusted Locker Companion, Anytime, Anywhere.
          </p>
        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Company</p>
          </li>

          <li>
            <a href="#" class="footer-link">How it works</a>
          </li>

          <li>
            <a href="#" class="footer-link">Pricing plans</a>
          </li>

          <li>
            <a href="#" class="footer-link">Our Testimonials</a>
          </li>

          <li>
            <a href="#" class="footer-link">Contacts</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Support</p>
          </li>

          <li>
            <a href="#" class="footer-link">Help center</a>
          </li>

          <li>
            <a href="#" class="footer-link">Ask a question</a>
          </li>

          <li>
            <a href="#" class="footer-link">Privacy policy</a>
          </li>

          <li>
            <a href="#" class="footer-link">Terms & conditions</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Neighborhoods in Indonesia</p>
          </li>

          <li>
            <a href="#" class="footer-link">Medan</a>
          </li>

          <li>
            <a href="#" class="footer-link">Jakarta</a>
          </li>

          <li>
            <a href="#" class="footer-link">Bandung</a>
          </li>

        </ul>

      </div>

      <div class="footer-bottom">

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="mail-outline"></ion-icon>
            </a>
          </li>

        </ul>

        <p class="copyright">
          &copy; 2024 <a href="#">Warebox</a>. All Rights Reserved
        </p>

      </div>

    </div>
  </footer>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>