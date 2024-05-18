@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
@endphp
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> {{ session()->get('message') }}</strong> 
</div>
@endif
@if(session()->has('messagerr'))
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> {{ session()->get('messagerr') }}</strong> 
</div>
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	
		<h3>Listado de Productos <br>@if(Auth::user()->id_cargo== "1")<a href="articulo/create"><button class="btn btn-success">Nuevo</button></a>@endif</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  id="producto" class="table table-striped table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Codigo</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th >Marca</th>
					<th >Color</th>
					<th >Iva</th>
					<th>Descuento</th>

					<th>Descripción</th>
					<th>Imgaen</th>
					<th>Estado</th>
					@if(Auth::user()->id_cargo== "1")<th>Opciones</th>@endif
				</thead>
               @foreach ($articulos as $cat)
				<tr>
					<td>{{$cont}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->codigo}}</td>
					<td>{{ $cat->categoria}}</td>
					<td>{{ $cat->stock}}</td>
					<td  >{{ $cat->marca}}</td>
					<td >{{ $cat->color}}</td>
					@if($cat->impuesto_valor == null || $cat->impuesto_valor == "")
					<td >0.00</td>
					@else
					<td  >{{ $cat->impuesto_valor }}</td>
					@endif

					<td  >{{ $cat->descuento }}</td>
					<td>{{ $cat->descripcion}}</td>
					<td><img src="{{asset('imagenes/articulos/'.$cat->imagen)}}" alt="{{$cat->nombre}}" height="100px" width="100px" class="img-thumbnail"></td>

					@if(Auth::user()->id_cargo== "1")
					<td><input type="checkbox" data-onstyle="warning" class="toggle-class" data-id="{{$cat->id_producto}}" data-toggle="toggle"
					data-on="Activo" data-off="Inactivo" {{$cat->estado == 'Activo' ? 'checked':''}}> </td>		
					@else
					<td><input type="checkbox" disabled data-onstyle="warning" class="toggle-class" data-id="{{$cat->id_producto}}" data-toggle="toggle"
					data-on="Activo" data-off="Inactivo" {{$cat->estado == 'Activo' ? 'checked':''}}> </td>
					@endif

					@if(Auth::user()->id_cargo== "1")	
					<td>
						<a href="{{URL::action('ArticuloController@edit',$cat->id_producto)}}"><button class="btn btn-info">Editar</button></a>
					</td>
					@endif
				</tr>
			    @php
				$cont++;
				@endphp
				@endforeach
			</table>
		</div>
	</div>
</div>

@push ('scripts') 
 <script>
	$(window).on("load", function() {
		setTimeout(() => {
			cargarDataTable();
      }, 50);
	});
function cargarDataTable() {

$('#producto').DataTable({
     
	 responsive: "true",
		 dom: 'flBrtip',  
		 paging: true,
		 pageLength: 5,
		 pagingType: 'full_numbers',
		 destroy: true,
		 deferRender: true,
		 "bProcessing": true,
		 /* orderCellsTop: false, */
		 "order": [[ 0, 'asc' ]],
		 /* search: false,
		 scrollY: "300px",
		 scrollCollapse: true, */
		 language: {
		 url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
	   },
	   columnDefs: [
			 {
				 targets: [5,6,7,8],
				 visible: false,
				 searchable: false,
			 },
		 ],
 
		 buttons: [
			 {
				 extend: "excel",
				 footer: true,
				 title: "Lista de Productos",
				 filename: "productos",
				 text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
				 exportOptions: {
					 columns: [0,2, 1, 3,4,5,6,7,8,9],
					 stripHtml: false
				 } 
			 },
			 {
				 extend: "print",
				 footer: true,
				 title: "Lista de Productos",
				 filename: "productos",
				 text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',
				 /* orientation: 'landscape', */
				 exportOptions: {
					 columns: [0,2, 1, 3,4,5,6,7,8,9],
				 } 
 
			 },
			 {
				 extend: "pdf",
				 footer: true,
				 title: "Lista de Productos",
				 filename: "productos",
				 pageSize: 'A4',
				 alignment: "center",
				 pageMargins: [ 90, 0, 0, 0 ],
				 text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
				 /* orientation: 'landscape', */
				 exportOptions: {
					 columns: [0,2, 1, 3,4,5,6,7,8,9],
				 } 
 
 
			 },
 
		 ]			  
	  });
    

 
	 

}

$(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Activo',
      off: 'Inactivo'
    });
  })

  $('.toggle-class').on('change',function(){
	var status = $(this).prop('checked') == true ? 'Activo' : 'Inactivo';
	var id = $(this).data('id');
	$.ajax({
    type:'GET',
	dataType:'json',
	url:'{{route("change.statusa")}}',
	data:{'status':status, 'id':id},
	success:function(data){
/* 	$('.message').html('<p class="alert alert-danger" >'+data.success+'</p>'); */
	}
	});

  });

 </script>
@endpush
@endsection