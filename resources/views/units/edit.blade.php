@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Units
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($units, ['route' => ['units.update', $units->id], 'method' => 'patch']) !!}

                        @include('units.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection