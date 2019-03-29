<?php include('../layout/header.php');?>

<div class="container">
<p class="fonte center">Rotas</p>

<p class="flow-text text"> O framework usa como engine de rotas uma versão minimamente modificada do <a href="http://altorouter.com/" target="_blank">AltoRouter</a>, criado por <a href="https://github.com/dannyvankooten" target="_blank">dannyvankooten</a>.
<br>As rotas da aplicação são definidas na classe <strong class="green-text">Web</strong>, que esta dentro da pasta <strong class="brown-text">routes</strong> na raiz do framework, esta classe extende a classe <strong class="green-text">Route</strong> que pertence ao <strong class="brown-text">src</strong> do framework, nos permitindo ter acesso aos seus métodos estaticos <strong class="blue-text">get()</strong> e <strong class="blue-text">post()</strong>, usados para definir qual o metodo que a rota deve executar.</p>

<h5 class="header">
	<i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i>
	Class Web
</h5>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">namespace</span> <span class="green-text">Routes</span>;
				<br>
				<span class="red-text">use</span> Src\<span class="blue-text">Routes</span>;
				<br>
				<span class="blue-text">class</span> <span class="green-text">Web</span> <span class="red-text">extends</span> <span class="green-text">Routes</span>
				<br>
				{
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> $routes <span class="red-text">=</span> [];
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> $allowed <span class="red-text">=</span> <span class="purple-text">false</span>;
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function __construct</span> () {
				<br>
				<br>
				<span style="margin-left:50px;" class="grey-text">// ROTAS SEM AUTENTICACAO</span>
				<br>
				<br>
				<span style="margin-left:50px;" class="blue-text">session_start</span>();<br>
				<span style="margin-left:50px;" class="red-text">if</span>(<span class="blue-text">isset</span>($_SESSION[<span class="yellow-text">'auth'</span>])) { <br>
				<span style="margin-left:75px;" class="grey-text">// ROTAS COM AUTENTICAÇÃO</span><br>
				<span style="margin-left:75px;" class="orange-text">$this</span>->allowed <span class="red-text">=</span> <span class="purple-text">true</span>; <br>
				<span style="margin-left:50px;">}</span>
				<br>
				<br>
				<span style="margin-left:25px;">}
				</span><br>
				}<br>
			</div>
			<div class="card-action white">
				Diretório padrão: /routes
			</div>
		</div>
	</div>
</div>

<blockquote class="white">
	<h5 class="header"><span class="cyan-text">#</span> Exemplo de Rota</h5>
</blockquote>

<p class="flow-text text"> Para definir uma rota executamos um dos dois método disponiveis, passando obrigatóriamente três parâmetros.</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="orange-text">$this</span>->routes[] <span class="red-text">=</span> <span class="blue-text">Routes</span>::<span class="blue-text">get</span>(<span class="yellow-text">'documentacao'</span>, <span class="yellow-text">'WelcomeController@index',</span> <span class="yellow-text">'welcome_index'</span>);
			</div>
			<div class="card-action white">
				Atribuir dentro da construtura da classe, __construct() { }
			</div>
		</div>
	</div>
</div>

<table class="responsive-table highlight">
 	<thead>
 		<tr>
 			<th>Parametro</th>
 			<th>Descrição</th>
 			<th>Exemplo</th>
 		</tr>
 	</thead>
    <tbody>
    	<tr>
    		<td>1º</td>
            <td>Define qual url executa a rota</td>
            <td>'documentacao'</td>
        </tr>
        <tr>
    		<td>2º</td>
            <td>Define a controladora (antes do @) e o método (depois do @) que deve ser excecutado</td>
            <td>'WelcomeController@index'</td>
        </tr>
        <tr>
    		<td>3º</td>
            <td>Define um nome para a rota</td>
            <td>'welcome.index'</td>
        </tr>
        <tr>
    		<td>4º</td>
            <td>(Opcional) Utilizado em conjunto com a classe Auth() possibilita a autenticação de acesso a rota por um id</td>
            <td>int</td>
        </tr>
    </tbody>
</table>
<br>

