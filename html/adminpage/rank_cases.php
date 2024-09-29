<?php
include 'conn_db.php';

// SQL query to count unique cases by title and user_id
$sql = "SELECT title, COUNT(DISTINCT user_id) as case_count
        FROM cases
        GROUP BY title
        ORDER BY case_count DESC";

$result = $conn->query($sql);

// Prepare data for Chart.js
$titles = [];
$counts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titles[] = $row['title'];
        $counts[] = $row['case_count'];
    }
} else {
    echo "No cases found.";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases Ranking Bar Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div style="width: 80%; margin: auto;">
    <canvas id="casesBarChart"></canvas>
</div>

<script>
    // Data from PHP
    const titles = <?php echo json_encode($titles); ?>;
    const counts = <?php echo json_encode($counts); ?>;

    const ctx = document.getElementById('casesBarChart').getContext('2d');
    const casesBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: titles,
            datasets: [{
                label: 'Number of Unique Cases',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Unique Cases'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Case Title'
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Ranking of Unique Cases by Title'
                }
            }
        }
    });
</script>

</body>
</html>
