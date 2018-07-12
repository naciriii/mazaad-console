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
                                <th>Picture</th>
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
                                <th>Picture</th>
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
                                <td><img height="50px;" width="50px;" src="{{$row->mainPicture()->first()->path}}"></td>

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
                                    
                                  <a href="{{ route('products.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                    <a href="{{ route('products.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    @if(!$row->is_valid)
                                      <a href="{{ route('products.validate', ['id' => $row->id]) }}" class="btn btn-success btn-xs"><i class="fa fa-check" title="Delete"></i> </a>

                                      @endif
                                      <button onclick="showMore({{$row->pictures->makeHidden('pivot')->toJson(JSON_HEX_APOS)}},@if($row->details){{$row->details->toJson(JSON_HEX_APOS)}}@else undefined @endif)" class="btn btn-xs btn-info">More</button>
                                      @if(count($row->bids))
                                      <a href="{{route('auctions.index',['id'=>$row->id])}}" ><button class="btn btn-sm btn-warning"> Auctions</button></a>
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
<div id="moreModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">More Details</h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <div class="row" id="description">
        </div>

        <div class="row" id="body">
        </div>
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
function showMore(pics,details) {

var html = '';
$.each(pics,function(index,item) {
    html+='<div class="col-md-4"><img height="100px" width="100px;" src="'+item.path+'"/></div>';
});
if(details != undefined) {
$('#moreModal #description').html('<p>'+details.description+'</p>');
}
$('#moreModal #body').html(html);

$('#moreModal').modal();
}</script>

@stop