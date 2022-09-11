<div class="footer">
  <span class="follow-us-text">FOLLOW US</span>
  <div class="line" />
  <div class="logos-container">
    <a href="https://facebook.com" target="_blank">
      <img src={{asset('icons/fb-footer.png')}} class="social-logo" />
    </a>
    <a href="https://gmail.com" target="_blank">
      <img src={{asset('icons/gmail-footer.png')}} class="social-logo" />
    </a>
    <a href="https://instagram.com" target="_blank">
      <img src={{asset('icons/instagram-footer.png')}} class="social-logo" />
    </a>
  </div>
</div>
<style>
  .footer {
    height: 200px;
    background: #FFF;
    padding: 20px 10px;
    margin-top: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .follow-us-text {
    color: #d4af37;
    font-size: 30px;
    font-weight: 500;
    margin-top: 20px;
  }
  .line {
    width: 400px;
    height: 2px;
    margin: 20px 0;
    background: #d4af37;
  }
  .logos-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }
  .social-logo {
    widht: 50px;
    height: 50px;
    margin-right: 15px;
  }
</style>