<html>
<head>

</head>
</html>
<?php 
include 'core/init.php';
include 'includes/overall/overall_header.php'; 
?>

<div id="div1">

	<h3>Search</h3>
	<p>To search for gene information, please enter a keyword.</p>
	<p>E.g: D286.1_0001, D286.1_0002, ..</p>
	<form action="search.php" method="post">
		<ul id="login">
			<li>
				Gene ID: <input type="text" name="gene_id">
				<input type="submit" value="Search">
			</li>
		</ul>
	</form>
	
</div>
<?php include 'includes/overall/overall_footer.php'; ?>
