<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YourStore.in | Order Invoice</title>
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
    font-size: 18px;
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
    margin: 5px 0;
    font-size: 14px;
    color: #ccc;
  }
  .order-table {
    width: 100%;
    border: 1px solid #2a2a2a;
    border-radius: 6px;
    overflow: hidden;
    margin-bottom: 25px;
  }
  .order-table th {
    background-color: #000;
    color: #d4af37;
    padding: 10px;
    font-size: 13px;
    text-align: left;
  }

  /* --- Updated order-item section --- */
  .order-item {
    background-color: #141414;
  }
  .order-item td {
    padding: 10px;
    border-top: 1px solid #2a2a2a;
    vertical-align: middle;
    font-size: 13px;
  }
  .order-item img {
    border-radius: 6px;
    width: 60px;
    height: 60px;
    object-fit: cover;
    display: block;
  }

  .total {
    font-weight: bold;
    background-color: #0d0d0d;
    color: #d4af37;
    padding: 10px;
    width: 100%;
  }
  .total td {
    padding: 10px;
  }

  .section {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    gap: 10px;
  }
  .section h3 {
    color: #d4af37;
    font-size: 15px;
    margin-bottom: 6px;
  }
  .section p {
    font-size: 13px;
    color: #ccc;
    margin: 3px 0;
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

  /* 🔹 Mobile Optimization */
  @media screen and (max-width: 600px) {
    .container {
      width: 100% !important;
      border-radius: 0;
    }
    .content {
      padding: 20px 15px !important;
    }
    .order-table {
      border: none;
    }
    .order-table thead {
      display: none;
    }

    /* ✅ Full-width card-style order items */
    .order-table tbody,
    .order-item,
    .order-item td {
      display: block !important;
      width: 100% !important;
      box-sizing: border-box;
    }
    .order-item {
      background-color: #141414;
      border-radius: 8px;
      margin-bottom: 10px;
      padding: 15px !important;
    }
    .order-item td {
      border: none;
      padding: 6px 0 !important;
    }
    .order-item td::before {
      content: attr(data-label);
      font-weight: bold;
      color: #d4af37;
      display: block;
      font-size: 13px;
      margin-bottom: 3px;
    }
    .order-item img {
      width: 100%;
      max-width: 100px;
      height: auto;
      margin-bottom: 10px;
    }
    .btn {
      width: 100%;
      text-align: center;
      padding: 12px 0;
    }
    .section p, .summary p {
      font-size: 13px;
    }
    .total{
        width: 100%; 
        display: block;
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
        <h2>Order Confirmed ✨</h2>
        <p>Hi <strong>John Doe</strong>, your order <strong>#YS123456</strong> has been confirmed successfully.</p>

        <div class="summary">
          <p><strong>Order Date:</strong> Oct 31, 2025</p>
          <p><strong>Payment:</strong> Razorpay (Paid)</p>
          <p><strong>Delivery:</strong> Expected by Nov 5, 2025</p>
        </div>

        <table class="order-table">
          <thead>
            <tr>
              <th>Item</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr class="order-item">
              <td data-label="Item">
                <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600" alt="T-Shirt"><br>
                Classic White T-ShirtClassic White T-ShirtClassic White T-ShirtClassic White T-ShirtClassic White T-ShirtClassic White T-Shirt
              </td>
              <td data-label="Qty">1</td>
              <td data-label="Price">₹499</td>
            </tr>
            <tr class="order-item">
              <td data-label="Item">
                <img src="https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?w=600" alt="Blue Jeans"><br>
                Blue Denim Jeans
              </td>
              <td data-label="Qty">1</td>
              <td data-label="Price">₹1,199</td>
            </tr>
            <tr class="total">
              <td colspan="2" align="right">Total:-</td>
              <td align="right">₹1,698</td>
            </tr>
          </tbody>
        </table>

        <h2>Customer Information</h2>
        <div class="section">
            <div class="billing-address">
                <h3>Billing Address</h3>
                <p>John Doe</p>
                <p>Sunrise Complex, 45 MG Road, </p>
                <p>Mumbai, MH 400001</p>
                <p>India</p>
            </div>
            <div class="shipping-address">
                <h3>Shipping Address</h3>
                <p>John Doe</p>
                <p>Sunrise Complex, 45 MG Road</p>
                <p>Mumbai, MH 400001</p>
                <p>India</p>
            </div>
        </div>

        <center>
          <a href="#" class="btn">Track Order</a>
        </center>

        <p style="margin-top:30px; text-align:center; font-size:13px; color:#d4af37;">
          Thank you for choosing YourStore.in 💛<br>
          We appreciate your trust in us.
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
