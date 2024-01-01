document.addEventListener('DOMContentLoaded', function () {
  // Create a new footer element
  var footer = document.createElement('footer');
  footer.className = 'site-footer';
  
  // Set the HTML content of the footer
  footer.innerHTML = `
    
    <!-- Site footer -->
    <footer class="site-footer">
    
      <div class="container">
        <div class="row">
          <div class="col-sm-7 col-md-4">
            <h6>About US</h6>
            <p class="text-justify"> Welcome to our site, your trusted partner in affordable and reliable car rentals. Explore our diverse fleet of vehicles and enjoy a seamless rental experience.</p>
          </div>

          <div class="col-xs-5 col-md-3">
            <h6>Top offices</h6>
            <ul class="footer-links">
              <li><a >Eygpt</a></li>
              <li><a >UAE</a></li>
              <li><a >Saudi Arabia</a></li>
              <li><a >Qatar</a></li>
            </ul>
          </div>
  
          <div class="col-xs-5 col-md-3">
            <h6>Explore</h6>
            <ul class="footer-links">
              <li><a href="#">Rent a car</a></li>
              <li><a href="#">List your cars</a></li>
              <li><a href="#">How it works</a></li>
            </ul>
          </div>

          <div class="col-xs-5 col-md-2">
            <h6>Quick</h6>
            <ul class="footer-links">
              
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Contribute</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Sitemap</a></li>
            </ul>
          </div>
          
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
          
         
          <ul class="social-icons1">
    <li><a class="mastercard"><img src="../Images2/mastercard-ico.png" alt="mastercard"></a></li>
    <li><a class="visa"><img src="../Images2/visa-ico.png" alt="visa"></a></li>   
</ul>

      
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
    <li><a class="facebook"><img src="../Images2/fb-ico.png" alt="Facebook"></a></li>
    <li><a class="twitter" href="#"><img src="../Images2/tw-ico.png" alt="Twitter"></a></li>
    <li><a class="" href="#"><img src="../Images2/yt-ico.png" alt="youtube"></a></li>
    <li><a class="Instagram" href="#"><img src="../Images2/inst-ico.png" alt="Instagram"></a></li>   
</ul>

      
          </div>
        </div>
      </div>
</footer>
    `;

  // Append the footer to the body (or any other desired location)
  document.body.appendChild(footer);

  // Add CSS dynamically
  var style = document.createElement('style');
  style.type = 'text/css';
  style.innerHTML = `
    .site-footer
    {
      margin-top: 30px;
      background-color:#364352;
      padding:30px 0 10px;
      font-size:15px;
      line-height:24px;
      color:#737373;
    }
    .site-footer hr
    {
      border-top-color:#bbb;
      opacity:0.5
    }
    .site-footer hr.small
    {
      margin:20px 0
    }
    .site-footer h6
    {
      color:#fff;
      font-size:16px;
      text-transform:uppercase;
      margin-top:5px;
      letter-spacing:2px
    }
    .site-footer a
    {
      color:#737373;
    }
    .site-footer a:hover
    {
      color:#778899;
      text-decoration:none;
    }
    .footer-links
    {
      padding-left:0;
      list-style:none
    }
    .footer-links li
    {
      display:block
    }
    .footer-links a
    {
      color:#737373
    }
    .footer-links a:active,.footer-links a:focus,.footer-links a:hover
    {
      color:#3366cc;
      text-decoration:none;
    }
    .footer-links.inline li
    {
      display:inline-block
    }
    .site-footer .social-icons
    {
      text-align:right
    }
    .site-footer .social-icons a
    {
      width:40px;
      height:40px;
      line-height:40px;
      margin-left:6px;
      margin-right:0;
      border-radius:100%;
      background-color:#33353d
    }
    .site-footer .social-icons1
    {
      text-align:left
    }
    .site-footer .social-icons1 a
    {
      width:40px;
      height:40px;
      line-height:40px;
      margin-left:6px;
      margin-right:0;
      border-radius:100%;
      background-color:#33353d
    }
    .copyright-text
    {
      margin:0
    }
    @media (max-width:991px)
    {
      .site-footer [class^=col-]
      {
        margin-bottom:30px
      }
    }
    @media (max-width:767px)
    {
      .site-footer
      {
        padding-bottom:0
      }
      .site-footer .copyright-text,.site-footer .social-icons
      {
        text-align:center
      }
    }
    .social-icons
    {
      padding-left:0;
      margin-bottom:0;
      list-style:none
    }
    .social-icons li
    {
      display:inline-block;
      margin-bottom:4px
    }
    .social-icons li.title
    {
      margin-right:15px;
      text-transform:uppercase;
      color:#96a2b2;
      font-weight:700;
      font-size:13px
    }
    .social-icons a{
      background-color:#eceeef;
      color:#818a91;
      font-size:16px;
      display:inline-block;
      line-height:44px;
      width:44px;
      height:44px;
      text-align:center;
      margin-right:8px;
      border-radius:100%;
      -webkit-transition:all .2s linear;
      -o-transition:all .2s linear;
      transition:all .2s linear
    }
    .social-icons a:active,.social-icons a:focus,.social-icons a:hover
    {
      color:#fff;
      background-color:#29aafe
    }
    .social-icons.size-sm a
    {
      line-height:34px;
      height:34px;
      width:34px;
      font-size:14px
    }
    .social-icons a.facebook:hover
    {
      background-color:#3b5998
    }
    .social-icons a.twitter:hover
    {
      background-color:#00aced
    }
    .social-icons a.Instagram:hover
    {
      background-color:#007bb6
    }
    .social-icons a.youtube:hover
    {
      background-color:#ea4c89
    }
    @media (max-width:767px)
    {
      .social-icons li.title
      {
        display:block;
        margin-right:0;
        font-weight:600
      }
    }
    
    .social-icons1
    {
      padding-left:0;
      margin-bottom:0;
      list-style:none
    }
    .social-icons1 li
    {
      display:inline-block;
      margin-bottom:4px
    }
    .social-icons1 li.title
    {
      margin-right:15px;
      text-transform:uppercase;
      color:#96a2b2;
      font-weight:700;
      font-size:13px
    }
    
    
    .social-icons1.size-sm a
    {
      line-height:50px;
      height:34px;
      width:34px;
      font-size:14px
    }
   
   
    @media (max-width:767px)
    {
      .social-icons1 li.title
      {
        display:block;
        margin-right:0;
        font-weight:600
      }
    }
    `;

  // Append the style to the head
  document.head.appendChild(style);
});
