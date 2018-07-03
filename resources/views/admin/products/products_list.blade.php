@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{$title}} </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               
                                <th>Name</th>
                                <th>Category</th>
                                <th>Region</th>
                                <th>Start Price</th>
                                <th>Stop DateTime</th>
                                <th>Added By</th>
                                 <th>Created at</th>
                                 <th>Is Available</th>  
                                 <th>Is Valid</th>  
                                 <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Region</th>
                                <th>Start Price</th>
                                <th>Stop DateTime</th>
                                <th>Added By</th>
                                 <th>Created at</th>
                                 <th>Is Available</th>
                                 <th>Is Valid</th>  
                                 <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($products))
                            @foreach ($products as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->category->name}}</td>
                              <td>{{$row->region->name or ''}}</td>
                              <td>{{$row->start_price}} <small> TND</small></td>
                              <td>{{str_limit($row->stop_date,16,'')}}</td>
                              <td>{{$row->owner->name}}</td>
                              <td>{{$row->created_at}}</td>
                              <td>{!!$row->is_available?"<label class='label label-success'>Yes</label>":"<label class='label label-warning'>No</label>"!!}</td>
                                <td>{!!$row->is_valid?"<label class='label label-success'>Yes</label>":"<label class='label label-warning'>No</label>"!!}</td>
                            
                            
                           
                                <td>
                                    

                                    <a href="{{ route('products.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    @if(!$row->is_valid)
                                      <a href="{{ route('products.validate', ['id' => $row->id]) }}" class="btn btn-success btn-xs"><i class="fa fa-check" title="Delete"></i> </a>
                                      @endif
                                      
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

@stop