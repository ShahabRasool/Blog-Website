<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Product Card</title>
    <style>
        .card {
            width: 300px;
            height: 400px;
            perspective: 1000px;
            margin: 50px auto;
        }
        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }
        .card:hover .card-inner {
            transform: rotateY(180deg);
        }
        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-back {
            transform: rotateY(180deg);
        }
        .product-image {
            width: 80%;
            height: auto;
            margin-bottom: 20px;
        }
        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 20px;
            color: #888;
        }
        .buy-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-inner">
            <div class="card-front">
                <img src="./12.png" alt="Product Image" class="product-image">
                <h2 class="product-title">Product Name</h2>
                <p class="product-price">$99.99</p>
            </div>
            <div class="card-back">
                <h2 class="product-title">Product Details</h2>
                <p>Here you can add more details about the product.</p>
                <button class="buy-button">Buy Now</button>
            </div>
        </div>
    </div>
</body>
</html>

