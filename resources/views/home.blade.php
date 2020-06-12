@extends('layouts.dashboard.default')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="card col-md-12">
			<div class="header">        
				<h4 class="title">Calcular</h4>				
			</div>
			<div class='content'>
				<div> 
				<a class="btn btn-lg btn-outline btn-info" href="{{url('recibosPrestaciones/crear')}}" title="Calcular Prestaciones Sociales">
					<i class="fa fa-plus-square"></i> Prestaciones Sociales
				</a>
				</div>
				<br>
				<div>
				<a class="btn btn-lg btn-outline btn-info" href="{{url('recibos/crear')}}" title="Calcular Cestatickets">
					<i class="fa fa-plus-square"></i> Cestaticket
				</a>
			</div>
				<br>
				<div>
				<a class="btn btn-lg btn-outline btn-info" href="{{url('recibosEmpleados/crear')}}" title="Calcular Nómina">
					<i class="fa fa-plus-square"></i> Nómina
				</a>					
				</div>
			</div> 
		</div>
	</div>
</div>
@endsection
