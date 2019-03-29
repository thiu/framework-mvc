<?php include('../layout/header.php');?>

<div class="container">
<p class="fonte center">Controllers</p>

<p class="flow-text text">Por padrão as controllers devem ser criadas dentro da pasta <strong class="brown-text">app/http/controllers</strong>, assim não é necessário nenhuma outra configuração para atualizar o autoload. Caso seja utilizado outro diretório passa a ser necessário a definição do caminho na variavel <em>"autoload":</em> do arquivo <em>composer.json</em> para que o diretório seja reconhecido ao atualizar o autoload.</p>
<p class="flow-text text">
Para utilização completa das funcionalidades do framework sua controllers deve ser definida conforme o exemplo da controller <strong class="green-text">WelcomeController</strong>, extendendo a classe <strong class="green-text">Controller</strong> que pertence ao <strong class="brown-text">src</strong> do framework</p>

<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> Class WelcomeController</h5>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">namespace</span> <span class="green-text">App\Http\Controllers</span>;
				<br>
				<span class="red-text">use</span> Src\<span class="blue-text">Controller</span>;
				<br>
				<span class="blue-text">class</span> <span class="green-text">WelcomeController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span>
				<br>
				{
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function </span><span class="green-text">index</span> () {
				<br>
				<span style="margin-left:50px;">
					$array <span class="red-text">=</span> [<span class="purple-text">1</span> <span class="red-text">=></span> <span class="yellow-text">'Contoller'</span>, <span class="purple-text">2</span> <span class="red-text">=></span> <span class="yellow-text">'Exemplo'</span>];
					<br>
				</span>
				<span style="margin-left:50px;">
					<span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">view</span>(<span class="orange-text">'welcome.index'</span>, <span class="blue-text">compact</span>(<span class="orange-text">'array'</span>));	
				</span>
					
				</span>
				
				</span>
				<br>
				<span style="margin-left:25px;">}
				</span><br>
				}<br>
			</div>
			<div class="card-action white">
				Diretório padrão: /app/http/controllers
			</div>
		</div>
	</div>
</div>

<p class="flow-text text">Após a estrutra inicial estar conforme o exemplo (o método index() não é obrigatório), você pode definir todos os métodos que sua controller ira executar.
<br>
Com isso sua controller passa a ter acesso a alguns métodos padrões do framework definidos no <strong class="brown-text">src</strong> do framework</p>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Métodos padrões da Controller</h5>

<table class="responsive-table highlight">
 	<thead>
 		<tr>
 			<th>Método</th>
 			<th>Parametros</th>
 			<th>Descrição</th>
 			<th>Exemplo</th>
 		</tr>
 	</thead>
    <tbody>
    	<tr>
    		<td>view($caminho, compact($variaveis)?)</td>
            <td>1 - Caminho da view - Diretórios separados por <i>.</i>
            <br>2 - Variaveis passadas para view com o compact(), parametro opcional.
            </td>
            <td>Retorna a view desejada com as variaveis definidas.</td>
            <td>view('welcome.index', compact('array', 'array')) </td>
        </tr>
        <tr>
    		<td>redirect($url)</td>
            <td>1 - Rota desejada pela URL</td>
            <td>Efetua o redirecionamento para alguma rota</td>
            <td>redirect('welcome');</td>
        </tr>
        <tr>
    		<td>cript(array, string?)</td>
            <td>1 - $_POST enviado pelo formulario <br>
            	2 - (Opcional) Campo de senha utilizado na tabela.</td>
            <td>Criptograma uma informação passada pelo $_POST</td>
            <td>cript($_POST);</td>
        </tr>
        <tr>
    		<td>obView($caminho, compact($variaveis)?)</td>
            <td>1 - Caminho da view - Diretórios separados por <i>.</i>
            <br>2 - Variaveis passadas para view com o compact(), parametro opcional.
            </td>
            <td>Retorna um buffer com a view inserida.</td>
            <td>obView('welcome.index', compact('array', 'array')) </td>
        </tr>
    </tbody>
