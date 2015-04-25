<html>
<head>

<link rel="stylesheet" type="text/css" href="css/search.css">

</head>
</html>
<?php 
include 'core/init.php';
require 'core/database/connectdb.php';
include 'includes/overall/overall_header.php'; 

	if (isset($_POST["gene_id"])) {		
	$gene_id=$_POST["gene_id"];
		
	if (!empty($gene_id)) {
		
		if (strlen($gene_id)>=5) {
					
			$sql = "SELECT main.seq_id, main.seq_description, main.status, main.organism, annotation.length, annotation.signal_peptide, annotation.molecular_weight, annotation.isoelectric_point, annotation.phobius, annotation.tmhmm, sequence_gene.seq_nuc, sequence_gene.seq_pro FROM main INNER JOIN annotation ON annotation.seq_id = main.seq_id INNER JOIN sequence_gene ON sequence_gene.seq_id = main.seq_id WHERE main.seq_id = '".mysql_real_escape_string($gene_id)."'";
			
			$sql2 = "SELECT main.seq_id FROM main WHERE main.seq_id = '".mysql_real_escape_string($gene_id)."'";

			$sql_run = mysql_query($sql);
			$sql_num_rows = mysql_num_rows($sql_run);
			$sql_run2 = mysql_query($sql2);
			$sql_num_rows2 = mysql_num_rows($sql_run2);
		
			if ($sql_num_rows>=1) {
			
			//table for display output
			echo 'Results found for <strong><span id="bigger">'.$gene_id.'</span></strong>.</h2>';	
			
			//result main
			echo '<h3>[A] Basic information</h3>
			<table>';
			while ($sql_row = mysql_fetch_assoc($sql_run)) {
				
				echo '<tr><th>Description</th>
				<td>'.$sql_row['seq_description'].'</td></tr>
				<tr><th>Length</th>
				<td>'.$sql_row['length'].'</td></tr>
				<tr><th>Molecular weight</th>
				<td>'.$sql_row['molecular_weight'].'</td></tr>
				<tr><th>Type</th>
				<td>'.$sql_row['status'].'</td></tr>
				<tr><th>Isoelectric point</th>
				<td>'.$sql_row['isoelectric_point'].'</td></tr>				
				<tr><th>Signal peptide</th>
				<td>'.$sql_row['signal_peptide'].'</td></tr>
				<tr><th>TMHMM</th>
				<td>'.$sql_row['tmhmm'].'</td></tr>
				<tr><th>Phobius</th>
				<td>'.$sql_row['phobius'].'</td></tr>
			</table><br />';
			
			//result KEGG & GO
			echo '<h3>[B] Functional annotation</h3>
			<table>
				<tr><th class="seq_header">KEGG</th>
				<td class="sequence">EC:6.3.2.2<br />Pathway: Glutathione metabolism <a href="#">map00480</a><br /><br /><img src="http://www.genome.jp/kegg/pathway/map/map00270.png" width="500px"></td></tr>
				<tr><th class="seq_header">Gene Ontology</th>
				<td class="sequence">Biological Process:<br /><a href="#">GO:0042398</a> [cellular modified amino acid biosynthetic process]<br /><br /> 
				Molecular Function:<br />
				<a href="#">GO:0004357</a> [glutamate-cysteine ligase activity]<br /><a href="#">GO:0005524</a> [ATP binding]<br /><br />
				Cellular Component:<br />N/A<br /></td></tr>
			</table><br />';
			
							
			//result sequence
			echo '<h3>[C] Sequence</h3>
			<table>
				<tr><th class="seq_header">Gene Sequence</th>
				<td class="sequence">'.wordwrap($sql_row['seq_nuc'],60,'<br />',TRUE).'<br /><br /><a href="#">[Download]</a><br /><br /></td></tr>
				<tr><th class="seq_header">Protein Sequence</th>
				<td class="sequence">'.wordwrap($sql_row['seq_pro'],60,'<br />',TRUE).'<br /><br /><a href="#">[Download]</a><br /><br /></td></tr>
			</table><br />';
			}
			
				while ($sql_row2 = mysql_fetch_assoc($sql_run2)) {
						
					//result transcriptome
					echo '<h3>[C] Transcripts Expression</h3>
					<p class="middle">Note: List down all conditions that associated to the gene regulation level (up, down or no change). E.g: when click on Condition1, popup a window containing of list of genes that are up/down/no change in Conditon1)</p>
						<table>
							<tr><th class="sequence_header">Up regulated</th>
							<td class="sequence">Condition1 Condition2 Condition3 Condition5 Condition6 Condition8 Condition11 </td></tr>
							<tr><th class="sequence_header">Down regulated</th>
							<td class="sequence">Condition4 Condition13</td></tr>
							<tr><th class="sequence_header">No Change</th>
							<td class="sequence">Condition7 Condition9 Condition10 Condition12 Condition5</td></tr>
						</table><br />';
				}
			} else {
				echo "No results found.";
			}
		} else {
			echo "Your keyword must be at least 5 characters.";
		}
	} else {
		echo "Please enter a keyword.";
	}
	}

include 'includes/overall/overall_footer.php'; 
?>
