<!DOCTYPE html>
<html>
<head>
	<title>Pokes</title>
	<link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
</head>
<body>
	<div id="container">
		<div id="header">
			<h3>Welcome, <?php echo $this->session->userdata('current')['alias']; ?>!</h3>
			<span id="logout"><a href="Logout">Logout</a></span>
			<h4><?php 
				if($pokecount['count'] == NULL){
					$pokecount['count'] = 0;
				}
				echo $pokecount['count']; 
				?> 
				People poked you!</h4>
		</div>
		<div id="pokedBy">
		<table>
			<?php
			if(empty($whoPoked)){
				echo "<p>No one poked you yet..</p>";
			}
				foreach($whoPoked as $value){
					echo "<p>" . $value['alias'] . " poked you " . $value['count'] . " times";
				}
			?>
		</table>
		</div>
		<div id="toPoke">
			<h4>People you may want to poke:</h4>
			<table id='poketable'>
				<thead>
					<tr>
						<td>Name</td>
						<td>Alias</td>
						<td>Email Address</td>
						<td>Poke History</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($allUsers as $value){
						echo "<tr>";
						echo "<td>" . $value['name'] . "</td>";
						echo "<td>" . $value['alias'] . "</td>";
						echo "<td>" . $value['email'] . "</td>";
						if($value['total'] == NULL){
							$value['total'] = '0';
						}
						echo "<td>" . $value['total'] . " Pokes</td>";
						echo "<td>";
						echo "<form action='AddPoke/" . $value['id'] . "' method='post'>";
						echo "<input type='submit' value='Poke!'>";
						echo "</form>";
						echo "</td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>