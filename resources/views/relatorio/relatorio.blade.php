<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style type="text/css">
			*
			{
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			}
			table, th, td {
			  border-collapse: collapse;
			}
			td, th
			{
				border-bottom: 1px solid #ddd;
  				padding: 8px;
			}
			td
			{
				text-align: center;
			}
			tr:nth-child(even){background-color: #f2f2f2;}
			th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: center;
			  background-color: #4CAF50;
			  color: white;
			}
		</style>
	</head>
	<body>
		<h1 style="text-align: center">{{$aplicacao->titulo}}</h1>
		<p style="text-align: center">Período de aplicação: {{date('d/m/Y',strtotime($aplicacao->dataInicio))}} até {{date('d/m/Y',strtotime($aplicacao->dataFim))}}</p>
		@php
			$i = 1;
		@endphp
		@foreach($dissertativas as $dissertativa)
			@if($i == 1)
				<h3>{{$dissertativa->pergunta}}</h3>
			@endif

			<p>{{$dissertativa->resposta}}</p>

			@php
				$i++;
			@endphp
		@endforeach

		@php
			$i = 1;
		@endphp
		@foreach($alternativas as $alternativa)
			@if($i == 1)
				<h3>{{$alternativa->pergunta}}</h3>
				<table style="width: 100%;"><tr>
			@endif
			<th>{{$alternativa->alternativa}}</th>
			@php
				$i++;
			@endphp
		@endforeach
		</tr>

		@php
			$i = 1;
		@endphp
		@foreach($alternativasResp as $alternativa)
			@if($i == 1)
				<tr>
			@endif
			<td>{{($alternativa->totalAlt/$total)*100}} %</td>
			@php
				$i++;
			@endphp
		@endforeach
		@for ($j = 0; $j <= (count($alternativas)-$i) ; $j++)
		    <td> 0 % </td>
		@endfor
	</tr>

	</table>
		
		
	</body>
</html>