@extends('layouts.admin')
@section('content')

<h3>Welcome To Dashboard  <strong class="text-primary">{{ Auth::user()->name }}</strong></h3>
<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Last 7 days Order</h3>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Last 7 days Sales Amount</h3>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    const ctx = document.getElementById('myChart');
    var order_date = @json($order_date_info);
    var total_order = @json($total_order_info);

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: order_date,
        datasets: [{
          label: 'total order',
          data: total_order,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });


    const sales = document.getElementById('myChart2');
    var sales_date = @json($sales_date_info);
    var total_sales = @json($total_sales_info);

    new Chart(sales, {
      type: 'pie',
      data: {
        labels: sales_date,
        datasets: [{
          label: 'total sales',
          data: total_sales,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endsection
