<?php
// Database configuration class
class Database {
    private $servername = "localhost";
    private $username = "root"; // Replace with your database username
    private $password = ""; // Replace with your database password
    private $dbname = "demo_web";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close() {
        $this->conn->close();
    }
}

// Product operations class (CRUD)
class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addProduct($nama_produk, $jumlah, $harga) {
        $sql = "INSERT INTO Produk (nama_produk, jumlah, harga) VALUES ('$nama_produk', $jumlah, $harga)";
        return $this->conn->query($sql);
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM Produk";
        return $this->conn->query($sql);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM Produk WHERE id_barang = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    public function updateProduct($id, $nama_produk, $jumlah, $harga) {
        $sql = "UPDATE Produk SET nama_produk='$nama_produk', jumlah=$jumlah, harga=$harga, Updated_at=NOW() WHERE id_barang=$id";
        return $this->conn->query($sql);
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM Produk WHERE id_barang=$id";
        return $this->conn->query($sql);
    }
}

// HTML form display class
class ProductForm {
    public function displayProductForm($action, $product = null) {
        if ($action === 'edit' && $product) {
            $nama_produk = $product['nama_produk'];
            $jumlah = $product['jumlah'];
            $harga = $product['harga'];
            $id = $product['id_barang'];
        } else {
            $nama_produk = $jumlah = $harga = $id = '';
        }

        // Display the form for adding or editing a product
        echo "
        <h2>" . ($action === 'edit' ? "Edit Product" : "Tambah produk baru") . "</h2>
        <form method='POST' action=''>
            <input type='hidden' name='id_barang' value='$id'>
            <label for='nama_produk'>Nama Produk:</label>
            <input type='text' name='nama_produk' value='$nama_produk' required><br><br>
            <label for='jumlah'>Jumlah:</label>
            <input type='number' name='jumlah' value='$jumlah' required><br><br>
            <label for='harga'>Harga:</label>
            <input type='number' name='harga' value='$harga' required><br><br>
            <input type='submit' name='" . ($action === 'edit' ? 'update_product' : 'add_product') . "' value='" . ($action === 'edit' ? 'Update Product' : 'Tambahkan Produk') . "'>
        </form>";
    }
}

// Product list display class
class ProductList {
    public function displayProducts($products) {
        echo "<h2>List Produk</h2>";
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>";
        
        if ($products->num_rows > 0) {
            while ($row = $products->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['id_barang'] . "</td>
                    <td>" . $row['nama_produk'] . "</td>
                    <td>" . $row['jumlah'] . "</td>
                    <td>" . $row['harga'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    <td>" . $row['Updated_at'] . "</td>
                    <td>
                        <a href='?action=edit&id=" . $row['id_barang'] . "' title='Edit'>
                            <i class='fa fa-pencil-alt'></i>
                        </a> |
                        <a href='?action=delete&id=" . $row['id_barang'] . "' title='Delete'>
                            <i class='fa fa-trash-alt'></i>
                        </a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        echo "</table>";
    }
}

// Main logic for handling requests
class ProductController {
    private $db;
    private $product;
    private $productForm;
    private $productList;

    public function __construct($db) {
        $this->db = $db;
        $this->product = new Product($db->conn);
        $this->productForm = new ProductForm();
        $this->productList = new ProductList();
    }

    public function handleRequest() {
        // Handle POST requests for adding and updating products
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
            $nama_produk = $_POST['nama_produk'];
            $jumlah = $_POST['jumlah'];
            $harga = $_POST['harga'];
            $this->product->addProduct($nama_produk, $jumlah, $harga);
            echo "New product added successfully.";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
            $id = $_POST['id_barang'];
            $nama_produk = $_POST['nama_produk'];
            $jumlah = $_POST['jumlah'];
            $harga = $_POST['harga'];
            $this->product->updateProduct($id, $nama_produk, $jumlah, $harga);
            echo "Product updated successfully.";
        }

        // Handle GET requests for editing and deleting products
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->product->deleteProduct($id);
            echo "Product deleted successfully.";
        }

        // Display product list
        $products = $this->product->getAllProducts();
        $this->productList->displayProducts($products);

        // Display the form for adding or editing a product
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $productData = $this->product->getProductById($_GET['id']);
            $this->productForm->displayProductForm('edit', $productData);
        } else {
            $this->productForm->displayProductForm('add');
        }
    }
}

// Initialize and handle the request
$db = new Database();
$controller = new ProductController($db);
$controller->handleRequest();

// Close the database connection
$db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="produk.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <script src="https://unpkg.com/feather-icons"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <title>Toko Kaos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- The content will be displayed by the PHP code above -->
</body>
</html>
