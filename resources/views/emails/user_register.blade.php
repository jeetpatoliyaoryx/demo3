<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YourStore.in | Welcome</title>
<style>
  body {
    margin: 0;
    padding: 0;
    background-color: #0d0d0d;
    font-family: 'Segoe UI', Arial, sans-serif;
    color: #e5e5e5;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  .container {
    max-width: 620px;
    margin: 0 auto;
    background-color: #1a1a1a;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(212,175,55,0.15);
  }
  .header {
    background-color: #000;
    color: #d4af37;
    text-align: center;
    padding: 25px 15px;
  }
  .header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 1px;
  }
  .content {
    padding: 25px 20px;
  }
  .content h2 {
    color: #d4af37;
    font-size: 20px;
    margin-bottom: 10px;
  }
  .summary {
    background-color: #141414;
    border: 1px solid #2a2a2a;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
  }
  .summary p {
    margin: 7px 0;
    font-size: 14px;
    color: #ccc;
  }

  .btn {
    display: inline-block;
    background: linear-gradient(90deg, #d4af37, #f1c24a);
    color: #000;
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 30px;
    font-weight: bold;
    font-size: 14px;
    margin-top: 25px;
    transition: 0.3s;
  }

  .footer {
    background-color: #000;
    text-align: center;
    color: #aaa;
    padding: 25px 15px;
    font-size: 13px;
    border-top: 1px solid #2a2a2a;
  }
  .footer a {
    color: #d4af37;
    text-decoration: none;
    margin: 0 6px;
  }

  @media screen and (max-width: 600px) {
    .container {
      width: 100% !important;
      border-radius: 0;
    }
    .content {
      padding: 20px 15px !important;
    }
    .btn {
      width: 100%;
      text-align: center;
      padding: 12px 0;
    }
  }
</style>

</head>
<body>
  <table class="container" cellpadding="0" cellspacing="0">
    <tr>
      <td class="header">
        <h1>YourStore.in</h1>
      </td>
    </tr>

    <tr>
      <td class="content">
        <h2>Welcome to YourStore.in 🎉</h2>
        <p>Hi <strong>{{name}}</strong>,</p>
        <p>Thank you for registering at <strong>YourStore.in</strong>. Your account has been created successfully.</p>

        <div class="summary">
          <p><strong>Registered Email:</strong> {{email}}</p>
          <p><strong>Password:</strong> {{password}}</p>
          <p><strong>Registration Date:</strong> {{date}}</p>
        </div>

        <center>
          <a href="{{login_url}}" class="btn">Login to Your Account</a>
        </center>

        <p style="margin-top:30px; text-align:center; font-size:13px; color:#d4af37;">
          You can now explore products, track orders, and enjoy exclusive offers.
        </p>
      </td>
    </tr>

    <tr>
      <td class="footer">
        <p>Need help? Contact us:</p>
        <p>
          📧 <a href="mailto:support@yourstore.in">support@yourstore.in</a><br>
          💬 <a href="https://wa.me/919999999999">WhatsApp</a> |
          📸 <a href="https://instagram.com/yourstore">Instagram</a> |
          👍 <a href="https://facebook.com/yourstore">Facebook</a>
        </p>
        <p>© 2025 YourStore.in — All Rights Reserved</p>
      </td>
    </tr>

  </table>
</body>
</html>
