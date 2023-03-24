
<!DOCTYPE html>
<html>
<head>
	<title>Кредитный калькулятор</title>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="principal">Сумма кредита:</label>
		<input type="number" name="principal" required><br>
		<label for="interest_rate">Процентная ставка:</label>
		<input type="number" step="0.01" name="interest_rate" required><br>
		<label for="duration">Срок кредита (мес.):</label>
		<input type="number" name="duration" required><br>
		<input type="submit" name="submit" value="Рассчитать">
	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$principal = floatval($_POST['principal']);
		$interest_rate = floatval($_POST['interest_rate']);
		$duration = intval($_POST['duration']);

		// годовая процентная ставка в месяц
		$monthly_rate = ($interest_rate / 100) / 12;

		// ежемесячный платеж
		$monthly_payment = ($monthly_rate * $principal) / (1 - pow(1 + $monthly_rate, -$duration));

		// общая сумма выплат
		$total_payment = $monthly_payment * $duration;

		//переплата
		$total_interest = $total_payment - $principal;

		// Выводим результаты
		echo "<h2>Результаты расчета:</h2>";
		echo "Ежемесячный платеж: " . number_format($monthly_payment, 2) . " тг.<br>";
		echo "Общая сумма выплат: " . number_format($total_payment, 2) . " тг.<br>";
		echo "Переплата по кредиту: " . number_format($total_interest, 2) . " тг.<br>";
	}
	?>
</body>
</html>