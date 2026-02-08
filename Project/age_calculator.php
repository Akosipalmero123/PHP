<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        
        <div class="calculator-container">
            <h1><i class="fas fa-birthday-cake"></i> Age Calculator</h1>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="birthdate">Enter Your Birth Date:</label>
                    <input type="date" id="birthdate" name="birthdate" required 
                           max="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <button type="submit" class="submit-btn">Calculate Age</button>
            </form>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $birthdate = $_POST['birthdate'];
                
                if (!empty($birthdate)) {
                    $birthDateTime = new DateTime($birthdate);
                    $currentDateTime = new DateTime();
                    
                    $ageInterval = $currentDateTime->diff($birthDateTime);
                    
                    $years = $ageInterval->y;
                    $months = $ageInterval->m;
                    $days = $ageInterval->d;
                    
                    echo '<div class="result">';
                    echo '<h3>Age Calculation Result</h3>';
                    echo "<p><strong>Birth Date:</strong> " . date('F j, Y', strtotime($birthdate)) . "</p>";
                    echo "<p><strong>Current Date:</strong> " . date('F j, Y') . "</p>";
                    echo "<p><strong>Your Age:</strong> $years years, $months months, and $days days</p>";
                    echo "<p><strong>Total Months:</strong> " . (($years * 12) + $months) . " months</p>";
                    echo "<p><strong>Total Days:</strong> " . $ageInterval->days . " days</p>";
                    
                    // Determine if birthday has passed this year
                    $birthdayThisYear = new DateTime(date('Y') . '-' . $birthDateTime->format('m-d'));
                    if ($birthdayThisYear > $currentDateTime) {
                        $nextBirthday = $birthdayThisYear;
                    } else {
                        $nextBirthday = new DateTime((date('Y') + 1) . '-' . $birthDateTime->format('m-d'));
                    }
                    $daysToBirthday = $currentDateTime->diff($nextBirthday)->days;
                    echo "<p><strong>Days until next birthday:</strong> $daysToBirthday days</p>";
                    
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>