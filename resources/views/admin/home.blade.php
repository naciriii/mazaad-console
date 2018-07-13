@extends('templates.admin.layout')

@section('content')
<div class="row">
	<h1> Dashboard</h1>
</div>
<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Members</span>
              <div class="count">{{$users}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-shopping-basket"></i> Total Products</span>
              <div class="count">{{$products}}</div>
            </div>
           <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-map-marker"></i> Total Regions</span>
              <div class="count">{{$regions}}</div>
            </div>
            <div cla
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cogs"></i> Total Categories</span>
              <div class="count">{{$categories}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-gavel"></i> Total auctions</span>
              <div class="count">{{$auctions}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-envelope"></i> Total Complaints</span>
              <div class="count">{{$complaints}}</div>
            </div>
       
           
          </div>
          <div class="x_panel">
          <canvas id="myChart"></canvas>

</div>
          <script  src="{{asset('admin/js/Chart.min.js')}}" ></script>
          <script type="text/javascript">
          var ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Products", "Auctions",'Members'],
      datasets: [
        {
          label: "Count ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
          data: [{{$products}},{{$auctions}},{{$users}}]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Products vs Auctions vs Members: {{date("Y-m-d")}}'
      }
    }
});

          </script>

@endsection