<?php require_once 'includes/header.php'; ?>

<?php 
$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
$revenueQuery = $connect->query($orderSql);
while ($row = $revenueQuery->fetch_assoc()) {
    $totalRevenue += $row['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$connect->close();
?>

<style>
    body {
        background: #f8fafc;
        font-family: 'Segoe UI', sans-serif;
        background-image: url('assests/images/blue-aesthetic-3840x2400-12656.jpg');
        background-size: cover;
        background-position: center;

    }

    .dash-card {
        background: white;
        border-radius: 1px solid #e2e8f0;
        border-radius: 26px;
        padding: 32px 28px;
        height: 180px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dash-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .number {
        font-size: 4.8rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 12px;
        letter-spacing: -2px;
    }

    .label {
        font-size: 1.35rem;
        font-weight: 500;
        color: #64748b;
        text-align: center;
    }

    /* Individual Card Colors - Soft & Readable */
    .card-products   { background: #dbeafe; color: #1e40af; }   /* Soft Blue */
    .card-orders     { background: #fed7aa; color: #9a3412; }   /* Soft Orange */
    .card-lowstock   { background: #fbcfe8; color: #be123c; }   /* Soft Pink */
    .card-date       { background: #6366f1; color: white; }      /* Indigo */
    .card-revenue    { background: #10b981; color: white; }     /* Emerald Green */

    .date-text {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .date-day {
        font-size: 5.5rem;
        font-weight: 900;
        letter-spacing: -3px;
    }

    h1 {
        font-weight: 800;
        color: #ffffffff;
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    .calendar-wrapper {
        background: white;
        border-radius: 26px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }
</style>

<div class="container-fluid px-4 py-5">

    <h1>Dashboard</h1>

    <!-- Top 4 Cards -->
    <div class="row g-5 mb-5">

        <div class="col-lg-3 col-md-6">
            <a href="product.php" class="text-decoration-none">
                <div class="dash-card card-products text-center">
                    <div class="number"><?php echo $countProduct; ?></div>
                    <div class="label">Total Products</div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="orders.php?o=manord" class="text-decoration-none">
                <div class="dash-card card-orders text-center">
                    <div class="number"><?php echo $countOrder; ?></div>
                    <div class="label">Total Orders</div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="product.php" class="text-decoration-none">
                <div class="dash-card card-lowstock text-center">
                    <div class="number"><?php echo $countLowStock; ?></div>
                    <div class="label">Low Stock Items</div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dash-card card-date text-center">
                <div class="date-day"><?php echo date('d'); ?></div>
                <div class="date-text">
                    <?php echo date('l'); ?><br>
                    <?php echo date('F Y'); ?>
                </div>
            </div>
        </div>

    </div>
	<br>

    <!-- Bottom Row: Revenue + Calendar -->
    <div class="row g-5">

        <div class="col-lg-5 col-md-12">
            <div class="dash-card card-revenue text-center" style="height: 220px;">
                <div style="font-size: 5.5rem; font-weight: 900; line-height: 1;">
                    <?php echo number_format($totalRevenue); ?>
                </div>
                <div class="label" style="font-size: 1.7rem; margin-top: 10px; color: white;">
                   <h3> Total Revenue</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12">
            <div class="calendar-wrapper">
                <h4 class="mb-4 fw-bold text-dark">
                    Calendar
                </h4>
                <div id="calendar"></div>
            </div>
        </div>

    </div>

</div>

<!-- FullCalendar -->
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>

<script>
$(function () {
    $('#navDashboard').addClass('active');

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        height: 200,
        buttonText: { today: 'Today', month: 'Month', week: 'Week', day: 'Day' }
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>