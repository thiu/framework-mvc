<?php include('../layout/header.php');?>

<div class="container">
<p class="fonte center">Auth</p>

<p class="flow-text text">A classe <strong class="green-text">Auth</strong> pertencente ao <strong class="brown-text">Src</strong> do frameworw, facilita na criação de sistemas de autenticação, os metodos dessa classe já estão disponiveis em todas controllers que extenderem a classe <strong class="green-text">Controller</strong>. Dentro da pasta das controllers esta disponivel um exemplo básico de como utilizar a classe <strong class="green-text">Auth</strong> em um projeto.</p>

<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> Class AuthController</h5>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">namespace</span> <span class="green-text">App\Http\Controllers</span>;
				<br>
				<br>
				<span class="red-text">use</span> Src\<span class="blue-text">Controller</span>;
				<br>
				<span class="red-text">use</span> Src\<span class="blue-text">Auth</span>;
				<br>
				<br>
				<span class="blue-text">class</span> <span class="green-text">AuthController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span>
				<br>
				{
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function </span><span class="green-text">index</span> () {
				<br>
				<span style="margin-left:50px;">
				<span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">view</span>(<span class="yellow-text">'login.index'</span>);	
				</span>
				<br>
				<span style="margin-left:25px;">}
				</span>
				<br><br>
				<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function </span><span class="green-text">entrar</span> () {
				<br>
				<span style="margin-left:50px;">(</span><span class="red-text">new</span> <span class="blue-text">Auth</span>)-><span class="blue-text">login</span>(<span class="yellow-text">'App\Model\Usuario'</span>, $_POST)-><span class="blue-text">acl</span>(<span class="yellow-text">'App\Model\Acesso'</span>);<br>
				<span style="margin-left:50px;"><span class="red-text">if</span>($_SESSION[<span class="yellow-text">'auth'</span>]) {<br>
					<span style="margin-left:75px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">redirect</span>(<span class="yellow-text">'musicos'</span>);<br>
				<span style="margin-left:50px;">} <span class="red-text">else</span> {<br>
					<span style="margin-left:75px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">redirect</span>(<span class="yellow-text">'home'</span>);<br>
				<span style="margin-left:50px;">}
				<br><span style="margin-left:25px;">}
				</span><br>
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function </span><span class="green-text">sair</span> () { <br>
				<span class="blue-text" style="margin-left:50px;">session_destroy</span>();<br>
				<span class="red-text" style="margin-left:50px;">return</span> <span class="orange-text">$this</span>-><span class="blue-text">redirect</span>(<span class="yellow-text">'home'</span>);<br>
				<span style="margin-left:25px;">}</span>
				<br>
				}<br>
			</div>
			<div class="card-action white">
				Exemplo de uma controller de autenticação
			</div>
		</div>
	</div>
</div>

