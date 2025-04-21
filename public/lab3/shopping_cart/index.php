<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => ['id' => 1, 'name' => 'Laptop', 'price' => 1200],
    2 => ['id' => 2, 'name' => 'Smartphone', 'price' => 800],
    3 => ['id' => 3, 'name' => 'Headphones', 'price' => 200],
    4 => ['id' => 4, 'name' => 'Tablet', 'price' => 500],
    5 => ['id' => 5, 'name' => 'Smartwatch', 'price' => 300],
];

if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];

    if (isset($products[$product_id])) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product_id,
                'name' => $products[$product_id]['name'],
                'price' => $products[$product_id]['price'],
                'quantity' => 1
            ];
        }

        $previous_purchases = [];
        if (isset($_COOKIE['previous_purchases'])) {
            $previous_purchases = json_decode($_COOKIE['previous_purchases'], true);
        }

        if (!in_array($product_id, $previous_purchases)) {
            $previous_purchases[] = $product_id;
        }

        setcookie('previous_purchases', json_encode($previous_purchases), time() + (30 * 24 * 60 * 60));
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['remove_from_cart']) && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$previous_purchases = [];
if (isset($_COOKIE['previous_purchases'])) {
    $previous_purchases = json_decode($_COOKIE['previous_purchases'], true);
}

$cart_total = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <h2>Available Products</h2>
            <?php foreach ($products as $product): ?>
                <div>
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="flex: 1;">
            <h2>Your Shopping Cart</h2>
            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div>
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                        <p>Quantity: <?php echo $item['quantity']; ?></p>
                        <p>Subtotal: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="remove_from_cart">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <div>
                    <strong>Total:</strong> $<?php echo number_format($cart_total, 2); ?>
                </div>

                <form method="post">
                    <button type="submit" name="clear_cart">Clear Cart</button>
                </form>
            <?php endif; ?>
        </div>

        <div style="flex: 1;">
            <h2>Your Previous Purchases</h2>
            <?php if (empty($previous_purchases)): ?>
                <p>No previous purchases found.</p>
            <?php else: ?>
                <?php foreach ($previous_purchases as $product_id): ?>
                    <?php if (isset($products[$product_id])): ?>
                        <div>
                            <h3><?php echo htmlspecialchars($products[$product_id]['name']); ?></h3>
                            <p>Price: $<?php echo number_format($products[$product_id]['price'], 2); ?></p>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" name="add_to_cart">Add to Cart Again</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
