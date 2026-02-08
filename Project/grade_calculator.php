<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        
        <div class="calculator-container">
            <h1><i class="fas fa-graduation-cap"></i> Course Grade Calculator</h1>
            
            <form method="POST" action="">
                <h3>Enter grades for 5 subjects (0-100 scale):</h3>
                
                <?php
                $subjects = ['Mathematics', 'Science', 'English', 'Programming', 'History'];
                
                foreach ($subjects as $index => $subject) {
                    echo '<div class="form-group">';
                    echo '<label for="subject' . ($index + 1) . '">' . $subject . ' Grade:</label>';
                    echo '<input type="number" id="subject' . ($index + 1) . '" 
                           name="grades[]" min="0" max="100" step="0.01" required 
                           placeholder="Enter grade (0-100)">';
                    echo '</div>';
                }
                ?>
                
                <div class="form-group">
                    <label for="grading_system">Grading System:</label>
                    <select id="grading_system" name="grading_system">
                        <option value="percentage">Percentage System</option>
                        <option value="gpa">GPA System (4.0 scale)</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Calculate Final Grade</button>
            </form>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $grades = $_POST['grades'];
                $gradingSystem = $_POST['grading_system'];
                
                if (!empty($grades) && count($grades) == 5) {
                    $total = 0;
                    $validGrades = true;
                    
                    foreach ($grades as $grade) {
                        if ($grade < 0 || $grade > 100) {
                            $validGrades = false;
                            break;
                        }
                        $total += $grade;
                    }
                    
                    if ($validGrades) {
                        $average = $total / 5;
                        
                        echo '<div class="result">';
                        echo '<h3>Grade Calculation Result</h3>';
                        
                        echo '<table class="grade-table">';
                        echo '<tr><th>Subject</th><th>Grade</th><th>Remarks</th></tr>';
                        
                        foreach ($subjects as $index => $subject) {
                            $grade = $grades[$index];
                            $remarks = ($grade >= 75) ? 'Passed' : 'Failed';
                            $color = ($grade >= 75) ? 'green' : 'red';
                            
                            echo "<tr>";
                            echo "<td>$subject</td>";
                            echo "<td>$grade</td>";
                            echo "<td style='color: $color; font-weight: bold;'>$remarks</td>";
                            echo "</tr>";
                        }
                        
                        echo '</table>';
                        
                        echo "<p><strong>Average Grade:</strong> " . number_format($average, 2) . "</p>";
                        
                        if ($gradingSystem == 'gpa') {
                            // Convert to GPA (4.0 scale)
                            if ($average >= 97) $gpa = 4.0;
                            elseif ($average >= 93) $gpa = 3.7;
                            elseif ($average >= 89) $gpa = 3.3;
                            elseif ($average >= 85) $gpa = 3.0;
                            elseif ($average >= 81) $gpa = 2.7;
                            elseif ($average >= 77) $gpa = 2.3;
                            elseif ($average >= 74) $gpa = 2.0;
                            elseif ($average >= 70) $gpa = 1.7;
                            elseif ($average >= 67) $gpa = 1.3;
                            elseif ($average >= 64) $gpa = 1.0;
                            else $gpa = 0.0;
                            
                            echo "<p><strong>GPA Equivalent (4.0 scale):</strong> " . number_format($gpa, 2) . "</p>";
                        }
                        
                        // Determine final remarks
                        if ($average >= 90) {
                            $finalRemarks = "Excellent!";
                            $remarkColor = "green";
                        } elseif ($average >= 80) {
                            $finalRemarks = "Very Good";
                            $remarkColor = "blue";
                        } elseif ($average >= 75) {
                            $finalRemarks = "Satisfactory";
                            $remarkColor = "orange";
                        } else {
                            $finalRemarks = "Needs Improvement";
                            $remarkColor = "red";
                        }
                        
                        echo "<p style='color: $remarkColor; font-weight: bold; font-size: 20px;'>
                              Final Remarks: $finalRemarks</p>";
                        
                        echo '</div>';
                    } else {
                        echo '<div class="result" style="border-left-color: #f44336;">';
                        echo '<p style="color: #f44336;">Please enter valid grades between 0 and 100.</p>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>