<p class="flow-text text">Para iniciarmos a execução de um login utilizando a classe <strong class="green-text">Auth</strong> devemos chamar o seu método <strong class="blue-text">login()</strong>, passando até 4 parametros, sendo os dois primeiros obrgatórios e os dois útilmos opcionais. <br>
No primeiro parametro deve ser passado o namespace da classe de usuários de seu sistema, no segundo parametro o $_POST do formulário, o teceiro e quarto parametros são opcionais, o primeiro define o campo de <i>user</i> e o quarto o campo <i>password</i>, por padrão o framework utiliza <i>'email'</i> como usuário e <i>'password'</i> como senha, se esses dois parametros não forem definidos o framework ira utilizar este padrão.</p>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Métodos padrões da Auth</h5>

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
    		<td>login(namespace, $_POST, string?, string?)</td>
            <td>1 - namespace - Namespace da classe que efetua o login.
            <br>2 - $_POST do formulário de login com os campos de usuário e senha.
            <br>3 - (Opcional) Campo para utilizar na validação de usuário.
            <br>4 - (Opcional) Campo para utilizar na validação de senha.
            </td>
            <td>Efetua a tentativa de login com a classe e os dados forneceidos.</td>
            <td> login('App\Model\Usuario', $_POST, 'usuario', 'senha') </td>
        </tr>
        <tr>
    		<td>acl(namespace, string?, string?, string?)</td>
            <td>1 - namespace - Namespace da classe que possui a lista de acessos
            <br>2 - (Opcional) - Campo para definir a tabela pivot que possui a lista de acessos (Se não fornecido o framework utilizara o seu padrão).
            <br>3 - (Opcional) - Campo de identificação dos acessos da tabela pivot (Se não fornecido o framework utilizara o seu padrão).
            <br>4 - (Opcional) - Campo de identificação do usuário da tabela pivot (Se não fornecido o framework utilizara o seu padrão).</td>
            <td>Retorna uma Lista de Controle de Acessos (ACL) do usuário.</td>
            <td>acl('App\Model\Acessos', 'acesso_usuario', 'acesso_id', 'usuario_id');</td>
        </tr>
        <tr>
    		<td>isAdmin(string?)</td>
            <td>1 - (Opcional) - Campo para validar se o usuário é admin.</td>
            <td>Retorna um boolean de verdadeiro ou falso, utilizando o campo fornecido como parametro e valores 1 ou 0.<br>
            Caso não fornecido o valor do campo o framework utilizara o padrão <i>'admin'</i>.</td>
            <td>isAdmin('admin');</td>
        </tr>
        <tr>
    		<td>idAuth()</td>
            <td><i>null</i></td>
            <td>Retorna o id do usuário logado no momento</td>
            <td>idAuth();</td>
        </tr>
        <tr>
    		<td>can(int)</td>
            <td>1 - INT com o valor a procurar na ACL</td>
            <td>Retorna um boolean de verdadeiro ou falso, utilizando o INT fornecido como parametro para verificar se o usuário possui o ACL indicado.</td>
            <td>idAuth();</td>
        </tr>
    </tbody>
</table>
<br>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método isAdmin()</h5>

<p class="flow-text text">Este método serve para verificar se um usuário possui privilégios administrativos no sistema. <br>
Quando não fornecido nenhum parametro o método procura pelo campo 'admin' na sessão de usuário, se for necessário a utilização de outro campo basta fornecer ele como parametro em formato de string.</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				$_SESSION[<span class="yellow-text">'auth'</span>]-><span class="blue-text">isAdmin</span>();
				<br>
				$_SESSION[<span class="yellow-text">'auth'</span>]-><span class="blue-text">isAdmin</span>(<span class="yellow-text">'master'</span>);
			</div>
			<div class="card-action white">
				Retorna verdadeiro ou falso quando o campo de admin (ou outro fornecido), for igual a 1.
			</div>
		</div>
	</div>
</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método idAuth()</h5>

<p class="flow-text text">Este método retorna o ID do usuário que esta autenticado, não sendo necessário nenhum parametro.</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				$id <span class="red-text">=</span> $_SESSION[<span class="yellow-text">'auth'</span>]-><span class="blue-text">idAuth</span>();
			</div>
			<div class="card-action white">
				Retorna o ID do usuário autenticado.
			</div>
		</div>
	</div>
</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método can()</h5>

<p class="flow-text text">Retorna um boolean de verdadeiro ou falso, utilizando o INT fornecido como parametro para verificar se o usuário possui o ACL indicado. <br>
Este método é utilizado em conjunto com o método <strong class="blue-text">acl()</strong> por isso só ira funcionar quando a sessão for criada utilizando o padrão do framework com o método acl() retorando uma lista de acessos da tabela pivot de acl.</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">if</span>($_SESSION[<span class="yellow-text">'auth'</span>]-><span class="blue-text">can</span>(<span class="purple-text">1</span>)) {<br>
				<span style="margin-left:50px;" class="blue-text">echo</span> <span class="yellow-text">'Usuário possui acesso ao ACL de ID 1'</span>;<br>
				}
			</div>
			<div class="card-action white">
				Retorna verdadeiro ou falso para uma valiadação de ACL.
			</div>
		</div>
	</div>
</div>


<?php include('../layout/footer.php');?>