</table>
<br>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método view()</h5>

	<p class="flow-text text">Este método é utilizado para chamar uma <strong>view</strong> do sistema, normalmente utilizada como retorno de algum metodo de abertura de pagina.
	<br>
	No primeiro parametro definimos o local da view, separando os diretorios por pontos, sendo que o ultimo ponto define o nome do arquivo, sem necessidade de colocar a extensão .php<br>
	Por padrão o framework procura as views dentro do diretório <strong class="brown-text">resources/views</strong>, porém esta configuração pode ser editada nas configurações da aplicação.
	</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					<span class="blue-text">class</span> <span class="green-text">MusicoController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span><br>
					{<br>
					<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function</span> <span class="green-text">index</span>() {<br>
					<span style="margin-left:50px;">$registros</span> <span class="red-text"> = </span> (<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>, <span class="yellow-text">'contrato'</span>])-><span class="blue-text">get</span>();<br>
					<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">view</span>(<span class="yellow-text">'welcome.index'</span>, <span class="blue-text">compact</span>(<span class="yellow-text">'registros'</span>));</span>
					<br><span style="margin-left:25px;">}</span><br>
					}
				</div>
				<div class="card-action white">
					Abre a view index.php dentro da pasta welcome, passando para a view a variavel $registros, tornando-a acessivel.
				</div>
			</div>
		</div>
	</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método redirect()</h5>

	<p class="flow-text text">Este método redireciona para uma rota da aplicação, noralmente utilizado como retorno de metodos create() e update(), ou de metodos que devem apenas redirecionar o usuário para outra rota.
	</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					<span class="blue-text">class</span> <span class="green-text">MusicoController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span><br>
					{<br>
					<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function</span> <span class="green-text">insert</span>() {<br>
					<span style="margin-left:50px;">(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">create</span>($_POST);<br>
					<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">redirect</span>(<span class="yellow-text">'musicos'</span>);</span><br>
					<span style="margin-left:25px;">}</span><br>
					}
				</div>
				<div class="card-action white">
					Redireciona o usuario para a rota /musicos apos a inserção de um registro.
				</div>
			</div>
		</div>
	</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método cript()</h5>

	<p class="flow-text text">Este método facilita a criptografia de informações, bastante utilizado para passwords de usuários. <br>
	Este método recebe até 2 parâmetros, sendo o primeiro o $_POST do formulário sendo este obrigatório, e o segundo uma string opcional com o nome da key a criptografar do $_POST, quando não informado o framework utiliza o padrão 'password'.
	</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					<span class="blue-text">class</span> <span class="green-text">UsuarioController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span><br>
					{<br>
					<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function</span> <span class="green-text">insert</span>() {<br>
					<span style="margin-left:50px;">$_POST = <span class="orange-text">$this</span>-><span class="blue-text">crypt</span>($_POST);<br>
					<span style="margin-left:50px;">(<span class="red-text">new</span> <span class="blue-text">Usuario</span>)-><span class="blue-text">create</span>($_POST);<br>
					<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">redirect</span>(<span class="yellow-text">'usuarios'</span>);</span><br>
					<span style="margin-left:25px;">}</span><br>
					}
				</div>
				<div class="card-action white">
					Criptografa a senha forneceida no $_POST['password'], e cria um novo registro de usuário com estas informações.
				</div>
			</div>
		</div>
	</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método obView()</h5>

	<p class="flow-text text">Este método cria um buffer passando para dentro dele a view desejada. O retorno deste método é o buffer criado com um <i>ob_start</i>, e é ideal para o uso em relatorios de PDF com o DOMPDF por exemplo, já que assim é possivel de maneira facil passar todo o HTML da view para dentro do PDF.
	</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					<span class="blue-text">class</span> <span class="green-text">MusicoController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span><br>
					{<br>
					<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function</span> <span class="green-text">index</span>() {<br>
					<span style="margin-left:50px;">$foo[] <span class="red-text">=</span> bar;<br>
					<span style="margin-left:50px;">$contents <span class="red-text">=</span> <span class="orange-text">$this</span>-><span class="blue-text">obView</span>(<span class="yellow-text">'musicos.relatorio'</span>, <span class="blue-text">compact</span>(<span class="yellow-text">'foo'</span>)); <br>
					<span style="margin-left:25px;">} <br>
					}
				</div>
				<div class="card-action white">
					Atribui a variavel $contents todo o HTML da view chamada.
				</div>
			</div>
		</div>
	</div>

</div>

<?php include('../layout/footer.php');?>
