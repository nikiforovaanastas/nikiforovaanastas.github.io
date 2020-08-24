<head>
	<meta name="page" content="text/html: charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<title> FORM </title>

<style>
body {
    background: #D0E6A5;
    color: black;
}
.decor {padding:5px;
  max-width: 1200px;
  background: white;
}
.form-inner {
    padding: 50px;
}
.form-inner input,
.form-inner textarea {
  display: block;
  width: 100%;
  padding: 0 20px;
  margin-bottom: 10px;
  background: #D0E6A5;
  line-height: 40px;
  border-width: 0;
  font-family: 'Roboto', sans-serif;
}
.form-inner input[type="submit"] {
  margin-top: 30px;
  background: #D0E6A5
  color: white;
  font-size: 14px;
}
.form-inner textarea {resize: none;}
.form-inner h3 {
  margin-top: 0;
  font-family: 'Roboto', sans-serif;
  font-weight: bold;
  font-size: 24px;
  color: #D0E6A5;
}
.error {
    border: 2px solid red;
}
</style>

</head>

 <body>
    <?php
    if (!empty($messages)) {
      print('<div id="messages">');
      foreach ($messages as $message) {
        print($message);
      }
      print('</div>');
    }
    ?>
    
    <div class=" container" align="center" style="padding-top:40px; padding-bottom:40px;">
 	<p style="color:#fff; font-size:30px;">If you are admin, click<a href="admin.php"> here</a></p>

	<div class="container" align="center" style="padding-top:40px; padding-bottom:40px;">
	<form action="" method="POST" class="decor">
	<div class="form-inner">
	<h3>ANKETA</h3>
		<table>
		  <tr>
			<th>

  			<div <?php if ($errors['name']) print 'class="error"'; ?>>
  				<input name="name"
  				value="<?php print $values['name']; ?>" placeholder="FIO"/>
  			</div>
  			<br/>
  			<div <?php if ($errors['email']) print 'class="error"'; ?>>
  				<input name="email"
  				value="<?php print $values['email']; ?>" placeholder="xxx@mail.ru" />
  			</div>
  			<br />
  			<div <?php if ($errors['fieldname']) print 'class="error"'; ?>>
  				<textarea name="fieldname" placeholder="Bio."><?php print $values['fieldname'];?></textarea>
  			</div>
  			<br />

            Select year of birthday. <br/>&emsp;&emsp;&emsp;
            <select name="year">
                <?php
                    if ($errors['year'])
                        print 'class="error"';
                    for ($q = 1900; $q < 2020; $q++){
                        print "<option value='$q' ";
                        if($values['year'] == $q)
                            print 'selected';
                        print ">$q</option>";
                    }
                ?>
    		</select>
  			<br />

  			</th>

      		<th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>

			<th>
      			<label>
          			<input type="radio" <?php if ($errors['sex']) print 'class="error"'; ?>
          			<?php if($values['sex'] == 'Male') print 'checked'; ?>
        			name="sex" value="Male" />Man
      			</label>
      			&emsp;&emsp;&emsp;
      			<label>
          			<input type="radio" <?php if ($errors['sex']) print 'class="error"'; ?>
          			<?php if($values['sex'] == 'Female') print 'checked'; ?>
        			name="sex" value="Female" />Womam
      			</label>
      			<br /><br />

        		Select the number of limbs.
        		<br />
        		<label>
          			<input type="radio"
          			<?php if($values['limbs'] == 'One') print 'checked'; ?>
        			name="limbs" value="One" />1
        		</label>
        		&emsp;&emsp;
      			<label>
          			<input type="radio"
          			<?php if($values['limbs'] == 'Two') print 'checked'; ?>
        			name="limbs" value="Two" />2
        		</label>
        		&emsp;&emsp;
        		<label>
            		<input type="radio"
            		<?php if($values['limbs'] == 'Three') print 'checked'; ?>
        			name="limbs" value="Three" />3
        		</label>
        		&emsp;&emsp;
        		<label>
            		<input type="radio"
            		<?php if($values['limbs'] == 'Four') print 'checked'; ?>
        			name="limbs" value="Four" />4
        		</label>
        		<br /><br />

        		Choose your superpower <br />
           		<select name="abilities" multiple <?php if ($errors['abilities']) print 'class="error"'; ?>>
            		<option value="Immotality"
            			<?php if($values['abilities'] == 'Immotality') print 'selected'; ?>>
            			Immotality</option>
                    <option value="Superspeed"
                    	<?php if($values['abilities'] == 'Superspeed') print 'selected'; ?>>
                    	Superspeed</option>
                    <option value="Levitation"
                    	<?php if($values['abilities'] == 'Levitation') print 'selected'; ?>>
                    	Levitation</option>
                    <option value="Mind reading"
                    	<?php if($values['abilities'] == 'Mind reading') print 'selected'; ?>>
                    	Mind reading</option>
                    <option value="Hyperspeed"
                    	<?php if($values['abilities'] == 'Hyperspeed') print 'selected'; ?>>
                    	Hypersreed</option>

          		</select>

      			</th>
      		  </tr>
      		</table>

      		<label>
      		<div <?php if ($errors['checks']) print 'class="error"'; ?>>
      			<input type="checkbox"
      			<?php if($values['checks']) print 'checked'; ?>
        		name="checks" value="checked" />
        		Acquainted with the contract.
        	</div>
      		</label>
            <br /><br />
  			<input  type="submit" value="SEND" />
  		</div>
		</form>
		</div>
     </div>
</body>
