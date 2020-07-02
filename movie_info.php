<?php
	$nav_selected = "MOVIES";
	$left_buttons = "YES";
	$left_selected = "WARNINGS";

	include("./nav.php");
	global $db;
?>

<div class="right-content">
	<div class="container">

	<table>
		</tbody>
			<h3 style = "color: #01B0F1;">Movies --> Meta Data </h3>
				<?php
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
					}
					$stmt = $db->prepare("SELECT * 
						FROM movies LEFT OUTER JOIN movie_data
						ON movies.movie_id = movie_data.movie_id 
						WHERE movies.movie_id = ?");
					$stmt->bind_param("i", $id);
					$stmt->execute();

					/* Store the result (to get properties) */
					$stmt->store_result();

					/* Bind the result to variables */
					$stmt->bind_result($movie_id, $native_name, $english_name, $year_made,
									   $movie_id, $language, $country, $genre, $plot);

					while ($stmt->fetch()) {
						//echo 'ID: '.$movie_id.'<br>';
						echo '<b>Native Name</b>: '.$native_name.'<br>';
						echo '<b>English Name</b>: '.$english_name.'<br>';
						echo '<b>Year</b>: '.$year_made.'<br>';
						echo '<b>Language</b>: '.$language.'<br>';
						echo '<b>Country</b>: '.$country.'<br>';
						echo '<b>Plot</b>: '.$plot.'<br>';
						echo '<b>Genre</b>: '.$genre.'<br>';
					}

					/* free results */
					$stmt->free_result();

					/* close statement */
					$stmt->close();
				?>
			</tbody>
		</table>
	</div>
</div>

<?php include("./footer.php"); ?>
