<!DOCTYPE html>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>

	<title>ใบสั่งสินค้า</title>
	<style>
		@page {
			size: 21cm 29.7cm;
			margin-top: 1%;
			margin-left:10%;
			margin-right: 10%;
			margin-bottom: 1%;

		}
		@font-face {
			font-family: 'THSarabunNew';
			font-style: normal;
			font-weight: normal;
			src: url("{{ public_path('fonts/THSarabunNew/THSarabunNew.ttf') }}") format('truetype');
			
		}
		@font-face {
			font-family: 'THSarabunNew';
			font-style: normal;
			font-weight: bold;
			src: url("{{ public_path('fonts/THSarabunNew/THSarabunNew Bold.ttf') }}") format('truetype');
		
		}
		@font-face {
			font-family: 'THSarabunNew';
			font-style: italic;
			font-weight: normal;
			src: url("{{ public_path('fonts/THSarabunNew/THSarabunNew BoldItalic.ttf') }}") format('truetype');
		
		}
	</style>
</head>

<style >
	body{
		font-family: "THSarabunNew";
		font-size:16px;
	}
	footer {
		position: fixed; 
		bottom: 0cm; 
		left: 0cm; 
		/* right: 0cm; */
		height: 1cm;

	}
</style>
<style type="text/css" >
    .page {
		overflow: hidden;
        page-break-inside: avoid;
    }
</style>

