<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aid = $_POST['aid'];
    $amount = $_POST['amount'];

    // 1. Connect to the database
    $conn = new mysqli("localhost", "root", "", "edoc");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 2. Insert into the payment table
    $sql = "INSERT INTO payment (AID, CashAmount) VALUES ('$aid', '$amount')";
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Payment Successful!</h2>";

        // 3. Auto-redirect to another page
        echo "<p>You will be redirected shortly...</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'appointment.php'; // Change to your destination page
                }, 3000);
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
