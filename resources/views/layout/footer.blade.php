<footer>
  <div class="container">
    <p>&copy; {{ date('Y') }} GoCinema. All rights reserved.</p>
    <ul class="social-links">
      <li><a href="#">Facebook</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Instagram</a></li>
    </ul>
  </div>
</footer>

<style>
  footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
  }

  .social-links {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
  }

  .social-links a {
    color: #fff;
    text-decoration: none;
    font-size: 1em;
  }

  .social-links a:hover {
    text-decoration: underline;
  }
</style>
