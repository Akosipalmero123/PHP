<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        
        <div class="calculator-container">
            <h1><i class="fas fa-weight-scale"></i> BMI Calculator</h1>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="height">Height:</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="number" id="height_cm" name="height_cm" 
                               placeholder="Centimeters" min="50" max="250" step="0.1">
                        <span style="align-self: center;">OR</span>
                        <input type="number" id="height_ft" name="height_ft" 
                               placeholder="Feet" min="1" max="8" step="1">
                        <input type="number" id="height_in" name="height_in" 
                               placeholder="Inches" min="0" max="11" step="0.1">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="weight">Weight:</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="number" id="weight_kg" name="weight_kg" 
                               placeholder="Kilograms" min="20" max="300" step="0.1">
                        <span style="align-self: center;">OR</span>
                        <input type="number" id="weight_lbs" name="weight_lbs" 
                               placeholder="Pounds" min="44" max="661" step="0.1">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="unit_system">Preferred Unit System:</label>
                    <select id="unit_system" name="unit_system">
                        <option value="metric">Metric (cm/kg)</option>
                        <option value="imperial">Imperial (ft/in/lbs)</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Calculate BMI</button>
            </form>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $unitSystem = $_POST['unit_system'];
                $bmi = 0;
                
                if ($unitSystem == 'metric') {
                    $height_cm = $_POST['height_cm'];
                    $weight_kg = $_POST['weight_kg'];
                    
                    if ($height_cm > 0 && $weight_kg > 0) {
                        $height_m = $height_cm / 100;
                        $bmi = $weight_kg / ($height_m * $height_m);
                    }
                } else {
                    $height_ft = $_POST['height_ft'];
                    $height_in = $_POST['height_in'];
                    $weight_lbs = $_POST['weight_lbs'];
                    
                    if ($height_ft > 0 && $weight_lbs > 0) {
                        $height_in_total = ($height_ft * 12) + $height_in;
                        $bmi = ($weight_lbs / ($height_in_total * $height_in_total)) * 703;
                    }
                }
                
                if ($bmi > 0) {
                    $bmi = round($bmi, 1);
                    
                    // Determine BMI category
                    if ($bmi < 18.5) {
                        $category = "Underweight";
                        $categoryClass = "underweight";
                        $advice = "Consider gaining weight through a balanced diet and strength training.";
                    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                        $category = "Normal Weight";
                        $categoryClass = "normal";
                        $advice = "Great! Maintain your current weight with regular exercise and healthy eating.";
                    } elseif ($bmi >= 25 && $bmi <= 29.9) {
                        $category = "Overweight";
                        $categoryClass = "overweight";
                        $advice = "Consider losing weight through diet and exercise. Consult with a healthcare provider.";
                    } else {
                        $category = "Obese";
                        $categoryClass = "obese";
                        $advice = "It's recommended to consult with a healthcare provider for a weight management plan.";
                    }
                    
                    echo '<div class="result">';
                    echo '<h3>BMI Calculation Result</h3>';
                    
                    if ($unitSystem == 'metric') {
                        echo "<p><strong>Height:</strong> $height_cm cm</p>";
                        echo "<p><strong>Weight:</strong> $weight_kg kg</p>";
                    } else {
                        echo "<p><strong>Height:</strong> $height_ft ft $height_in in</p>";
                        echo "<p><strong>Weight:</strong> $weight_lbs lbs</p>";
                    }
                    
                    echo "<p><strong>Your BMI:</strong> $bmi</p>";
                    echo "<p class='bmi-category $categoryClass'><strong>Category:</strong> $category</p>";
                    echo "<p><strong>Health Advice:</strong> $advice</p>";
                    
                    // BMI Scale Information
                    echo '<div style="margin-top: 20px; padding: 15px; background: #f0f8ff; border-radius: 8px;">';
                    echo '<h4>BMI Categories:</h4>';
                    echo '<p>Underweight: &lt; 18.5</p>';
                    echo '<p>Normal weight: 18.5 – 24.9</p>';
                    echo '<p>Overweight: 25 – 29.9</p>';
                    echo '<p>Obese: ≥ 30</p>';
                    echo '</div>';
                    
                    echo '</div>';
                } else {
                    echo '<div class="result" style="border-left-color: #f44336;">';
                    echo '<p style="color: #f44336;">Please enter valid height and weight values.</p>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>