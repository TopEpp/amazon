<!DOCTYPE html>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>

	<title>รายงานสรุปจำนวนสินค้าที่ใช้</title>
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
		<h1 align="center">รายงานสรุปจำนวนสินค้าที่ใช้</h1>
		<div style="margin-top:20px;margin-bottom:20px;">
			<table border='1' width='100%' style='border-collapse: collapse;'>
				<tr>
					<th width="20%" align="center">ชื่อสินค้า</th>
					<th width="10%" align="center">จำนวน</th>
				</tr>
				@if ( !empty($items))
					@foreach ($items as $key =>  $item)
						<tr>
							<td align="center">{!! $item->name !!}</td>
							<td align="center"> {!! $item->value !!}</td>
						</tr>
					@endforeach
				@endif
			
				
			</table>
		</div>
	
	</div>

</body>

</html>

