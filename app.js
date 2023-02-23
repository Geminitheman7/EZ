let budgetAmount = 0;
let expenses = [];

const budgetButton = document.querySelector("#budget-button");
budgetButton.addEventListener("click", setBudget);

const expenseButton = document.querySelector("#expense-button");
expenseButton.addEventListener("click", addExpense);

function setBudget(event) {
	event.preventDefault();
	const budgetInput = document.querySelector("#budget-input");
	budgetAmount = parseFloat(budgetInput.value);
	budgetInput.value = "";
	updateBalance();
}

function addExpense(event) {
	event.preventDefault();
	const expenseNameInput = document.querySelector("#expense-name");
	const expenseAmountInput = document.querySelector("#expense-amount");
	const expenseName = expenseNameInput.value;
	const expenseAmount = parseFloat(expenseAmountInput.value);
	expenseNameInput.value = "";
	expenseAmountInput.value = "";
	expenses.push({ name: expenseName, amount: expenseAmount });
	updateExpenses();
	updateBalance();
}

function updateExpenses() {
	const expenseList = document.querySelector("#expense-list");
	expenseList.innerHTML = "";
	for (let i = 0; i < expenses.length; i++) {
		const expense = expenses[i];
		const li = document.createElement("li");
		const nameSpan = document.createElement("span");
		nameSpan.textContent = expense.name;
		const amountSpan = document.createElement("span");
		amountSpan.textContent = expense.amount.toFixed(2);
		li.appendChild(nameSpan);
		li.appendChild(amountSpan);
		expenseList.appendChild(li);
	}
}

function updateBalance() {
	const expenseTotal = expenses.reduce(function(acc, expense) {
		return acc + expense.amount;
	}, 0);
	const balanceAmount = document.querySelector("#balance-amount");
	balanceAmount.textContent = (budgetAmount - expenseTotal).toFixed(2);
	if (budgetAmount - expenseTotal < 0) {
		balanceAmount.style.color = "red";
	} else {
		balanceAmount.style.color = "black";
	}
}
