<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Quản Lý Website Bán Hàng</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Quản lý Sản phẩm</a></li>
                <li><a href="#">Quản lý Đơn hàng</a></li>
                <li><a href="#">Quản lý Khách hàng</a></li>
                <li><a href="#">Báo cáo</a></li>
                <li><a href="#">Cài đặt</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <div class="header-left">
                    <h1>Trang Quản Trị</h1>
                </div>
                <div class="header-right">
                    <span>Chào, Admin</span>
                </div>
            </header>

            <div class="dashboard">
                <!-- Doanh thu -->
                <div class="box">
                    <h3>Tổng Doanh Thu</h3>
                    <p class="revenue">$12,345.67</p>
                </div>

                <!-- Đơn hàng mới -->
                <div class="box">
                    <h3>Đơn Hàng Mới</h3>
                    <p class="orders">45</p>
                </div>

                <!-- Sản phẩm hết hàng -->
                <div class="box">
                    <h3>Sản phẩm Hết Hàng</h3>
                    <p class="out-of-stock">12</p>
                </div>

                <!-- Khách hàng mới -->
                <div class="box">
                    <h3>Khách Hàng Mới</h3>
                    <p class="new-customers">10</p>
                </div>
            </div>

            <div class="section">
                <div class="product-management">
                    <h2>Quản Lý Sản Phẩm</h2>
                    <button class="btn">Thêm Sản Phẩm</button>
                    <button class="btn">Danh Sách Sản Phẩm</button>
                </div>

                <div class="order-management">
                    <h2>Quản Lý Đơn Hàng</h2>
                    <button class="btn">Danh Sách Đơn Hàng</button>
                    <button class="btn">Đơn Hàng Đang Xử Lý</button>
                </div>

                <div class="customer-management">
                    <h2>Quản Lý Khách Hàng</h2>
                    <button class="btn">Danh Sách Khách Hàng</button>
                    <button class="btn">Khách Hàng Mới</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>