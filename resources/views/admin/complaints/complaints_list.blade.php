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
                               
                                <th>Sender</th>
                                 <th>Subject</th>
                                 <th>Content</th>
                                    <th>Sent Date</th>
                             
                                
                            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                  <th>Sender</th>
                                 <th>Subject</th>
                                 <th>Content</th>
                                  <th>Sent Date</th>
                             
                                
                            
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($complaints))

                            @foreach ($complaints as $row)
                            <tr>
                                <td><a href="{{route('users.index')}}">{{$row->user->email}}</a></td>
                                <td>{{$row->csubject->name or '' }}</td>
                                <td>{{str_limit($row->content,15,'...')}}</td>
                                <td>{{$row->created_at}}</td>
                              
                            
                            
                           
                                <td>
                                    

                                    <a href="{{ route('complaints.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    <button onclick="seeComplaint('{{$row->content}}')" class="btn btn-sm btn-primary">View</button>
                                       <button onclick="answer('{{$row->user->email}}')" class="btn btn-sm btn-success">Answer</button>
                                      
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
<div id="complaintModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">More Details</h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <div class="row" >
            <p id="content"></p>
        </div>

        
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="answerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Answer</h4>
      </div>
      <div class="modal-body">
        <div class="container">
            <form method="post" action="{{route('complaints.answer')}}">
                <input type="hidden" name="email" id="email">
                <input type="hidden" value="{{csrf_token()}}" name="_token">
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="content" class="form-control" placeholder="Message here ..">
                    </textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button></div>
            </form>

        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
function seeComplaint(complaint)
{
    $('#complaintModal #content').text(complaint);
    $('#complaintModal').modal();

}
function answer(email)
{
    $('#answerModal #email').val(email);
    $('#answerModal').modal();

}
</script>
@stop