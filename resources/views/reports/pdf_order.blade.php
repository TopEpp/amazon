<!DOCTYPE html>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>

	<title>รายงานการสั่งสินค้า</title>
	<style>
		@page {
			size: 21cm 29.7cm;
			margin-top: 1%;
			margin-left:5%;
			margin-right: 5%;
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
		<h1 align="center">รายงานการสั่งสินค้า</h1>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='1' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="5%" align="center">เลขคำสั่ง</th>
					<th width="65%" align="center">ชื่อผู้สั่ง</th>
					<th width="10%" align="center">วันที่สั่ง</th>
					<th width="10%" align="center">จำนวนสินค้า</th>
					<th width="10%" align="center">ราคารวม</th>
				</tr>
				@if ( !empty($items))
					@foreach ($items as $key =>  $item)
						<tr>
							<td align="center">{!! $item->id !!}</td>
							<td align="center"> {!! $item->name !!}</td>
							<td align="center">{!! Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $item->date)->format('d/m/Y') !!}</td>
							<td align="center"> {!! $item->value !!}</td>
							<td align="center"> {!! $item->price !!}</td>
						</tr>
					@endforeach
				@endif
			
				
			</table>
		</div>
	
	</div>

</body>

</html>

