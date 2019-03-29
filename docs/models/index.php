<?php include('../layout/header.php');?>

<div class="container">
<p class="fonte center">Models</p>

<p class="flow-text text">Por padrão as models devem ser criadas dentro da pasta <strong class="brown-text">app/model</strong>, assim não é necessário nenhuma outra configuração para atualizar o autoload. Caso seja utilizado outro diretório passa a ser necessário a definição do caminho na variavel <em>"autoload":</em> do arquivo <em>composer.json</em> para que o diretório seja reconhecido ao atualizar o autoload.</p>
<p class="flow-text text">
Para utilização completa das funcionalidades do framework sua model deve ser definida conforme o exemplo da model <strong class="green-text">Welcome</strong>, extendendo a classe <strong class="green-text">Model</strong> que pertence ao <strong class="brown-text">src</strong> do framework</p>

<h5 class="header">
	<i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i>
	Class Welcome
</h5>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">namespace</span> <span class="green-text">App\Model</span>;
				<br>
				<span class="red-text">use</span> Src\<span class="blue-text">Model</span>;
				<br>
				<span class="blue-text">class</span> <span class="green-text">Welcome</span> <span class="red-text">extends</span> <span class="green-text">Model</span>
				<br>
				{
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> $table <span class="red-text">=</span> <span class="yellow-text">'table_name'</span>;
				<br>
				<span class="red-text" style="margin-left:25px;">public</span> $fillable <span class="red-text">=</span> [
				<br>
				<span style="margin-left:50px;">
					<span class="yellow-text">'field_1'</span>,
					<span class="yellow-text">'field_2'</span>,
					<span class="yellow-text">'field_etc'</span>
				</span>
				<br>
				<span style="margin-left:25px;">]</span>;
				<br>
				}<br>
			</div>
			<div class="card-action white">
				Diretório padrão: /app/model
			</div>
		</div>
	</div>
</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Variaveis base</h5>

<p class="flow-text text">Toda model que for fazer conexão com algum banco de dados devem definir as variaveis <em>$table</em> e <em>$fillable</em>.</p>

<table class="responsive-table highlight">
 	<thead>
 		<tr>
 			<th>Variavel</th>
 			<th>Tipo</th>
 			<th>Descrição</th>
 		</tr>
 	</thead>
    <tbody>
    	<tr>
    		<td>$table</td>
            <td>string</td>
            <td>Define em qual tabela vão ser executadas as querys da Model</td>
        </tr>
        <tr>
    		<td>$fillable</td>
            <td>array</td>
            <td>Define os campos padrões que são procurados ao executar alguma query</td>
        </tr>
    </tbody>
</table>
<br>

<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> Definindo relacionamento entre modelos</h5>

<p class="flow-text text">Para criar relacionamentos entre duas models, podemos usar os métodos herdados da classe <strong class="green-text">Model</strong> do <strong class="brown-text">src</strong> do framework, <strong class="blue-text">hasOne()</strong>, <strong class="blue-text">hasMany()</strong> e <strong class="blue-text">manyToMany()</strong></p>

<p class="flow-text text">O relacionamento deve ser definido nas duas models, ou seja, um relacionamento <em>1-N</em> da classe <strong class="green-text">Cliente</strong> com a classe <strong class="green-text">Empresa</strong> teria um método <strong class="blue-text">hasOne</strong> na <strong class="green-text">Cliente</strong> e o método <strong class="blue-text">hasMany</strong> na <strong class="green-text">Empresa</strong>.<br>
Isso serve para que você possa efetuar a consulta do relacionamento partindo de qualquer lado, porém não sendo obrigatório.</p>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> hasOne() e hasMany()</h5>

<p class="flow-text text">Ambos os métodos podem receber até 2 parametros, sendo o primeiro obrigatório, onde deve ser informado o namespace da model de relacionamento e o segundo opcional, que pode ser utilizado para informar qual a coluna que sera feito o relacionamento. Quando este parametro não é informado o framework utiliza o padrão de tabela (mais informações sobre o padrão de tabela visite a documentação de <a href="../banco">banco de dados</a>).</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="blue-text">class</span> <span class="green-text">Musico</span> <span class="red-text">extends</span> <span class="green-text">Model</span>
				<br>
				{<br>
				<span style="margin-left:25px;"><span class="red-text">public</span> <span class="blue-text">function</span> <span class="green-text">gravadora</span>()</span> <br>
				<span style="margin-left:25px;">{</span> <br>
				<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">hasOne</span>(
				<span class="yellow-text">'App\Model\Gravadora'</span>);</span> <br>
				<span style="margin-left:25px;">}</span> <br>
				}
				<br><br>
				<span class="blue-text">class</span> <span class="green-text">Gravadora</span> <span class="red-text">extends</span> <span class="green-text">Model</span>
				<br>
				{<br>
				<span style="margin-left:25px;"><span class="red-text">public</span> <span class="blue-text">function</span> <span class="green-text">musicos</span>()</span> <br>
				<span style="margin-left:25px;">{</span> <br>
				<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">hasMany</span>(
				<span class="yellow-text">'App\Model\Musico'</span>, <span class="yellow-text">'idmusico'</span>);</span> <br>
				<span style="margin-left:25px;">}</span> <br>
				}
			</div>
			<div class="card-action white">
				Musico possui <i>'1'</i> Gravadora | Gravadora possui <i>'n'</i> Musicos.  
			</div>
		</div>
	</div>
