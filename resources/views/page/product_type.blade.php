@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$name_product->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Home</a> / <span>Loai Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($type_p as $ty)
							<li><a href="{{route('loaisanpham',$ty->id)}}">{{$ty->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">438 styles found</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($type_product as $tp)
								<div class="col-sm-4">
									<div class="single-item">
										@if($tp->promotion_price !=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>			
										@endif	
										<div class="single-item-header">
											<a href="product.html"><img src="source/image/product/{{$tp->image}}" alt=""
												height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$tp->name}}</p>
											<p class="single-item-price">
												@if($tp->promotion_price == 0)
											    <span class="flash">{{$tp->unit_price}}</span>
											    @else
											    <span class="flash-del">{{$tp->unit_price}}</span>
												<span class="flash-sale">{{$tp->promotion_price}}</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Other Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tim thay {{count($other_product)}}</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($other_product as $op)
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img src="source/image/product/{{$op->image}}" alt=""
												height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$op->name}}</p>
											<p class="single-item-price">
												<span>{{$op->unit_price}}</span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="row">{{$other_product->links()}}</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
</div> <!-- .container -->
@endsection