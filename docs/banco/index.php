<?php include('../layout/header.php');?>

<div class="container">

	<p class="fonte center">Banco de Dados</p>

	<p class="flow-text text">O Framework possui diversos métodos padrões para efetuar ações no banco de dados de forma simples e algumas vezes até mesmo em uma unica linha de código.
	<br>Para o perfeito funcionamento destes métodos, mesmo não sendo obrigatório, é aconselhavel seguir um padrão de tabelas para seu banco de dados, em especial aos campos de identificação da tabela e de status do registro, criando-os com os padrões mais utilizados mundialmente.</p>

	<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> Exemplo de tabela</h5>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="card-content">
					<table class="responsive-table highlight">
					<thead>
					<tr>
						<th>Campo</th>
						<th>Tipo</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>id</td>
						<td class="blue-text">int</td>
					</tr>
					<tr>
						<td>gravora_id</td>
						<td class="blue-text">int</td>
					</tr>
					<tr>
						<td>nome</td>
						<td class="green-text">varchar(50)</td>
					</tr>
					<tr>
						<td>created_at</td>
						<td class="brown-text">timestamp</td>
					</tr>
					<tr>
						<td>updated_at</td>
						<td class="brown-text">timestamp</td>
					</tr>
					<tr>
						<td>deleted_at</td>
						<td class="brown-text">timestamp</td>
					</tr>
					</tbody>
					</table>
				</div>
				<div class="card-action white">
					Padrão de nomeclatura das tabelas
				</div>
			</div>
		</div>
	</div>

	<p class="flow-text text">Todas tabelas devem possuir os campos <em>created_at</em>, <em>updated_at</em> e <em>deleted_at</em> se forem utilizar dos métodos de banco de dados do framework.
	<br>Prefernecialmente os campos de relacionamento podem ser nomeados conforme o exemplo com o nome da tabela relacionada no singular seguido pelo sufixo <em>_id</em>, assim não é necessário informar qual campo um relacionamento ira utilizar.

	<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> Métodos da Classe DB</h5>

	<p class="flow-text text">Toda model que definimos dentro dos padrões do framework possuem acesso aos métodos da classe <strong class="green-text">DB</strong>, que pertence ao <strong class="brown-text">src</strong> do framework, assim sendo possivel executar querys no banco de dados de forma simplificada e em poucas linhas.</p>

	<table class="responsive-table highlight">
	 	<thead>
	 		<tr>
	 			<th>Método</th>
	 			<th>Descrição</th>
	 			<th>Exemplo</th>
	 		</tr>
	 	</thead>
	    <tbody>    	
	    	<tr>
	    		<td>get()</td>
	    		<td>Executa a query montada e retorna uma coleção de objetos.</td>
	    		<td>(new Musico)->select(['id','nome'])->get();</td>
	    	</tr>
	    	<tr>
	    		<td>select(array?)</td>
	    		<td>Seleciona as colunas de execução da query. (Quando enviado sem parametros assume *)</td>
	    		<td>[...]->select(['id', 'nome'])</td>
	        </tr>
	        <tr>
	    		<td>where($param, $operand, $value)</td>
	    		<td>Adiciona um "WHERE" na query, com final AND</td>
	    		<td>[...]->where('nome', '=', 'Michael Jackson')</td>
	    	</tr>
	    	<tr>
	    		<td>orWhere($param, $operand, $value)</td>
	    		<td>Adiciona um "WHERE" na query, com final OR</td>
	    		<td>[...]->orWhere('nome', '=', 'Elvis Presley')</td>
	    	</tr>
	    	<tr>
	    		<td>comboWhere(array(array($param, $operand, $value, $ext?)))</td>
	    		<td>Adiciona um "WHERE" na query com 2 ou mais valores dentro de () com final AND
	    		<br>O conector de cada condição é definido em cada array, sendo que a ultima condição não define conector.</td>
	    		<td>[...]->comboWhere([ ['nome', '=' , 'Michal Jackson', 'OR'], ['nome', '=', 'Elvis Presley'] ])</td>
	    	</tr>
	    	<tr>
	    		<td>comboOrWhere(array(array($param, $operand, $value, $ext?)</td>
	    		<td>Executa um "WHERE" na query com 2 ou mais valores dentro de () com final OR
	    		<br>O conector de cada condição é definido em cada array, sendo que a ultima condição não define conector.</td>
	    		<td>[...]->comboOrWhere([ ['nome', '=' , 'Michal Jackson', 'AND'], ['id', '=', 2] ])</td>
	    	</tr>
	    	<tr>
	    		<td>with(method(), array?)</td>
	    		<td>Esté metodo chama um relacionamento definido na model pelos métodos hasMany(),  hasOne() e manyToMany(), passando como parametro o nome do metodo de relacionamento da model e opcionalmente um array com os campos que deseja selecionar no relacionamento. </td>
	    		<td>[...]->with('gravadoras')<br>
	    		[...]->with('gravadoras', ['id', 'nome'])<br>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>period($string, $string)</td>
	    		<td>Esté metodo criar um WHERE na query com inicio e fim no periodo de mês e ano informado, o método funciona melhor ao utilizar como campo de texto o tipo "month" do HTML5, porém também pode ser utilizado com uma string no formato 'AAAA-MM'.</td>
	    		<td>[...]->period('created_at', '2018-08')<br>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>when(condition, array)</td>
	    		<td>Esté metodo faz uma validação e em caso de verdadeiro executa um where() com os dados informados no array do segundo parametro. </td>
	    		<td>[...]->when(!empty('ativo'), ['ativo', '=', 'sim'])<br>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>whenPeriod(condition, array)</td>
	    		<td>Esté metodo faz uma validação e em caso de verdadeiro executa um period() com os dados informados no array do segundo parametro. </td>
	    		<td>[...]->when(!empty('ativo'), ['created_at', '2018-08'])<br>
	    		</td>
	    	</tr>		
	    	<tr>
	    		<td>find(int)</td>
	    		<td>Retorna os campos e registros da variavel $fillable da model, junto com o ID pertencente ao ID passado</td>
	    		<td>(new Musico)->find(1);</td>
	    	</tr>
	    	<tr>
	    		<td>box(string)</td>
	    		<td>Retorna apenas os campos passados na string registros em forma de um array de objetos</td>
	    		<td>(new Musico)->box('id, nome');</td>
	    	</tr>
	    	<tr>
	    		<td>all()</td>
	    		<td>Retorna um array de registros no formato de objeto com todos os campos da tabela</td>
	    		<td>(new Musico)->all();</td>
	    	</tr>
	    	<tr>
	    		<td>create(array)</td>
	    		<td>Insere um registro no banco, utilizando a $fillable da model para saber quais campos devem sofrer alterações.</td>
	    		<td>(new Musico)->create($_POST);</td>
	    	</tr>
	    	<tr>
	    		<td>update(array)</td>
	    		<td>Atualiza um registro no banco, utilizando a $fillable da model para saber quais campos devem sofrer alterações.</td>
	    		<td>(new Musico)->update($_POST);</td>
	    	</tr>
	    	<tr>
	    		<td>delete(int)</td>
	    		<td>"Deleta" um registro do banco de dados pelo seu id, definindo o campo deleted_at para o timestamp do horario de execução.
    			<br>(Desta forma o registro não é deletado do banco, sendo apenas ocultado das exibições)</td>
	    		<td>(new Musico)->delete(1);</td>
	    	</tr>
	    	<tr>
	    		<td>sync(namespace)</td>
	    		<td>Facilita a atualização de tabelas pivot de relacionamentos n-n</td>
	    		<td>(new Usuario)->sync('App\Model\Acesso')->create($_POST);</td>
	    	</tr>
	    	<tr>
	    		<td>password(array, string?)</td>
	    		<td>Usado para criptografar e salvar no banco quando campos do tipo password, já validando se o password foi digitado ou não em caso de updates.</td>
	    		<td>(new Usuario)->sync('App\Model\Acesso')->passowrd($_POST)->update($_POST);</td>
	    	</tr>
	    	<tr>
	    		<td>whereIn(string, array)</td>
	    		<td>Adiciona uma clausula WHERE IN a query com final AND.</td>
	    		<td>[...]->whereIn('id', [1, 2, 3])</td>
	    	</tr>
	    	<tr>
	    		<td>orWhereIn(string, array)</td>
	    		<td>Adiciona uma clausula WHERE IN a query com final OR.</td>
	    		<td>[...]->orWhereIn('id', [1, 2, 3])</td>
	    	</tr>
	    	<tr>
	    		<td>orderBy(array['campo'=>'classificacao'])</td>
	    		<td>Ordena um resultado de uma query</td>
	    		<td>[...]->orderBy(['created_at'=>'DESC', 'nome'=>'ASC'])</td>
	    	</tr>
	    	<tr>
	    		<td>limit(int)</td>
	    		<td>Limita o número de resultados de uma query</td>
	    		<td>[...]->limit(5)</td>
	    	</tr>
	    	<tr>
	    		<td>values()</td>
	    		<td>Retorna apenas os os valores da classe no resultado.</td>
	    		<td>values()</td>
	    	</tr>
	    	<tr>
	    		<td>queryBuilder(string, string?)</td>
	    		<td>Monta uma query manualmente</td>
	    		<td>(new Musico)->queryBuilder('SELECT * FROM musicos WHERE id =? OR id = ?', '1,2')</td>
	    	</tr>
	    	<tr>
	    		<td>getQuery()</td>
	    		<td>Executa a query montada no queryBuilder e retorna um array de registros no formato de objeto</td>
	    		<td>(new Musico)->queryBuilder('SELECT * FROM musicos WHERE id =? OR id = ?', '1,2')->getQuery()</td>
	    	</tr>
	    	<tr>
	    		<td>runQuery()</td>
	    		<td>Executa a query montada no queryBuilder sem retorno.</td>
	    		<td>(new Musico)->queryBuilder('SELECT * FROM musicos WHERE id =? OR id = ?', '1,2')->runQuery()</td>
	    	</tr>
	    </tbody>
	</table>
	<br>

	<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> Efetuando Querys</h5>

	<p class="flow-text text">Para criar e executar uma query podemos combinar diversos métodos da classe <strong class="green-text">DB</strong> até conseguir o resultado desejado, ao final executando o método <strong class="blue-text">get()</strong></p>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método get()</h5>

	<p class="flow-text text">Este método deve ser executado ao final de algumas instruções, ele funciona como um fechamento das instruções definidas e a execução de todos os métodos definidos. 
	<br> Ele não recebe nenhum parametro e deve sempre ser o ultimo método da linha de código quando ele for necessário
	</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					<span class="blue-text">class</span> <span class="green-text">MusicoController</span> <span class="red-text">extends</span> <span class="green-text">Controller</span><br>
					{<br>
					<span class="red-text" style="margin-left:25px;">public</span> <span class="blue-text">function</span> <span class="green-text">index</span>() {<br>
					<span style="margin-left:50px;">$registros</span> <span class="red-text"> = </span> (<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>, <span class="yellow-text">'contrato'</span>])
					<br>
					<span style="margin-left:50px;">-><span class="blue-text">where</span>(<span class="yellow-text">'contrato'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'ativo'</span>)
					<br>
					<span style="margin-left:50px;">-><span class="blue-text">with</span>(<span class="yellow-text">'gravadoras'</span>)
					<br>
					<span style="margin-left:50px;">-><span class="blue-text">get</span>();<br>
					<span style="margin-left:25px;">}</span><br>
					}
				</div>
				<div class="card-action white">
					Passa para a variavel registros todos os valores onde contrato for igual a ativo na tabela da model Musico.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Métodos select() e where()</h5>

	<p class="flow-text text">Abaixo temos o exemplo de query de seleção (<strong class="red-text">SELECT</strong>) básica, para pegarmos <em>"id, nome e contrato"</em> dos musicos onde (<strong class="red-text">WHERE</strong>)  contrato é igual a ativo.</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					</span> (<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>, <span class="yellow-text">'contrato'</span>])-><span class="blue-text">where</span>(<span class="yellow-text">'contrato'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'ativo'</span>)-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Passa para a variavel registros todos os valores onde contrato for igual a ativo na tabela da model Musico.
				</div>
			</div>
		</div>
	</div>

	<p class="flow-text text">Após criarmos a instancia da classe, passamos primeiro o método <strong class="blue-text">select()</strong> para escolher quais campos queremos consultar, no exemplo pegamos os campos <em>id, nome e contrato</em>. Em seguida utilizamos o método <strong class="blue-text">where()</strong> para filtrarmos os resultados, no exemplo filtramos apenas os resultados onde <em>contrato = ativo</em>. Por final utilizamos o método <strong class="blue-text">get()</strong> para executar a query e nos retornar o resultado para nossa variavel.</p>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Utilizando variaveis do método where() </h5>

	<p class="flow-text text">Quando queremos criar uma query com mais de uma condição podemos utilizar o <strong class="blue-text">where()</strong> quantas vezes forém necessárias, porém este método sempre adiciona o conector AND. <br>
	Exemplo: 'contrato = 'ativo' <strong class="red-text">AND</strong> estilo = 'rock'
	<br>Para criarmos querys mais elaboradas podemos utilizar as 'variantes' deste método: <strong class="blue-text">orWhere()</strong>, <strong class="blue-text">comboWhere()</strong> e <strong class="blue-text">comboOrWhere()</strong>, criando combinações de metodos para montarmos a query que queremos.</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])-><span class="blue-text">where</span>(<span class="yellow-text">'id'</span>, <span class="yellow-text">'='</span>, <span class="purple-text">1</span>)-><span class="blue-text">orWhere</span>(<span class="yellow-text">'nome'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'Elvis Presley'</span>)-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					SELECT musicos.id,musicos.nome FROM musicos WHERE id = :id1 OR nome = :nome1 AND  musicos.deleted_at IS :deleted_at ORDER BY id ASC
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])-><span class="blue-text">comboOrWhere</span>([ [<span class="yellow-text">'nome'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'Michael Jackson'</span>, <span class="yellow-text">'AND'</span>], [<span class="yellow-text">'id'</span>, <span class="yellow-text">'='</span>, <span class="purple-text">2</span>] ])-><span class="blue-text">comboWhere</span>([ [<span class="yellow-text">'nome'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'Elvis Presley'</span>, <span class="yellow-text">'AND'</span>], [<span class="yellow-text">'id'</span>, <span class="yellow-text">'='</span>, <span class="purple-text">1</span>] ])-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					SELECT musicos.id,musicos.nome FROM musicos  WHERE ( nome = :nome1 AND id = :id1  ) OR  ( nome = :nome2 AND id = :id2  ) AND   musicos.deleted_at IS :deleted_at ORDER BY id ASC
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método with() </h5>

	<p class="flow-text text">Para criar um relacionamneto entre modelos, podemos utilizar o método <strong class="blue-text">with()</strong>, passando como parametro o nome do metodo definido na model e opcionalmente o campo em que deve ser efetuado a comparação para o relacionamento. 

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])-><span class="blue-text">with</span>(<span class="yellow-text">'gravadoras'</span>)
								  -><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Equivalente a "SELECT musicos.id, musicos.nome, gravadoras.* FROM musicos JOIN gravadoras ON gravadoras.id = musicos.gravadora_id;"
				</div>
			</div>
		</div>
	</div>

	<p class="flow-text text">É possivel criar diversos relacionamentos em uma unica execução adicionando quantos <strong class="blue-text">with()</strong> forem necessários. <br>
	Para escolher qual coluna deve ser selecionada, como segundo parametro deve ser passado um array com o nome dessas colunas.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])-><span class="blue-text">with</span>(<span class="yellow-text">'gravadoras'</span>, [<span class="yellow-text">'id','nome']</span>)-><span class="blue-text">with</span>(<span class="yellow-text">'agentes'</span>, [<span class="yellow-text">'id','nome']</span>)-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Equivalente a "SELECT musicos.id, musicos.nome, gravadoras.id, gravoradas.nome, agentes.id, agentes.nome FROM musicos JOIN gravadoras ON gravadoras.id = musicos.gravadora_id JOIN agentes ON agentes.id = musicos.agente_id;"
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método period() </h5>

	<p class="flow-text text">Para criar uma query buscando por um determinado periodo de data é possivel realizar de forma simplificada com o método <strong class="blue-text">period()</strong>, passando como parametro o nome do campo e o ano e mês do periodo no formato padrão 'AAAA-MM', a utilização do campo de tipo "month" do HTML5 facilita este tipo de formulário.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])-><span class="blue-text">period</span>(<span class="yellow-text">'created_at'</span>,<span class="yellow-text">'2018-08'</span>)
								  -><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Seleciona todos os registros criados entre 01/08/2018 até 31/08/2018.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método when() e whenPeriod() </h5>

	<p class="flow-text text">Estes métodos são uteis para quando for necessário adicionar uma clausula <strong class="blue-text">where()</strong> ou <strong class="blue-text">period()</strong> apenas quando uma condição for verdadeira, ideal para criar formulários de filtros por exemplo. 

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])
					<br>-><span class="blue-text">with</span>(<span class="yellow-text">'gravadoras'</span>)
					<br>-><span class="blue-text">when</span>(<span class="red-text">!</span><span class="blue-text">empty</span>($_POST[<span class="yellow-text">'ativo'</span>]), [<span class="yellow-text">'ativo'</span>, <span class="yellow-text">'='</span>, $_POST[<span class="yellow-text">'ativo'</span>]])
					<br>-><span class="blue-text">get</span>();
					<br>
					<br>
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>, <span class="yellow-text">'nome'</span>])
					<br>-><span class="blue-text">with</span>(<span class="yellow-text">'gravadoras'</span>)
					<br>-><span class="blue-text">whenPeriod</span>(<span class="red-text">!</span><span class="blue-text">empty</span>($_POST[<span class="yellow-text">'data_criacao'</span>]), [<span class="yellow-text">'created_at'</span>, $_POST[<span class="yellow-text">'data_criacao'</span>]])
					<br>-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Quando $_POST['ativo'] não for vazio é adicionado um WHERE a query com as condições fornecidas no segundo parametro, no exemplo, onde ativo for igual ao valor passado no $_POST['ativo'].
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método find() </h5>

	<p class="flow-text text">Quando queremos selecionar um registro especifico de uma tabela e sabemos o seu id, podemos utilizar o método <strong class="blue-text">find()</strong> passando como parametro o id do registro. Apesar de podermos utilizar os outros métodos e montarmos a query com os métodos <strong class="blue-text">select()</strong> e <strong class="blue-text">get()</strong>, a utilização deste método deixa as coisas ainda mais faceis, porém este método retorna apenas os campos <strong>$fillables</strong> da model, sendo assim ideal para telas de edição de registro.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">find</span>(<span class="purple-text">1</span>);
				</div>
				<div class="card-action white">
					Equivalente a (new Musico)->select($fillables)->where('id', '=', 1)->get();
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método box() </h5>

	<p class="flow-text text">Este metodo serve para criar um array de objetos contendo apenas os registros de uma model, os campos selecionados devem ser passados no parametro do método <strong class="blue-text">box()</strong> em formato de string e separados por ',' (virgula). Este método facilita bastante para a criação de select box onde precisamos selecionar normalment apenas o ID e um campo de descrição de uma model.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">box</span>(<span class="yellow-text">'id, nome'</span>);
				</div>
				<div class="card-action white">
					Retorna um array de objetos da model contendo apenas as colunas passadas no parametro.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método all() </h5>

	<p class="flow-text text">Quando queremos selecionar todos os registros e campos de uma tabela, podemos utilizar o método <strong class="blue-text">all()</strong>, não sendo necessário passar nenhum parametro. 

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">all</span>();
				</div>
				<div class="card-action white">
					Retorna todos os campos e registros da tabela musicos
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método create() e update() </h5>

	<p class="flow-text text">A parte de criação e atualização de registros é executado pelos métodos <strong class="blue-text">create()</strong> e <strong class="blue-text">update()</strong>, onde ambos são chamados da mesma forma, sendo necessário apenas que seja passado como parametro o <strong>$_POST</strong> do formulário e que o campos do formulário possuam o mesmo nome dos campos definidos na variavel <strong>$fillable</strong> na model chamada e passando também o <strong>id</strong> do registro dentro do <strong>$_POST</strong> quando for executar o <strong class="blue-text">update()</strong>.
	<br>
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">create</span>($_POST);
					<br>
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">update</span>($_POST);
				</div>
				<div class="card-action white">
					Ações para criar ou editar um registro no banco de dados. 
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método delete() </h5>

	<p class="flow-text text">O método <strong class="blue-text">delete()</strong>, apesar do nome, não deleta o registro totalmente do banco, ele apenas atualiza o campo <strong>deleted_at</strong> com o dia e hora em que este metodo foi executado na model, assim o registro não ira mais aparecer em nenhum <strong class="blue-text">get()</strong>, sendo considerado como registro deletado, porém o registro ainda persiste no banco de dados, seguindo os padrões mais adequados de administração de banco de dados. <br>
	A execução deste método exige apenas que seja informado o <strong>id</strong> do registro a ser deletado.
	<br>
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">delete</span>($id);
				</div>
				<div class="card-action white">
					"Apaga" o registro de $id passado como padrametro do banco de dados.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método sync() </h5>

	<p class="flow-text text">O método <strong class="blue-text">sync()</strong>, facilita a atualização de tabelas pivot's de relacionamentos n-n. Sendo necessário apenas passar o namespace da classe relacionada. <br>
	Passando apenas a namespace o framework considera que a tabela esta formatada seguindo o padrão sugerido, utilizando o padrão internacional. <br>
	Quando necessário, é possivel passar como parametros o nome da tabela, do campo relacional e do campo da classe atual como segundo, terceiro e quarto parâmetro respectivamente.
	</p>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Usuario</span>)-><span class="blue-text">sync</span>(<span class="yellow-text">'App\Model\Acesso'</span>)-><span class="blue-text">update</span>($_POST);
				</div>
				<div class="card-action white">
					Atualiza um registro da tabela usuarios e junto atualiza a tabela pivot acesso_usuario
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Usuario</span>)-><span class="blue-text">sync</span>(<span class="yellow-text">'App\Model\Acesso'</span>, <span class="yellow-text">'tb_acessos'</span>, <span class="yellow-text">'idacesso'</span>, <span class="yellow-text">'idususario'</span>)-><span class="blue-text">update</span>($_POST);
				</div>
				<div class="card-action white">
					Atualiza um registro da tabela usuarios e junto atualiza a tabela pivot tb_acessos com os campos idacesso pertencente a classe Acesso e o campo idusuario pertencente a classe Usuario.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método password() </h5>

	<p class="flow-text text">O método <strong class="blue-text">password()</strong>, facilita a atualização de senhas criptogradas no banco de dados.<br>
	Quando o metodo é utilizado ele automaticamente verifica primeiro se um novo password foi digitado no formulário para então validar se precisa ou não ser atualizado, assim um formulário enviado com um campo do tipo password em branco não tera seu valor no banco atualizado para 'vazio'.<br>
	Este metodo recebe até 2 parametros, sendo o primeiro obrigatório onde deve ser enviado o $_POST do formulário e segundo opcional, onde deve ser informado o campo utilizado para senhas na tabela, em caso de seguir o padrão (password), não é necessário fornecer o segundo parametro. 
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Usuario</span>)-><span class="blue-text">password</span>->($_POST)-><span class="blue-text">update</span></span>($_POST);
				</div>
				<div class="card-action white">
					Atualiza um registro de usuário, verificando automaticamnete se é necessário atualizar a senha e criptografando quando necessario atualizar, utilizando o campo padrão de senhas com o nome password
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					(<span class="red-text">new</span> <span class="blue-text">Usuario</span>)-><span class="blue-text">password</span>->($_POST)-><span class="blue-text">update</span></span>($_POST, <span class="yellow-text">'senha'</span>);
				</div>
				<div class="card-action white">
					Atualiza um registro de usuário, verificando automaticamnete se é necessário atualizar a senha e criptografando quando necessario atualizar, utilizando o campo de nome 'senha' fornecido no segundo parâmetro.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Métodos whereIn() e orWhereIn() </h5>

	<p class="flow-text text">O métodos <strong class="blue-text">whereIn()</strong> e <strong class="blue-text">orWhereIn()</strong>, adicionam a query um WHERE IN com os valores fornecidos no segundo parametros em forma de array.<br>
	O primeiro parâmetro define em qual coluna o WHERE IN sera aplicado, e o segundo parâmetro deve sepre ser enviado em forma de array. 
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					$editoras_ids <span class="red-text">=</span> [<span class="purple-text">1</span>, <span class="purple-text">2</span>, <span class="purple-text">3</span>];
					<br>
					$musicas <span class="red-text">=</span> (<span class="red-text">new</span> <span class="blue-text">Musica</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>])-><span class="blue-text">whereIn</span>(<span class="yellow-text">'editora_id'</span>, $editoras_ids)-><span class="blue-text">where</span>(<span class="yellow-text">'compositor'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'Bob Dylan'</span>)-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Retorna os ID de musicas que contenham como editora as editoras com ID 1, 2 ou 3 e (<i>AND</i>) o compositor for igual a Bob Dylan.
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					$editoras_ids <span class="red-text">=</span> [<span class="purple-text">1</span>, <span class="purple-text">2</span>, <span class="purple-text">3</span>];
					<br>
					$musicas <span class="red-text">=</span> (<span class="red-text">new</span> <span class="blue-text">Musica</span>)-><span class="blue-text">select</span>([<span class="yellow-text">'id'</span>])-><span class="blue-text">orWhereIn</span>(<span class="yellow-text">'editora_id'</span>, $editoras_ids)-><span class="blue-text">where</span>(<span class="yellow-text">'compositor'</span>, <span class="yellow-text">'='</span>, <span class="yellow-text">'Bob Dylan'</span>)-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Retorna os ID de musicas que contenham como editora as editoras com ID 1, 2 ou 3 ou (<i>OR</i>) onde o compositor for igual a Bob Dylan.
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método orderBy() </h5>

	<p class="flow-text text">O método <strong class="blue-text">orderBy()</strong> ajuda na ordenação do resultado de uma query, devendo ser passado como parametro um array com a key sendo o campo e o value a ordenação. 
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					$musicos <span class="red-text">=</span> (<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>()-><span class="blue-text">orderBy</span>([<span class="yellow-text">'idade'</span><span class="red-text">=></span><span class="yellow-text">'DESC'</span>, <span class="yellow-text">'nome'</span><span class="red-text">=></span><span class="yellow-text">'ASC'</span>])-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Retorna os musicos ordenados de idade maior para menor e posteriormente em ordem alfabética. 
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método limit() </h5>

	<p class="flow-text text">O método <strong class="blue-text">limit()</strong> serve para limitar a busca para uma quantidade desejada de resultados. 
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					$musicos <span class="red-text">=</span> (<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>()-><span class="blue-text">orderBy</span>([<span class="yellow-text">'idade'</span><span class="red-text">=></span><span class="yellow-text">'DESC'</span>, <span class="yellow-text">'nome'</span><span class="red-text">=></span><span class="yellow-text">'ASC'</span>])-><span class="blue-text">->limit</span>(<span class="purple-text">5</span>)-><span class="blue-text">get</span>();
				</div>
				<div class="card-action white">
					Retorna os primeiros 5 musicos ordenados de idade maior para menor e posteriormente em ordem alfabética. 
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Método values() </h5>

	<p class="flow-text text">O método <strong class="blue-text">values()</strong> serve para quando é necessário resgatar apenas os valores de uma classe, sem necessidade de utilizar seus metodos posteriormente, desta forma criando um array de objetos apenas com os valores do resultado da query.
	</p>.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					$musicos <span class="red-text">=</span> (<span class="red-text">new</span> <span class="blue-text">Musico</span>)-><span class="blue-text">select</span>()-><span class="blue-text">orderBy</span>([</span>, <span class="yellow-text">'nome'</span><span class="red-text">=></span><span class="yellow-text">'ASC'</span>])-><span class="blue-text">->limit</span>(<span class="purple-text">5</span>)-><span class="blue-text">get</span>()-><span class="blue-text">values</span>;
				</div>
				<div class="card-action white">
					Retorna os valores dos primeiros 5 ordenados em ordem alfabética. 
				</div>
			</div>
		</div>
	</div>

	<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Métodos  queryBuilder(), getQuery() e runQuery() </h5>

	<p class="flow-text text">Quando necessário realizar alguma querys muito elaboradas ou especificas para um caso especial, é possivel utilizar o método <strong class="blue-text">queryBuilder()</strong>.<br>
	Este método deve receber até duas strings, sendo uma a query e a segunda as condições desta query caso a query não tenha condições o segundo parametro não deve ser enviado. <br>
	Após a query montada deve-se executar o método <strong class="blue-text">getQuery()</strong> para quando a query possui algum retorno ou <strong class="blue-text">runQuery()</strong> para quando a query não possui retorno.

	<div class="row">
		<div class="col s12 m12">
			<div class="card">
				<div class="flow-text card-content white-text grey darken-4">
					<span class="blue-text">Musico</span>::<span class="blue-text">queryBuilder</span>(<span class="yellow-text">'</span><span class="red-text">SELECT * FROM</span> <span class="yellow-text">musicos</span><span class="yellow-text">'</span>)-><span class="blue-text">getQuery</span>();;
					<br>
					<span class="blue-text">Musico</span>::<span class="blue-text">queryBuilder</span>(<span class="yellow-text">'<span class="red-text">UPDATE</span> musicos <span class="red-text">SET</span> nome <span class="red-text">=</span> ? <span class="red-text">WHERE</span> id <span class="red-text">=</span> ?'</span>, <span class="yellow-text">'Michael Jackson, 1'</span>)-><span class="blue-text">runQuery</span>();
				</div>
				<div class="card-action white">
					Quando utilizado condicionais a string de valores no segundo parametro deve seguir a ordem de quais vão subistituir os ?.
				</div>
			</div>
		</div>
	</div>

</div>

<?php include('../layout/footer.php');?>
