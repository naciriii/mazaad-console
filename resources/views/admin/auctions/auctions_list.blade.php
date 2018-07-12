@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{$title}} on Product <b>{{$product->name}}</b>  </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               
                                 <th>Bidder Name</th>
                                   <th>Price</th>
                                   <th>Winning</th>
                                   <th>put date</th>
                             
                             
                                
                            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                  <th>Bidder Name</th>
                                   <th>Price</th>
                                   <th>Winning</th>
                                   <th>put date</th>
                             
                                
                            
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($auctions))
                            @foreach ($auctions as $row)
                            <tr>
                                <td>{{$row->bidder->name}}</td>
                                <td>{{$row->price}} <small>TND</small></td>
                                <td>{{$row->is_winning == true ? 'Yes':'No'}}</td>
                                <td>{{$row->created_at}}</td>
                              
                            
                            
                           
                                <td>
                                    <a href="{{ route('auctions.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>

                                    <a href="{{ route('auctions.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                      
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