<p class="flow-text text"> Para criar uma rota validada pela classe <strong class="green-text">Auth</strong> basta fazer uma validação do tipo <i>if</i> verificando se a <i>$_SESSION['auth']</i> esta criada, desta forma estas rotas só serão definidas quando o usuário estver autenticado. <br>
Também é possivel a criação de rotas do tipo ACL passando um 4º parametro na deinição da rota, que ira utilizar do metodo <strong class="blue-text">acl()</strong> da classe <strong class="green-text">Auth</strong> (mais informações sobre a classe visite a <a href="../auth">documentação da classe</a>), para validar se o usuário possui acesso a determinada página mesmo logado.</p>

<blockquote class="white">
	<h5 class="header"><span class="cyan-text">#</span> Exemplo de Rotas Autenticadas</h5>
</blockquote>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="blue-text">session_start</span>();<br>
				<span class="red-text">if</span>(<span class="blue-text">isset</span>($_SESSION[<span class="yellow-text">'auth'</span>])) { <br>
				<span style="margin-left:50px;" class="orange-text">$this</span>->routes[] <span class="red-text">=</span> <span class="blue-text">Routes</span>::<span class="blue-text">get</span>(<span class="yellow-text">'documentacao'</span>, <span class="yellow-text">'WelcomeController@index',</span> <span class="yellow-text">'welcome_index'</span>);
				<br>
				}
			</div>
			<div class="card-action white">
				Esta rota só é definida quando uma sessão esta criada (um usuário esta logado).
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="blue-text">session_start</span>();<br>
				<span class="red-text">if</span>(<span class="blue-text">isset</span>($_SESSION[<span class="yellow-text">'auth'</span>])) { <br>
				<span style="margin-left:50px;" class="orange-text">$this</span>->routes[] <span class="red-text">=</span> <span class="blue-text">Routes</span>::<span class="blue-text">get</span>(<span class="yellow-text">'documentacao'</span>, <span class="yellow-text">'WelcomeController@index',</span> <span class="yellow-text">'welcome_index'</span>, <span class="purple-text">1</span>);
				<br>
				}
			</div>
			<div class="card-action white">
				Esta rota só é definida quando uma sessão esta criada (um usuário esta logado) e ó é acessavel para usuários que possuirem o acesso de valor 1 em seu ACL.
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="blue-text">session_start</span>();<br>
				<span class="red-text">if</span>(<span class="blue-text">isset</span>($_SESSION[<span class="yellow-text">'auth'</span>])) { <br>
				<span style="margin-left:50px;" class="orange-text">$this</span>->routes[] <span class="red-text">=</span> <span class="blue-text">Routes</span>::<span class="blue-text">get</span>(<span class="yellow-text">'documentacao'</span>, <span class="yellow-text">'WelcomeController@index',</span> <span class="yellow-text">'welcome_index'</span>, $_SESSION[<span class="yellow-text">'auth'</span>]-><span class="blue-text">isAdmin</span>() ? <span class="yellow-text">' '</span> : <span class="purple-text">1</span>);
				<br>
				}
			</div>
			<div class="card-action white">
				Esta rota só é definida quando uma sessão esta criada (um usuário esta logado) e só é acessavel para usuários que possuirem o acesso de valor 1 em seu ACL caso não seja um administrador.
			</div>
		</div>
	</div>
</div>


<blockquote class="white">
	<h5 class="header"><span class="cyan-text">#</span> Passando parâmetros as rotas</h5>
</blockquote>

<p class="flow-text text"> Para passarmos algum parametro as rotas get() devemos adcionar a url da rota a variavel que recebera o parametro com o comando /[:parametro].</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="orange-text">$this</span>->routes[] <span class="red-text">=</span> <span class="blue-text">Routes</span>::<span class="blue-text">get</span>(<span class="yellow-text">'usuario/edit/[i:id]'</span>, <span class="yellow-text">'UsuarioController@edit',</span> <span class="yellow-text">'usuario_edit'</span>);
				<br>
				<span class="orange-text">$this</span>->routes[] <span class="red-text">=</span> <span class="blue-text">Routes</span>::<span class="blue-text">get</span>(<span class="yellow-text">'musicas/edit/[:autor]/[i:id]'</span>, <span class="yellow-text">'MusicaController@edit',</span> <span class="yellow-text">'musica_edit'</span>);
			</div>
			<div class="card-action white">
				É possivel passar quantos parâmetros forem necessários sempre informando um nome diferente para cada parâmetro. 
			</div>
		</div>
	</div>
