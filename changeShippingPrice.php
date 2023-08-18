<?php
if (isset($_POST['shipping'])) {
  // Process the selected value (you can perform any required operations here)
  $selectedValue = $_POST['shipping'];
  $subtotal = $_POST['subtotal'];

  // Simulate some output based on the selected value
  $output = "₾" . $subtotal . "+" . $selectedValue;

  // Return the output as a response to the AJAX request
  echo $output;
}
?>