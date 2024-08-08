<style>
    .products {
        display: flex;
        flex-wrap: wrap;
    }

    .product {
        border: 1px solid #ddd;
        border-radius: 10px;
        margin: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        background-color: #f9f9f9;
    }

    .product:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .product h2 {
        font-size: 1.8em;
        margin-bottom: 15px;
        color: #333;
    }

    .product p {
        margin-bottom: 15px;
        color: #666;
    }

    .product form .form-group {
        margin-bottom: 15px;
    }

    .product form input[type="number"] {
        padding: 10px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
    }

    .product form button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .product form button:hover {
        background-color: #218838;
    }
</style>