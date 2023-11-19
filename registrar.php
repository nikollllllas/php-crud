<!DOCTYPE html>
<html>
	<head>
		<title>Registrar</title>
		<meta charset="utf-8">
	</head>
	<body>  
		<form method="post" id="formregister" name="formregister" >

			<label>USUÁRIO:</label>
			<input type="text" name="login" id="login"/><br/>

			<label>SENHA:</label>
			<input type="password" name="senha1" id="senha1"/><br/>

            <label>REPETIR SENHA:</label>
			<input type="password" name="senha2" id="senha2"/><br/>
            
            <label>EMAIL:</label>
			<input type="password" name="email" id="email"/><br/>

			<input type="submit" value="LOGAR" onclick="validate()"/>
		</form>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>     
        <script src="myscript.js"></script>
	</body>
</html>