<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Đơn Hàng</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table, th, td {
            border: 1px solid black;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Thông Tin Đơn Hàng</h1>

    <?php
    // Kết nối với cơ sở dữ liệu
    require_once "../connect.php";

    // Truy vấn cơ sở dữ liệu để lấy thông tin đơn hàng
    $sql = "SELECT Orders.OrderID, Orders.UserID, Orders.OrderDate, Orders.TotalAmount, Products.Name, OrderDetails.Quantity, OrderDetails.Price
            FROM Orders
            INNER JOIN OrderDetails ON Orders.OrderID = OrderDetails.OrderID
            INNER JOIN Products ON OrderDetails.ProductID = Products.ProductID
            ORDER BY Orders.OrderID";

    $statement = $conn->prepare($sql);
    $statement->execute();
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($orders) > 0) {
        echo '<table>
                <tr>
                    <th>OrderID</th>
                    <th>User ID</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>';

        foreach ($orders as $order) {
            echo '<tr>
                    <td>' . $order['OrderID'] . '</td>
                    <td>' . $order['UserID'] . '</td>
                    <td>' . $order['OrderDate'] . '</td>
                    <td>' . number_format($order['TotalAmount'], 0, ',', '.') . '₫</td>
                    <td>' . $order['Name'] . '</td>
                    <td>' . $order['Quantity'] . '</td>
                    <td>' . number_format($order['Price'], 0, ',', '.') . '₫</td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo '<p>Không có thông tin đơn hàng.</p>';
    }
    ?>
</body>

</html>