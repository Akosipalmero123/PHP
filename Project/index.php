<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-calculator"></i> Calculator Dashboard</h1>
            <div class="user-info">
                <p><strong>Allen Dave M. Palmero</strong></p>
                <p>BS Information Technology - 2nd Year</p>
            </div>
        </header>

        <div class="dashboard-intro">
            <p>Welcome to the calculator dashboard. Select any tool below to perform calculations.</p>
        </div>

        <div class="dashboard-cards">
            <!-- Age Calculator Card -->
            <div class="card">
                <div class="card-icon" style="background-color: #4CAF50;">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <h3>Age Calculator</h3>
                <p>Calculate your exact age based on your birth date. Get your age in years, months, and days.</p>
                <a href="age_calculator.php" class="btn">Open Calculator</a>
            </div>

            <!-- Grade Calculator Card -->
            <div class="card">
                <div class="card-icon" style="background-color: #2196F3;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Grade Calculator</h3>
                <p>Calculate your final grade based on multiple subjects with different weights and percentages.</p>
                <a href="grade_calculator.php" class="btn">Open Calculator</a>
            </div>

            <!-- BMI Calculator Card -->
            <div class="card">
                <div class="card-icon" style="background-color: #FF9800;">
                    <i class="fas fa-weight-scale"></i>
                </div>
                <h3>BMI Calculator</h3>
                <p>Calculate your Body Mass Index and determine your health category based on BMI standards.</p>
                <a href="bmi_calculator.php" class="btn">Open Calculator</a>
            </div>
        </div>

        <footer>
            <p>Project by Allen Dave M. Palmero | BSIT 2nd Year</p>
            <p>GitHub Repository: <a href="https://github.com/yourusername/calculator-dashboard" target="_blank">github.com/yourusername/calculator-dashboard</a></p>
        </footer>
    </div>
</body>
</html>