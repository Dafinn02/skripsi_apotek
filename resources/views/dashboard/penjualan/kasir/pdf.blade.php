
<html >
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Struk #{{$data['id']}} </title>
<style type="text/css">
	body{
        /*width: 13cm;
        height: 8cm;*/
      /*  margin: 30mm 45mm 30mm 45mm; */
        /* change the margins as you want them to be. */
   } 
</style>
</head>
<body>
<table class="body-wrap">
	<tr>
		<td class="container" width="100%">
			<div class="content">
				<table class="main" width="100%" >
					<tr>
						<td class="content-wrap aligncenter">
							<table width="100%" >
								<tr style="text-align: center;">
									<td class="content-block">
										<b>Apotek PD Sumekar</b>
									</td>
								</tr>
								<hr style="border-top: 0.5px dashed black;">
								<tr style="text-align: center;">
									<td class="content-block">
										<table class="invoice">
											<tr>
												<td style="font-size: 10px;font-weight: bold;">
													 {{
														$data['customer_name'] == NULL ? 'CustomerName#'. $data['id'] : $data['customer_name']
													}} 
													| {{$data['customer_phone'] == NULL ? 'CustomerPhone#'. $data['id'] : $data['customer_phone']}}
													|
													Struk #{{$data['id']}} 
													
													<br> {{$data['kasir']}}  |{{ \Carbon\Carbon::make($data['created_at'])->format('d F Y H:i:s')}}
												</td>
											</tr>
											<hr style="border-top: 0.5px dashed black;">
											<tr>
												<td style="font-size: 10px">
													<table class="invoice-items" align="center">
														
														@foreach($data['item'] as $key => $item)
															<tr>
																<td  >
																	{{$item['qty']}} X {{$item['product_name']}} ({{$item['product_code']}})
																</td>
																<td class="alignright">
																	@php $sub = $item['product_price'] * $item['qty'] @endphp
																	Rp {{number_format($sub, 0, ",", ".")}}
																</td>
															</tr>
														@endforeach

														<tr>
															<td  >Discount</td>
															<td   class="alignright">
																Rp {{number_format($data['discount'], 0, ",", ".")}}
															</td>
														</tr>

														<tr>
															<td  >Service Cost</td>
															<td   class="alignright">
																Rp {{number_format($data['service_cost'], 0, ",", ".")}}
															</td>
														</tr>

														<tr>
															<td   >Emblase Cost</td>
															<td   class="alignright">
																Rp {{number_format($data['emblase_cost'], 0, ",", ".")}}
															</td>
														</tr>

														<tr>
															<td  >Shipping Cost</td>
															<td  class="alignright">
																Rp {{number_format($data['shipping_cost'], 0, ",", ".")}}
															</td>
														</tr>	

														<tr>
															<td  >Lainnya</td>
															<td   class="alignright">
																Rp {{number_format($data['lainnya'], 0, ",", ".")}}
															</td>
														</tr>
														<hr style="border-top: 0.5px dashed black;">
														<tr class="total">
															<td  class="alignright" >Grand Total</td>
															<td  class="alignright">
																Rp {{number_format($data['grandtotal'], 0, ",", ".")}}
															</td>
														</tr>
														<hr style="border-top: 0.5px dashed black;">
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<br>
								<hr style="border-top: 0.5px dashed black;">
								<tr style="text-align: center;font-size: 10px">
									<td class="content-block">
										Terimakasih Atas Kunjungan Anda
									</td>
								</tr>
								<tr style="text-align: center;font-size: 10px">
									<td class="content-block">
										Kab Sumenep, Jawa Timur · (0328) 62165
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer">
					<table width="100%">
						<tr style="font-size: 10px;text-align: center;">
							<td class="aligncenter content-block">{{date('Y')}} Apotek PD Sumekar</td>
						</tr>
					</table>
				</div>
				<hr style="border-top: 0.5px dashed black;">
			</div>
		</td>
		<td></td>
	</tr>
</table>

</body>
</html>
