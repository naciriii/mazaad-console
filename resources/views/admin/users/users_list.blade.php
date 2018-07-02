@extends('templates.admin.layout')
@section('content')
<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{$title or '' }}</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Email sec</th>
                <th>Identifier</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Photo</th>
                 <th>Birthday</th>
                  <th>Joined at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
               <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Email sec</th>
                <th>Identifier</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Photo</th>
                 <th>Birthday</th>
                     <th>Joined at</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @if(count($users))
              @foreach ($users as $row)
              <tr>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->detail->email or ''}}</td>
                <td>{{$row->detail->identifier or ''}}</td>
             <td>{{$row->detail->first_name or ''}}</td>
             <td>{{$row->detail->last_name or ''}}</td>
               <td>{{$row->detail->first_name or ''}}</td>
             <td>{{$row->detail->birthday or ''}}</td>
             <td>{{str_limit($row->created_at,16,'')}}</td>


                <td>
                  <a href="{{ route('users.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                  
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