<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<?php 
			// 循环创建行
			for ($i=1; $i < 10; $i++) { 
				echo "<tr>";
				// 循环创建格
				for ($j=1; $j < 10; $j++) { 
					echo "<td>";
					if ($j <= $i) {
						echo "$j * $i =".$i * $j;
					}
					echo "</td>";
				}
				echo "</tr>";
			}

			// 1.打印1到100之间5的倍数

	// 2.打印1到100之间个位为5的数

	// 3.打印1到100之间十位为5的数

	// 4.打印1到100之间个位不为5的数

	// 5.打印1到100之间十位不为5的数

	// 6.打印1到100之间个位不为5且十位不为5且不是5的倍数的数

	// 7.打印九九乘法表
		 ?>
	</table>
</body>
</html>