</div>

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
    		<td>hasOne($namespace, $column?, $column?)</td>
    		<td>1 - Caminho da Model pelo Namespace.
			<br>2 - Coluna da tabela principal (se não informado é utilizado o padrão de tabelas do framework).
            <br>3 - Coluna da tabela relacional (se não informado é utilizado o padrão de tabelas do framework).
        	</td>
            <td>Define que a model possui <i>1</i> instância de outra model como relacionamento</td>
            <td>hasOne('App\Model\Gravadora');</td>
        </tr>
        <tr>
    		<td>hasMany($namespace, $column?)</td>
    		<td>1 - Caminho da Model pelo Namespace.
            <br>2 - Coluna da tabela principal (se não informado é utilizado o padrão de tabelas do framework).
        	</td>
            <td>Define que a model possui <i>n</i> instâncias de outra model como relacionamento</td>
            <td>hasOne('App\Model\Musicos' 'idmusico');</td>
        </tr>
    </tbody>
</table>
<br>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> manyToMany()</h5>

<p class="flow-text text">O relacionamento entre duas classes no modo muitos para muitos pode ser feito com a utilzação do método <strong class="blue-text">manyToMany()</strong>, este metodo pode receber até 4 parâmetros, porém apenas o primeiro é obrigatório. <br>
No primeiro parametro deve ser passado o namespace da classe a ser relacionada, os outros parametros são opcionais onde o segundo define a tabela relacional, o terceiro a coluna relacional e o ultimo a coluna da tabela de relacionamento da classe atual.</p>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="blue-text">class</span> <span class="green-text">Usuario</span> <span class="red-text">extends</span> <span class="green-text">Model</span>
				<br>
				{<br>
				<span style="margin-left:25px;"><span class="red-text">public</span> <span class="blue-text">function</span> <span class="green-text">acessos</span>()</span> <br>
				<span style="margin-left:25px;">{</span> <br>
				<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">manyToMany</span>(
				<span class="yellow-text">'App\Model\Acesso'</span>);</span> <br>
				<span style="margin-left:25px;">}</span> <br>
				}
				<br><br>
				<span class="blue-text">class</span> <span class="green-text">Usuarios</span> <span class="red-text">extends</span> <span class="green-text">Model</span>
				<br>
				{<br>
				<span style="margin-left:25px;"><span class="red-text">public</span> <span class="blue-text">function</span> <span class="green-text">acessos</span>()</span> <br>
				<span style="margin-left:25px;">{</span> <br>
				<span style="margin-left:50px;"><span class="red-text">return</span> <span class="orange-text">$this</span>-><span class="blue-text">manyToMany</span>(
				<span class="yellow-text">'App\Model\Acesso'</span>, <span class="yellow-text">'tb_acessos'</span>, <span class="yellow-text">'id_acessos'</span>, <span class="yellow-text">'id_usuario'</span>);</span> <br>
				<span style="margin-left:25px;">}</span> <br>
				}
			</div>
			<div class="card-action white">
				Um usuário possui diversos <i>n</i> e um acesso possui <i>n</i> usuários.
			</div>
		</div>
	</div>
</div>

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
    		<td>manyToMany($namespace, $table?, $relColumn?, $classColumn)</td>
    		<td>1 - Caminho da Model pelo Namespace.
			<br>2 - Tabela do relacionamento.
            <br>3 - Coluna da tabela relacional.
            <br>4 - Coluna da tabela da classe atual.
        	</td>
            <td>Define que a model possui <i>n</i> instância de outra model como relacionamento, e esta outra instãncia também possui <i>n</i> instâncias dessa model.</td>
            <td>hasManyToMany('App\Model\Acesso');</td>
        </tr>
    </tbody>
</table>
<br>

</div>

<?php include('../layout/footer.php');?>
