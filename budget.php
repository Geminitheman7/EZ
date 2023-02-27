<?php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get the budget and expenses data from the form
  $budgetAmount = $_POST['budgetAmount'];
  $expenses = $_POST['expenses'];

  // Save the data to a text file
  $data = array(
    'budgetAmount' => $budgetAmount,
    'expenses' => $expenses
  );
  file_put_contents('data.txt', serialize($data));

  // Redirect back to the page
  header('Location: budget.php');
  exit();
}

// Load the data from the text file
$data = unserialize(file_get_contents('data.txt'));

// Set the initial budget and expenses values
$budgetAmount = isset($data['budgetAmount']) ? $data['budgetAmount'] : 0;
$expenses = isset($data['expenses']) ? $data['expenses'] : array();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Foodie Voyager Budget App</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<main>
		<div class="container">
			<h1>Foodie Voyager Budget App</h1>
			<form method="post">
				<label for="budget-input">Enter your budget:</label>
				<input type="number" id="budget-input" step="0.01" name="budgetAmount" value="<?php echo htmlspecialchars($budgetAmount); ?>">
				<button id="budget-button">Set Budget</button>
			</form>
			<form method="post">
				<label for="expense-name">Expense Name:</label>
				<input type="text" id="expense-name" name="expenseName">
				<label for="expense-amount">Expense Amount:</label>
				<input type="number" id="expense-amount" step="0.01" name="expenseAmount">
				<button id="expense-button">Add Expense</button>
			</form>
			<div class="balance">
				<h2>Balance:</h2>
				<span id="balance-amount"><?php echo number_format($budgetAmount - array_sum($expenses), 2); ?></span>
			</div>
			<div class="expenses">
				<h2>Expenses:</h2>
				<ul id="expense-list">
          <?php foreach ($expenses as $expense) : ?>
            <li>
              <span><?php echo htmlspecialchars($expense['name']); ?></span>
              <span><?php echo number_format($expense['amount'], 2); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
			</div>
		</div>
	</main>
	<script src="app.js"></script>
</body>
</html>
