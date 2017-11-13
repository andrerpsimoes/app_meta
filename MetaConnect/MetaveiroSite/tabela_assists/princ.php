<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Metav</title>

	<!-- jQuery -->
	<script src="js/jquery-latest.min.js"></script>
    

	<!-- Tablesorter: required -->
	<link rel="stylesheet" href="css/theme.blue.css">
	<script src="js/jquery.tablesorter.js"></script>
	<script src="js/jquery.tablesorter.widgets.js"></script>
    <link rel="stylesheet" href="css/jq.css">
    <link rel="stylesheet" href="css/met.css">
	<script src="js/widgets/widget-columnSelector.js"></script>
	<script src="js/widgets/widget-print.js"></script>
	<script src="js/met.js"></script>
	<script src="js/jquery.tablesorter.pager.js"></script>
    
          <!--Import materialize
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> -->

    
</head>
<body>

<h1>METAVEIRO</h1>
<br>
    <hr>
<button id="button">Imprimir</button>
    
            <div id="columnSelector">
            <!-- this div is where the column selector is added -->
            </div>
     
    
<table class="tablesorter">
    	<colgroup>
		<col width="85" />
		<col width="250" />
		<col width="100" />
		<col width="90" />
		<col width="70" />
	</colgroup>

	<thead>
        <tr>
            <th data-placeholder="Filtrar">intNumero</th>
			<th data-placeholder="Filtrar">strCVDNome</th>
			<th data-placeholder="Filtrar">strCVDLocalidade</th>
			<th data-placeholder="Filtrar">CA_Zona</th>
			<th data-placeholder="Filtrar">CA_Morada</th>
			<th data-placeholder="Filtrar">dtmData</th>
			<th data-placeholder="Filtrar">strCVDMorada</th>
			<th data-placeholder="Filtrar">strCVDCodPostal</th>
			<th data-placeholder="Filtrar">dtmDataAlteracao</th>
			<th data-placeholder="Filtrar">CA_qPediu</th>
			<th data-placeholder="Filtrar">CA_qRecebeuPedido</th>
			<th data-placeholder="Filtrar">CA_Modelo</th>
			<th data-placeholder="Filtrar">CA_Marca</th>
			<th data-placeholder="Filtrar">CA_Escolha</th>
			<th data-placeholder="Filtrar">CA_Modelo</th>
          
    
		</tr>
	</thead>
	<tbody>
        <?php include 'phpinfo.php';?>
        
	</tbody>
    
    <div id="pager" class="pager">
	<form>
		<input type="button" value="&lt;&lt;" class="first" />
		<input type="button" value="&lt;" class="prev" />
		<input type="text" class="pagedisplay" readonly/>
		<input type="button" value="&gt;" class="next" />
		<input type="button" value="&gt;&gt;" class="last" />
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
		</select>
	</form>
</div>
</table>
    
    
<!--Import jQuery before materialize.js
      <script type="text/javascript" src="js/materialize.min.js"></script>-->
</body>
</html>