@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{$title}} <a href="{{route('regions.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Create New </a></h2>

                    <form id="createRegionForm" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('regions.store') }}">
                         <input type="hidden" name="_token" value="{{ Session::token() }}">

                       <label for="inputfile"> <input id="inputfile" onchange="submitform(this.value)" class="hidden" type="file" name="regions"/>
                        <a type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Upload</a>
                      </label>
                   </form>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               
                                <th>Name</th>
                             
                                
                            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                  <th>Name</th>
                             
                                
                            
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($regions))
                            @foreach ($regions as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                              
                            
                            
                           
                                <td>
                                    <a href="{{ route('regions.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>

                                    <a href="{{ route('regions.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                      
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function submitform(val) {
    $('#createRegionForm').submit()
}
</script>
@stop