</div>

<p class="flow-text text"> Dentro da controller podemos resgatar os valores passando como parametro da rota uma variavel que ira receber todos os parametros enviados pelo get, da seguinte forma.</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">public</span> <span class="blue-text">function</span> <span class="green-text">edit</span>(<span class="orange-text">$request</span>) <br>
				{ <br>
					<span class="blue-text" style="margin-left:25px;">print_r</span>($request[<span class="yellow-text">'autor'</span>]); <br>
					<span class="blue-text" style="margin-left:25px;">print_r</span>($request[<span class="yellow-text">'id'</span>]); <br>
				}
			</div>
			<div class="card-action white">
				Atribuir os parâmetros da url a variavel passada como parametro da função.
			</div>
		</div>
	</div>
</div>

<table class="responsive-table highlight">
 	<thead>
 		<tr>
 			<th width="20%">Rota</th>
 			<th width="60%">Match</th>
 			<th width="20%">Variaveis</th>
 		</tr>
 	</thead>
    <tbody>
    	<tr>
    		<td>/musicas</td>
            <td>/musicas</td>
            <td></td>
        </tr>
        <tr>
    		<td>/musicas/[:autor]</td>
            <td>/musicas/22</td>
            <td>$autor = 22</td>
        </tr>
        <tr>
    		<td>/musicas/[:autor]/[i:id]</td>
            <td>/musicas/michael-jackson/5</td>
            <td>$autor = michael-jackson <br> $id = 5</td>
        </tr>
    </tbody>
</table>
<br>

<blockquote class="white">
	<h5 class="header"><span class="cyan-text">#</span> Configuração de parametros</h5>
</blockquote>

<p class="flow-text text"> O AltoRouter possui padrões de "Match Types" disponiveis que o framework manteve sem modificação, apenas seguindo as informações a seguir.</p>

<table class="responsive-table highlight">
 	<thead>
 		<tr>
 			<th width="20%">Parâmetro</th>
 			<th width="60%">"Match" Esperado</th>
 			<th width="60%">Configuração</th>
 		</tr>
 	</thead>
    <tbody>
    	<tr>
    		<td>[i]</td>
    		<td>Um valor inteiro</td>
    		<td>'[0-9]++'</td>
    	</tr>
    	<tr>
    		<td>[i:id]</td>
    		<td>Um valor inteiro 'as' id</td>
    		<td>'[0-9]++'</td>
    	</tr>
    	<tr>
    		<td>[a:acao]</td>
    		<td>Um valor de caracteres alfanuméricos 'as' acao</td>
    		<td>'[0-9A-Za-z]++'</td>
    	</tr>
    	<tr>
    		<td>[h:key]</td>
    		<td>Um valor de caracteres hexadecimais 'as' key</td>
    		<td>'[0-9A-Fa-f]++'</td>
    	</tr>
    	<tr>
    		<td>[:acao]</td>
    		<td>Qualquer valor até a próxima / ou o fim da URI 'as' acao</td>
    		<td>'[^/\.]++'</td>
    	</tr>
    	<tr>
    		<td>[*]</td>
    		<td>Pega tudo, parando na próxima / </td>
    		<td>'.+?'</td>
    	</tr>
    	<tr>
    		<td>[*:lazy]</td>
    		<td>Pega tudo, parando na próxima / 'as' lazy</td>
    		<td>'.+?'</td>
    	</tr>
    	<tr>
    		<td>.[:format]?</td>
    		<td>Um parâmetro opcional 'as' format, uma / ou . antes do bloco também é opiconal</td>
    		<td>'[^/\.]++'</td>
    	</tr>
    </tbody>
</table>
<br>
</div>
<?php include('../layout/footer.php');?>