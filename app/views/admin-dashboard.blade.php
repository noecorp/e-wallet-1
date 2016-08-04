@extends('layouts.app')

@section('content')
	<?php
	$operationHelper = OperationHelper::newInstance();
	?>
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
	    <div class="page-title">
	        <h1>Dashboard
	            <small>Admin</small>
	        </h1>
	    </div>
	</div><!-- end of page-head -->
	<div class="clearfix .home-tiles">
		<div class="col-md-3 tile blue">
			<?php $operationHelper->setType(Operation::TYPE_DEPOSIT); ?>
			<div class="tile-icon">
				<i class="icon-cloud-upload"></i>
			</div>
			<div class="tile-text">
				<div class="title">Deposit</div>
				<div class="value">{{ $operationHelper->getSum() }}$</div>
			</div>
		</div>
		<div class="col-md-3 tile red">
			<?php $operationHelper->setType(Operation::TYPE_TRANSACTION_OUT); ?>
			<div class="tile-icon">
				<i class="icon-directions"></i>
			</div>
			<div class="tile-text">
				<div class="title">Transaction</div>
				<div class="value">{{ $operationHelper->getSum() }}$</div>
			</div>
		</div>
		<div class="col-md-3 tile orange">
			<?php $operationHelper->setType(Operation::TYPE_WITHDRAWAL); ?>
			<div class="tile-icon">
				<i class="icon-cloud-download"></i>
			</div>
			<div class="tile-text">
				<div class="title">Withdrawal</div>
				<div class="value">{{ $operationHelper->getSum() }}$</div>
			</div>
		</div>
		<div class="col-md-3 tile red">
			<?php $operationHelper->setType(Operation::TYPE_TRANSACTION_OUT); ?>
			<div class="tile-icon">
				<i class="icon-directions"></i>
			</div>
			<div class="tile-text">
				<div class="title">Transaction</div>
				<div class="value">{{ $operationHelper->getSum() }}$</div>
			</div>
		</div>
	</div><!-- end of home-tiles -->

	<div class="clearfix">

		<div class="portlet light bordered m-t-15">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-graph font-green"></i>
					<span class="caption-subject font-green bold uppercase">This Month Transaction</span>
				</div>
			</div>
			<div class="protlet-body">
				<canvas id="transaction-graph" height="100"></canvas>
			</div>
		</div>
	</div>
@stop

@section('footer')
	<script src="{{ url('public/scripts/Chart.bundle.min.js') }}" ></script>
	<script>
		<?php
		$labels= [];
		$depositDataSet = [];
		$withdrawalDataSet = [];
		$transactionDataSet = [];
		for($i = 0;$i<30;$i++){
			$start_date = date('Y-m-d 00:00:00', strtotime('+ '.$i.' days',strtotime( date('Y-m-01') ) ) );
			$end_date = date('Y-m-d 23:59:59', strtotime('+ '.$i.' days',strtotime( date('Y-m-01') ) ) );

			$operationHelper->setStartDate($start_date)->setEndDate($end_date);

			$labels[] = '"'.date('d', strtotime('+ '.$i.' days' ,strtotime( date('Y-m-01') ) ) ).'"';
			$operationHelper->setType(Operation::TYPE_DEPOSIT);
			$depositDataSet[] = $operationHelper->getSum();

			$operationHelper->setType(Operation::TYPE_WITHDRAWAL);
			$withdrawalDataSet[] = $operationHelper->getSum();

			$operationHelper->setType(Operation::TYPE_TRANSACTION_OUT);
			$transactionDataSet[] = $operationHelper->getSum();
		}
		?>
		var ctx = document.getElementById("transaction-graph");
		
		var data = {
			labels: [{{ implode(',', $labels) }}],
		    datasets: [
		        {
		            label: "Deposit",
		            fill: false,
		            lineTension: 0.1,
		            backgroundColor: "rgba(101,155,224,0.4)",
		            borderColor: "rgba(101,155,244,1)",
		            borderCapStyle: 'butt',
		            borderDash: [],
		            borderDashOffset: 0.0,
		            borderJoinStyle: 'miter',
		            pointBorderColor: "rgba(101,155,244,1)",
		            pointBackgroundColor: "#fff",
		            pointBorderWidth: 1,
		            pointHoverRadius: 5,
		            pointHoverBackgroundColor: "rgba(101,155,244,1)",
		            pointHoverBorderColor: "rgba(220,220,220,1)",
		            pointHoverBorderWidth: 2,
		            pointRadius: 1,
		            pointHitRadius: 10,
		            data: [{{ implode(',', $depositDataSet) }}],
		            spanGaps: false,
		        },
		        {
		            label: "Withdrawal",
		            fill: false,
		            lineTension: 0.1,
		            backgroundColor: "rgba(241,196,15,0.4)",
		            borderColor: "rgba(241,196,15,1)",
		            borderCapStyle: 'butt',
		            borderDash: [],
		            borderDashOffset: 0.0,
		            borderJoinStyle: 'miter',
		            pointBorderColor: "rgba(241,196,15,1)",
		            pointBackgroundColor: "#fff",
		            pointBorderWidth: 1,
		            pointHoverRadius: 5,
		            pointHoverBackgroundColor: "rgba(241,196,15,1)",
		            pointHoverBorderColor: "rgba(220,220,220,1)",
		            pointHoverBorderWidth: 2,
		            pointRadius: 1,
		            pointHitRadius: 10,
		            data: [{{ implode(',', $withdrawalDataSet) }}],
		            spanGaps: false,
		        },
		        {
		            label: "Transaction",
		            fill: false,
		            lineTension: 0.1,
		            backgroundColor: "rgba(237,107,117,0.4)",
		            borderColor: "rgba(237,107,117,1)",
		            borderCapStyle: 'butt',
		            borderDash: [],
		            borderDashOffset: 0.0,
		            borderJoinStyle: 'miter',
		            pointBorderColor: "rgba(237,107,117,1)",
		            pointBackgroundColor: "#fff",
		            pointBorderWidth: 1,
		            pointHoverRadius: 5,
		            pointHoverBackgroundColor: "rgba(237,107,117,1)",
		            pointHoverBorderColor: "rgba(220,220,220,1)",
		            pointHoverBorderWidth: 2,
		            pointRadius: 1,
		            pointHitRadius: 10,
		            data: [{{ implode(',', $transactionDataSet) }}],
		            spanGaps: false,
		        }
		    ]
		};

		var myLineChart = new Chart(ctx, {
		    type: 'line',
		    data: data,
		});
	</script>
@stop