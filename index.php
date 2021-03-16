<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="utf-8" />
        <title>Eingabeformular</title>
        <link rel="stylesheet" type="text/css" href="css/styleSheet.css">
        <script type="text/javascript" src="js/nurZahl.js"></script>
    </head>
    <body>

		<?php
			$datumErr = $plzErr = $emailErr = $preisErr = "";
			$datumCheck = $plzCheck = $emailCheck = $preisCheck = "";
			$datum = $plz = $email = $preis = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["datum"])) {
					$datumErr = "Bitte geben Sie ein gültiges Datum ein.";
				} else {
					$datum = test_input($_POST["datum"]);
					if (!preg_match("/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/",$datum)) {
     	 				$datumErr = "Bitte geben Sie ein Datum zwischen 1899 und 2099 ein."; 
    				} else {
    					$datumCheck = "✔";
    				}
				}

				if (empty($_POST["plz"])) {
					$plzErr = "Bitte geben Sie eine Postleitzahl ein.";
				} else {
					$plz = test_input($_POST["plz"]);
					if (!preg_match("/\d{4,5}/",$plz)) {
     	 				$plzErr = "Bitte geben Sie eine gültige Postleitzahl ein."; 
    				} else {
    					$plzCheck = "✔";
    				}
				}

				if (empty($_POST["email"])) {
					$emailErr = "Bitte geben Sie eine E-Mail-Adresse ein.";
				} else {
					$email = test_input($_POST["email"]);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     			 		$emailErr = "Bitte geben Sie korrekte E-Mail-Adresse ein."; 
    				} else {
    					$emailCheck = "✔";
    				}
				}

				if (empty($_POST["preis"])) {
					$preisErr = "Bitte geben Sie den Preis ein.";
				} else {
					$preis = test_input($_POST["preis"]);
					if (!preg_match("/\d+(,\d{2})/",$preis)) {
     	 				$preisErr = "Bitte Preis im Format #,## € eingeben."; 
    				} else {
    					$preisCheck = "✔";
    				}
				}
			}

			function test_input($data) {
			  	$data = trim($data);
			  	$data = stripslashes($data);
			  	$data = htmlspecialchars($data);
			  	return $data;
			}

			function clean($string) {
  				$string = str_replace(' ', '-', $string);
   				$string = preg_replace('/[^A-Za-z0-9,@.-]/', '', $string);
   				$string = preg_replace('/[@]/', '[at]', $string);
   				return preg_replace('/-+/', '-', $string);
			}
		?>

    	<h1>Eingabeformular</h1>
    	<p class="benoetigt">Felder mit <span class="stern">★</span> werden benötigt</p>
        <form name="eformular" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="post" novalidate>
	    	<table width="600" align="left" cellpadding="4">
	    		<tr>
	    			<td width="100"><label class="pointer" for="datum">Datum:</label></td>
	    			<td width="200">
	    				<input
	    					class="eingabefeld" 
	    					type="date" 
	    					min="1899-01-01" 
	    					max="2099-12-31" 
	    					name="datum" 
	    					id="datum" 
	    					placeholder="TT.MM.JJJJ" 
	    					value="<?php echo $datum;?>"
	    				>
	    			</td>
	    			<td width="300">
	    				<span class="error">★ <?php echo $datumErr;?></span>
	    				<span class="check"><?php echo $datumCheck;?></span>
	    			</td>
	    		</tr>
		    	<tr>
		    		<td width="100"><label class="pointer" for="plz">Postleitzahl:</label></td>
		    		<td width="200">
		    			<input 
		    				class="eingabefeld" 
		    				type="text" 
		    				minlength="4" 
		    				maxlength="5" 
		    				name="plz" 
		    				id="plz" 
		    				placeholder="12345" 
		    				onkeypress="validate_plz(event);" 
		    				value="<?php echo $plz;?>"
		    			>
		    		</td>
		    		<td width="300">
	    				<span class="error">★ <?php echo $plzErr;?></span>
	    				<span class="check"><?php echo $plzCheck;?></span>
	    			</td>
		    	</tr>
		    	<tr>
		    		<td width="100"><label class="pointer" for="email">E-Mail:</label></td>
		    		<td width="200">
		    			<input 
		    				class="eingabefeld" 
		    				type="email" 
		    				name="email" 
		    				id="email" 
		    				placeholder="example@domain.com" 
		    				value="<?php echo $email;?>"
		    			>
		    		</td>
		    		<td width="300">
	    				<span class="error">★ <?php echo $emailErr;?></span>
	    				<span class="check"><?php echo $emailCheck;?></span>
	    			</td>
		    	</tr>
		    	<tr>
		    		<td width="100"><label class="pointer" for="preis">Preis:</label></td>
		    		<td width="200">
		    			<input 
		    				class="eingabefeld" 
		    				type="text" 
		    				name="preis" 
		    				id="preis" 
		    				placeholder="0,00" 
		    				pattern="\d+(,\d{2})" 
		    				onkeypress="validate_preis(event);" 
		    				value="<?php echo $preis;?>"
		    			> &euro;
		    		</td>
		    		<td width="300">
	    				<span class="error">★ <?php echo $preisErr;?></span>
	    				<span class="check"><?php echo $preisCheck;?></span>
	    			</td>
		    	</tr>
		    	<tr>
		    		<td width="100"><input class="pointer zurueck" type="reset" name="leeren" value="Zur&uuml;cksetzen"></td>
		    		<td><input class="pointer" type="submit" name="senden" value="Absenden"></td>
		    	</tr>
		    </table>
	    </form>

		<div class="ausgabe">
			<?php
				echo "<h2>Ausgabe:</h2>";
				echo clean($datum);
				echo "<br>";
				echo clean($plz);
				echo "<br>";
				echo clean($email);
				echo "<br>";
				echo clean($preis);
				echo "<br>";
				echo "<p id='notiz'>Ausgabe nur als Test vorhanden, da keine Angabe gemacht wurde, wie mit den eingegebenen Daten weiterverfahren werden soll.</p>";
			?>
		</div>

	    <footer>
    		<p class="footerbox">Testaufgabe von Jan Wöde</p>
   		</footer>
    </body>
</html>