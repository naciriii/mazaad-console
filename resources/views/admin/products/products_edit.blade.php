@extends('templates.admin.layout')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/jquery.datetimepicker.min.css')}}"/>
<script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
<script type="text/javascript">
window.addEventListener('load',function() {
ClassicEditor
    .create( document.getElementById('description') )
    .then( function(editor) {
        console.log( 'Editor was initialized', editor );
    } )
    .catch( function(err){
        console.error( err.stack );
    } );
});
</script>

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Product <a href="{{route('products.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('products.update', ['id' => $product->id]) }}" data-parsley-validate class="form-horizontal form-label-left">

                       

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$product->name}}" id="name" name="name" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('start_price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_price">Start price <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$product->start_price}}" id="start_price" name="start_price" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('start_price'))
                                <span class="help-block">{{ $errors->first('start_price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select value="{{$product->category_id}}" class="form-control" name="category_id"
                                >
                                 

                                @foreach($categories as $c)
                                <option @if($product->category_id == $c->id) selected @endif value="{{$c->id}}">{{$c->name}}</option>

                                @endforeach
                            </select>
                                @if ($errors->has('category'))
                                <span class="help-block">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Region <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select value="{{$product->region_id}}" class="form-control" name="region_id"
                                >
                                 

                                @foreach($regions as $c)
                                <option @if($product->region_id == $c->id) selected @endif value="{{$c->id}}">{{$c->name}}</option>

                                @endforeach
                            </select>
                                @if ($errors->has('region'))
                                <span class="help-block">{{ $errors->first('region') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('stop_date') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stop Date <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="stop_date" id="stopdatetime" type="text" value="{{$product->stop_date}}">
                                @if ($errors->has('stop_date'))
                                <span class="help-block">{{ $errors->first('stop_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_price">Description
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="description"  value="{{$product->details->description or '' }}"  name="description" class="form-control col-md-7 col-xs-12">
                                    {{$product->details->description or '' }}
                                </textarea>
                                @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('start_price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Is Valid <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               
                               <label class="checkbox-inline"><input type="checkbox" @if($product->is_valid) checked @endif name="is_valid">Is Valid</label>

                            </div>
                        </div>
                           <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Is Available <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               
                               <label class="checkbox-inline"><input type="checkbox" @if($product->is_available) checked @endif name="is_available">Is Available</label>

                            </div>
                        </div>

                        

                        

                    

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-success">Save </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin/js/jquery.datetimepicker.full.min.js')}}"></script>
<script type="text/javascript">
function getFormattedDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear().toString().slice(2);
    return year + '-' + month + '-' + day;
}
 $(function () {
                $('#stopdatetime').datetimepicker({
                       format:'Y-m-d H:i',
                    minDate: getFormattedDate(new Date())
                });
            });
 </script>

@stop