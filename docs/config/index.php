<?php include('../layout/header.php');?>

<div class="container">
<p class="fonte center">Config</p>

<p class="flow-text text">O Framework possui na raiz uma pasta <strong class="brown-text">Config</strong> contendo dois arquivos de configuração que facilitam a mudança de variaveis do sistema. O arquivo <strong class="brown-text">app.php</strong> é responsavel pelas configurações de ambiente e o arquivo <strong class="brown-text">database.php</strong> diz repeito as configurações do banco de dados. 

<h5 class="header"><i style="vertical-align: middle;" class="cyan-text medium material-icons">new_releases</i> app.php</h5>

<div class="row">
	<div class="col s12 m12">
		<div class="card">
			<div class="flow-text card-content white-text grey darken-4">
				<span class="red-text">return</span> [ <br>
					<span class="yellow-text" style="margin-left:50px;">'app'</span> <span class="red-text">=></span> [ <br>
							<span class="yellow-text" style="margin-left:75px;">'name'</span> <span class="red-text">=></span> <span class="yellow-text">'Framework TRSOARES'</span>, <br>
							<span class="yellow-text" style="margin-left:75px;">'url'</span> <span class="red-text">=></span> <span class="yellow-text">'APP_URL'</span>, <br>
							<span class="yellow-text" style="margin-left:75px;">'basePath'</span> <span class="red-text">=></span> <span class="yellow-text">'/framework/public'</span>, <br>
							<span class="yellow-text" style="margin-left:75px;">'timezone'</span> <span class="red-text">=></span> <span class="yellow-text">'America/Sao_Paulo'</span>, <br>
							<span class="yellow-text" style="margin-left:75px;">'pageNotFound'</span> <span class="red-text">=></span> <span class="yellow-text">'errors.404'</span>, <br>
							<span class="yellow-text" style="margin-left:75px;">'pageForbidden'</span> <span class="red-text">=></span> <span class="yellow-text">''</span> <br>
					<span style="margin-left:50px;">],</span><br>
					<span class="yellow-text" style="margin-left:50px;">'view'</span> <span class="red-text">=></span> [ <br>
						<span class="yellow-text" style="margin-left:75px;">'folder'</span> <span class="red-text">=></span> <span class="yellow-text">'../resources/views/'</span>,<br>
					<span style="margin-left:50px;">],</span><br>
					<span class="yellow-text" style="margin-left:50px;">'controller'</span> <span class="red-text">=></span> [ <br>
						<span class="yellow-text" style="margin-left:75px;">'folder'</span> <span class="red-text">=></span> <span class="yellow-text">'App\Http\Controllers<span class="purple-text">\\</span>'</span>,<br>

					<span style="margin-left:50px;">]</span> <br>
				];
				</div>
			<div class="card-action white">
				Arquivo app.php
			</div>
		</div>
	</div>
</div>

<h5 class="header2"><i style="vertical-align: middle;" class="cyan-text small material-icons">done_all</i> Variaveis de configuração do app.php</h5>

<table class="responsive-table highlight">
 	<thead>
 		<tr>
 			<th width="15%">Bloco</th>
 			<th width="15%">Variavél</th>
 			<th>Descrição</th>
 		</tr>
 	</thead>
    <tbody>
    	<tr>
    		<td rowspan="7">app</td>
        <tr>
    		<td>name</td>
    		<td>Define o nome da aplicação.</td>
        </tr>
        <tr>
    		<td>url</td>
    		<td>Define a url da aplicação.</td>
        </tr>
        <tr>
    		<td>basePath</td>
    		<td>Define o caminho para a pasta publica da aplicação.</td>
        </tr>
        <tr>
    		<td>timezone</td>
    		<td>Define o fuso horário da aplicação.</td>
        </tr>
        <tr>
    		<td>pageNotFound</td>
    		<td>Define uma página padrão para erro 404. (Ex: errors.404 = 'pasta dentro das views'.'nome do arquivo php').</td>
        </tr>
        <tr>
    		<td>pageForbidden</td>
    		<td>Define uma página padrão para o erro 403.</td>
        </tr>
        <tr>
    		<td rowspan="2">view</td>
        <tr>
    		<td>folder</td>
    		<td>Define o caminho para a pasta de views da aplicação.</td>
        </tr>
        <tr>
    		<td rowspan="2">controllers</td>
        <tr>
    		<td>folder</td>
    		<td>Define o caminho para a pasta de controllers da aplicação.</td>
        </tr>
    </tbody>
</table>
<br>


<?php include('../layout/footer.php');?>