<body>
	
	<div class="page">
		{{-- <h1>{{ $title }}</h1> --}}
		<h1 align="center">ใบสั่งสินค้า</h1>
		<table border='0' width='100%' style='border-collapse: collapse;'>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">เลขที่ใบสั่งซื้อ</span> {!! $order->id !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">วันที่</span> {!! $order->date->format('d/m/Y'); !!}</td>
			</tr>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">ผู้ส่ง </span>{!! Auth::user()->name !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">เบอร์โทร </span>{!! Auth::user()->phone !!}</td>
			</tr>
			<tr>
				<td  colspan="2" align="left"><span style="font-size:18px;font-weight: bold;">ที่อยู่ผู้ส่ง </span>{!! Auth::user()->address !!}</td>
			
			</tr>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">ผู้รับ</span> {!! $order->user->name !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">เบอร์โทร</span> {!! $order->user->phone !!}</td>
			</tr>
			<tr>
				<td colspan="2" align="left"><span style="font-size:18px;font-weight: bold;">ที่อยู่</span> {!! $order->user->address !!}</td>
			
			</tr>
		</table>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='1' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="5%" align="center">ลำดับ</th>
					<th width="75%" align="center">รายการสินค้า</th>
					<th width="10%" align="center">จำนวน</th>
					<th width="10%" align="center">หน่วยนับ</th>
				</tr>
				@if ( !empty($order->item))
					@foreach ($order->item as $key =>  $item)
						<tr>
							<td align="center">{!! $key+1 !!}</td>
							<td align="center"> {!! $item->product->name !!}</td>
							<td align="center">{!! $item->value !!}</td>
							<td align="center"> {!! $item->product->unit->name !!}</td>
						</tr>
					@endforeach
				@endif
			
				
			</table>
		</div>
		<div>
			หมายเหตุ {!! $order->remark !!}
		</div>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='0' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="50%"></th>
					<th width="50%"></th>
				</tr>
				<tr>
					<td align="center">.......................................................</td>
					<td align="center">.......................................................</td>
				</tr>
				<tr>
					<td align="center">ผู้จัดการเอกสาร</td>
					<td align="center">ผู้รับสินค้า</td>
				</tr>
				<tr>
					<td align="center">วันที่......................................</td>
					<td align="center">วันที่......................................</td>
				</tr>
			</table>
		</div>

	</div>

	<div class="page">
		
		<h1 align="center">ใบสั่งสินค้า (สำเนา1)</h1>
		<table border='0' width='100%' style='border-collapse: collapse;'>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">เลขที่ใบสั่งซื้อ</span> {!! $order->id !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">วันที่สั่ง</span> {!! $order->date->format('d/m/Y'); !!}</td>
			</tr>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">ผู้ส่ง </span>{!! Auth::user()->name !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">เบอร์โทร </span>{!! Auth::user()->phone !!}</td>
			</tr>
			<tr>
				<td  colspan="2" align="left"><span style="font-size:18px;font-weight: bold;">ที่อยู่ผู้ส่ง </span>{!! Auth::user()->address !!}</td>
			
			</tr>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">ผู้รับ</span> {!! $order->user->name !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">เบอร์โทร</span> {!! $order->user->phone !!}</td>
			</tr>
			<tr>
				<td colspan="2" align="left"><span style="font-size:18px;font-weight: bold;">ที่อยู่</span> {!! $order->user->address !!}</td>
			
			</tr>
		</table>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='1' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="5%" align="center">ลำดับ</th>
					<th width="75%" align="center">รายการสินค้า</th>
					<th width="10%" align="center">จำนวน</th>
					<th width="10%" align="center">หน่วยนับ</th>
				</tr>
				@if ( !empty($order->item))
					@foreach ($order->item as $key =>  $item)
						<tr>
							<td align="center">{!! $key+1 !!}</td>
							<td align="center"> {!! $item->product->name !!}</td>
							<td align="center">{!! $item->value !!}</td>
							<td align="center"> {!! $item->product->unit->name !!}</td>
						</tr>
					@endforeach
				@endif
			
				
			</table>
		</div>
		<div>
			หมายเหตุ {!! $order->remark !!}
		</div>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='0' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="50%"></th>
					<th width="50%"></th>
				</tr>
				<tr>
					<td align="center">.......................................................</td>
					<td align="center">.......................................................</td>
				</tr>
				<tr>
					<td align="center">ผู้จัดการเอกสาร</td>
					<td align="center">ผู้รับสินค้า</td>
				</tr>
				<tr>
					<td align="center">วันที่......................................</td>
					<td align="center">วันที่......................................</td>
				</tr>
			</table>
		</div>



	</div>
	<div class="page">
		
		<h1 align="center">ใบสั่งสินค้า (สำเนา2)</h1>
		<table border='0' width='100%' style='border-collapse: collapse;'>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">เลขที่ใบสั่งซื้อ</span> {!! $order->id !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">วันที่สั่ง</span> {!! $order->date->format('d/m/Y'); !!}</td>
			</tr>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">ผู้ส่ง </span>{!! Auth::user()->name !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">เบอร์โทร </span>{!! Auth::user()->phone !!}</td>
			</tr>
			<tr>
				<td  colspan="2" align="left"><span style="font-size:18px;font-weight: bold;">ที่อยู่ผู้ส่ง </span>{!! Auth::user()->address !!}</td>
			
			</tr>
			<tr>
				<td align="left"><span style="font-size:18px;font-weight: bold;">ผู้รับ</span> {!! $order->user->name !!}</td>
				<td align="right"><span style="font-size:18px;font-weight: bold;">เบอร์โทร</span> {!! $order->user->phone !!}</td>
			</tr>
			<tr>
				<td colspan="2" align="left"><span style="font-size:18px;font-weight: bold;">ที่อยู่</span> {!! $order->user->address !!}</td>
			
			</tr>
		</table>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='1' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="5%" align="center">ลำดับ</th>
					<th width="75%" align="center">รายการสินค้า</th>
					<th width="10%" align="center">จำนวน</th>
					<th width="10%" align="center">หน่วยนับ</th>
				</tr>
				@if ( !empty($order->item))
					@foreach ($order->item as $key =>  $item)
						<tr>
							<td align="center">{!! $key+1 !!}</td>
							<td align="center"> {!! $item->product->name !!}</td>
							<td align="center">{!! $item->value !!}</td>
							<td align="center"> {!! $item->product->unit->name !!}</td>
						</tr>
					@endforeach
				@endif
			
				
			</table>
		</div>
		<div>
			หมายเหตุ {!! $order->remark !!}
		</div>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='0' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="50%"></th>
					<th width="50%"></th>
				</tr>
				<tr>
					<td align="center">.......................................................</td>
					<td align="center">.......................................................</td>
				</tr>
				<tr>
					<td align="center">ผู้จัดการเอกสาร</td>
					<td align="center">ผู้รับสินค้า</td>
				</tr>
				<tr>
					<td align="center">วันที่......................................</td>
					<td align="center">วันที่......................................</td>
				</tr>
			</table>
		</div>



	</div>
</body>

</html>

