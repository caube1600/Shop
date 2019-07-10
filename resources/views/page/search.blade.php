@extends('master')
@section('comtent')
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Search Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tim thay {{count($product)}} san pham</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($product as $new)
								<div class="col-sm-3">
									<div class="single-item">
										@if($new->promotion_price !=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>			
										@endif						
										<div class="single-item-header">
											<a href="{{route('product',$new->id)}}"><img src="source/image/product/{{$new->image}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$new->name}}</p>
											<p class="single-item-price">
												@if($new->promotion_price == 0)
											    <span class="flash">{{$new->unit_price}}</span>
											    @else
											    <span class="flash-del">{{$new->unit_price}}</span>
												<span class="flash-sale">{{$new->promotion_price}}</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('Themgiohang',$new->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('product',$new->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
@endsection