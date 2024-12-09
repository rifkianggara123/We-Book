<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review Website</title>
<style>
/* General Styling */
body {
  font-family: 'Roboto', sans-serif;
  background-color: #f3f4f6;
  margin: 0;
  padding: 20px;
}

.review-container {
  max-width: 800px;
  margin: auto;
  background: #ffffff;
  padding: 20px 30px;
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1, h2 {
  font-family: 'Poppins', sans-serif;
  color: #333;
  margin-bottom: 20px;
}

h1 {
  text-align: center;
  font-size: 2rem;
}

h2 {
  font-size: 1.5rem;
  border-bottom: 2px solid #4caf50;
  display: inline-block;
  margin-bottom: 15px;
}

/* Rating Summary */
.rating-summary {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 30px;
}

.total-rating {
  text-align: center;
}

.total-rating h2 {
  font-size: 3rem;
  color: #4caf50;
  margin: 0;
}

.total-rating p {
  color: #777;
}

.rating-distribution {
  flex-grow: 1;
  margin-left: 20px;
}

.rating-bar {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.rating-bar span {
  margin-right: 10px;
  color: #444;
}

.bar {
  flex-grow: 1;
  height: 10px;
  background: #e0e0e0;
  border-radius: 5px;
  overflow: hidden;
  margin-right: 10px;
}

.filled {
  height: 100%;
  background: #4caf50;
  transition: width 0.3s ease;
}

/* Reviews Section */
.reviews {
  border-top: 2px dashed #e0e0e0;
  padding-top: 20px;
}

.review {
  margin-bottom: 20px;
  padding: 15px;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.review h3 {
  margin: 0;
  font-size: 1.2rem;
  color: #4caf50;
}

.review p {
  margin: 5px 0;
  color: #555;
}

.review span {
  color: #fbc02d;
  font-size: 1.1rem;
}

/* Form Styling */
.review-form {
  margin-top: 30px;
  padding-top: 30px;
  border-top: 2px dashed #e0e0e0;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
  color: #333;
}

input, select, textarea {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #f9f9f9;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

input:focus, select:focus, textarea:focus {
  border-color: #4caf50;
  outline: none;
  background: #fff;
}

button {
  background-color: #4caf50;
  color: #fff;
  padding: 12px 20px;
  font-size: 16px;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

button:hover {
  background-color: #45a049;
  transform: scale(1.05);
}

button:active {
  background-color: #388e3c;
  transform: scale(1);
}

.form-group textarea {
  resize: vertical;
}

/* Responsive Design */
@media (max-width: 768px) {
  .rating-summary {
    flex-direction: column;
    align-items: center;
  }

  .rating-distribution {
    margin-left: 0;
    margin-top: 20px;
  }

  h1 {
    font-size: 1.8rem;
  }
}
.btn-back {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-back:hover {
        color: #000;
        text-decoration: underline;
    }

</style>
</head>
<body>
  <div class="review-container">
    <h1>Review Website</h1>

    <!-- Rating Summary -->
    <div class="rating-summary">
      <div class="total-rating">
        <h2>4.5</h2>
        <p>Rata-rata dari 10.000 ulasan</p>
      </div>
      <div class="rating-distribution">
        <div class="rating-bar">
          <span>⭐⭐⭐⭐⭐</span>
          <div class="bar">
            <div class="filled" style="width: 70%;"></div>
          </div>
          <span>7,381</span>
        </div>
        <div class="rating-bar">
          <span>⭐⭐⭐⭐</span>
          <div class="bar">
            <div class="filled" style="width: 50%;"></div>
          </div>
          <span>4,605</span>
        </div>
        <div class="rating-bar">
          <span>⭐⭐⭐</span>
          <div class="bar">
            <div class="filled" style="width: 30%;"></div>
          </div>
          <span>773</span>
        </div>
        <div class="rating-bar">
          <span>⭐⭐</span>
          <div class="bar">
            <div class="filled" style="width: 10%;"></div>
          </div>
          <span>1,868</span>
        </div>
      </div>
    </div>

    <!-- User Reviews -->
    <div class="reviews">
      <h2>Ulasan Pengguna</h2>
      <div id="review-list">
        <div class="review">
          <h3>Chamomille</h3>
          <p><span>⭐⭐⭐⭐⭐</span> - 09/11/18</p>
          <p>harga bukunya murcee, bagus bgt, recomendtttttt</p>
        </div>
      </div>
    </div>

    <!-- Review Form -->
    <div class="review-form">
      <h2>Tulis Ulasan Anda</h2>
      <form id="review-form">
        <div class="form-group">
          <label for="name">Nama:</label>
          <input type="text" id="name" required>
        </div>
        <div class="form-group">
          <label for="rating">Rating (1-5):</label>
          <select id="rating" required>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
          </select>
        </div>
        <div class="form-group">
          <label for="review">Ulasan:</label>
          <textarea id="review" rows="4" required></textarea>
        </div>
        <button type="submit">Kirim Ulasan</button>
      </form>
       <!-- Tombol Kembali -->
        <a href="indexlogin.html" class="btn-back">Kembali ke Menu Utama</a> <!-- Ganti "index.php" sesuai dengan halaman menu utama Anda -->
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
