<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="icon-png.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papa's Pizzaria</title>
</head>
<body>
    <style>
        @font-face {
            font-family: font1;
            src: url(tomatos\ pizza.ttf);
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        header{
            background-color: rgb(167, 167, 167);
            padding: 50px;
            margin-bottom: 50px;
        }

        h1{
            font-family: font1;
            font-size: 110px;
            background: linear-gradient(to right, green 13%, white 13%, white 31%, red 16%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

        }

        body{
            background-image: url(background-pizzaria.webp);
            background-size:cover;
            background-repeat:repeat;
            height: 100vh;

            overflow-x: hidden;
        }

        form{
            display: flex;
            flex-direction: column;
            width: 110vw;
            max-width: 700px;
            padding: 20px;
            background-color: transparent;
            backdrop-filter:blur(20px);
            z-index: 5;
            margin: auto;
            font-size: 20px;
            border-radius: 5px;
        }

        form input, select, button{
            padding: 15px;
            border: none;
            font-size: 20px;
            border-radius: 5px;
        }

        form label{
            margin-top: 18px;
            margin-bottom: 7px;
            color:whitesmoke;
        }

        button{
            background-color:#318734;
            color:whitesmoke;
            transition: .5s;
            margin: 10px 0px;
        }

        button:hover{
            background-color: #226b24;
            transition: .5s;
        }

        #resultado{
            color: whitesmoke;
        }

        img{
            position: absolute;
        }

        #pizza-inteira{
            left: -10%;
            height: 500px;
            position: absolute;
            top: 70%;
            z-index: -1;
            animation: movimentando 2s infinite alternate;
        }

        #pizza-fatia{
            top: 0;
            right: -140px;
            height: 100vh;
            z-index: -1;
            animation: movimentando 2s infinite alternate-reverse;
        }

        footer{
            background-color: rgb(201, 201, 201);
            color: rgb(46, 46, 46);
            padding: 30px;
            margin-top: 20px;
        }

        #toggle-btn{
            position: fixed;
            height: 50px;
            width: 100px;
            right: 50px;
            top: 10px;
            background-color: black;
            border-radius: 40px;
            transition: .5s;
        }
        
        #toggle-btn::before{
            content: '';
            position: absolute;
            height: 40px;
            margin: 5px;
            width: 40px;
            border-radius: 50%;
            background-color: whitesmoke;
            transition: .5s;
        }

        .dark-mode main form{
            background-color: black;
            color: red;
        }

        .dark-mode footer{
            background-color: black;
            color: whitesmoke;
        }

        .dark-mode header{
            background-color: black;
        }

        .dark-mode header #toggle-btn{
            background-color: whitesmoke;
            transition: .5s;
        }

        .dark-mode header #toggle-btn::before{
            background-color: black;
            transform: translateX(50px);
            transition: .5s;
        }


        @keyframes movimentando {
            from{
                transform: translateY(-20px);
            }
            to{
                transform: translateY(20px);
            }
        }
    </style>

 <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizzariapapa";

    //Criar a conexão

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $endereco = $_POST["endereco"];
        $sabor = $_POST["sabor"];
        $opcional = $_POST["opcional"];
        $tamanho = $_POST["tamanho"];
        $quantidade = $_POST["quantidade"];

        $sql = "INSERT INTO clientes (nome, telefone, endereco) VALUES ('$nome', '$telefone', '$endereco')";

        if($conn->query($sql)=== TRUE){
            echo "<h1>DADOS INSERIDOS!</h1>";
        }else{
            echo "Erro:" . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO pedidos (sabor, opcional, tamanho, quantidade) VALUES ('$sabor', '$opcional', '$tamanho', '$quantidade')";
        if($conn->query($sql)=== TRUE){
            echo "<h1>PEDIDO NO FORNO!</h1>";
        }else{
            echo "Erro:" . $sql . "<br>" . $conn->error;
        }
    }

    $conn -> close();
?> 


    <main>
        <header>
            <h1>Papa's Pizzaria</h1>
            <div id="toggle-btn"></div>
        </header>
        
        <form action="" method="post">
            <label for="">Nome</label>
            <input type="text" name="nome" placeholder="Seu nome lindo..." required>
            <label for="">Telefone</label>
            <input type="tel" maxlength="13" name="telefone" placeholder="Seu telefone..." required>
            <label for="">Endereço</label>
            <input type="text" name="endereco" placeholder="Onde fica sua casinha..." required>
            <label for="">Sabor</label>
            <select name="sabor">
                <optgroup label="Pizzas Salgadas">
                    <option value="calabresa">Calabresa</option>
                    <option value="mussarela">Mussarela</option>
                    <option value="4queijos">4 Queijos</option>
                    <option value="alhoeoleo">Alho e Óleo</option>
                    <option value="portuguesa">Portuguesa</option>
                    <option value="marguerita">Marguerita</option>
                    <option value="sorvete">Sorvete</option>
                    <option value="catupiry">Catupiry</option>
                </optgroup>
                <optgroup label="Pizzas Doces">
                    <option value="chocolatebranco">Chocolate Branco</option>
                    <option value="chocolate">Chocolate</option>
                    <option value="oreo">Oreo</option>
                    <option value="morango">Morango</option>
                    <option value="charge">Charge</option>
                </optgroup>
            </select>
            <label for="">Opcional</label>
            <input type="text" name="opcional" placeholder="Exemplo: 'sem cebola' ">
            <label for="">Tamanho</label>
            <select name="tamanho" id="tamanho">
                <option value="30">P - 30cm</option>
                <option value="35">M - 35cm</option>
                <option value="40">G - 40cm</option>
                <option value="50">GG - 50cm</option>
                <option value="60">Big - 60cm</option>
            </select>
            <label for="">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" placeholder="Quantas pizzas quer..." required>
            <label for="">Enviar Pedido</label>
            <button type="button" onclick="calcular()" id="resultado">Calcular Preço</button>
            <button type="submit">Enviar Pedido</button>
        </form>
        <img src="pizza-fatia.png" id="pizza-fatia">
        <img src="pizza.png" id="pizza-inteira">
    </main>
    <footer>
        <h4>Contato</h4>
        <h4>+55 51 9823295</h4>
        <h5>Desenvolvido por Ricardo Müller Severo | 2024 &copf; &copy;</h5>
    </footer>
    <script>
        const togglebtn = document.getElementById("toggle-btn");
        const body = document.body;
        togglebtn.addEventListener("click", function(){
            body.classList.toggle('dark-mode');
        })
        function calcular(){
            console.log("bom dia");
            var tamanho = document.getElementById("tamanho").value;
            var quantidade = document.getElementById("quantidade").value;
            let resultado = document.getElementById("resultado")
            resultado.innerHTML = `Calcular - O valor ficou em R$${(tamanho * 1.25) * quantidade}`

        }

        let docTitle = document.title;
        window.addEventListener("blur", () =>{
            document.title = "Já vai embora?";
        })
        window.addEventListener("focus", ()=>{
            document.title = docTitle;
        })

        
    </script>
</body>
</html>