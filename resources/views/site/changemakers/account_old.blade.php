@extends('layouts.site.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('limitless')
    <!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('site/limitless/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	{{-- <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"> --}}
	<link href="{{ asset('site/limitless/assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('site/limitless/assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('site/limitless/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	{{--  <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/loaders/pace.min.js') }}"></script>  --}}
	{{--  <script type="text/javascript" src="{{ asset('site/limitless/assets/js/core/libraries/jquery.min.js') }}"></script>  --}}
	{{--  <script type="text/javascript" src="{{ asset('site/limitless/assets/js/core/libraries/bootstrap.min.js') }}"></script>  --}}
	{{--  <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/loaders/blockui.min.js') }}"></script>  --}}
    
	<!-- /core JS files -->
@stop
@section('content')
        <!--Bread Crumb-->

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
            {{-- @include('layouts.limitless.sidebar') --}}
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Toolbar -->
				<div class="navbar navbar-default navbar-component navbar-xs">
					<ul class="nav navbar-nav visible-xs-block">
						<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
					</ul>

					<div class="navbar-collapse collapse" id="navbar-filter">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Settings</a></li>
						</ul>

						<div class="navbar-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="icon-stack-text position-left"></i> Notes</a></li>
								<li><a href="#"><i class="icon-collaboration position-left"></i> Friends</a></li>
								<li><a href="#"><i class="icon-images3 position-left"></i> Photos</a></li>
								{{-- <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> <span class="visible-xs-inline-block position-right"> Options</span> <span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-image2"></i> Update cover</a></li>
										<li><a href="#"><i class="icon-clippy"></i> Update info</a></li>
										<li><a href="#"><i class="icon-make-group"></i> Manage sections</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="icon-three-bars"></i> Activity log</a></li>
										<li><a href="#"><i class="icon-cog5"></i> Profile settings</a></li>
									</ul>
								</li> --}}
							</ul>
						</div>
					</div>
				</div>
				<!-- /toolbar -->


				<!-- User profile -->
				<div class="row">
					<div class="col-lg-9">
						<div class="tabbable">
							<div class="tab-content">
								<div id="settings">

									<!-- Profile info -->
									<div class="panel panel-flat">
										<div class="panel-heading">
											<h6 class="panel-title">Profile information</h6>
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li><a data-action="collapse"></a></li>
							                		<li><a data-action="reload"></a></li>
							                		<li><a data-action="close"></a></li>
							                	</ul>
						                	</div>
										</div>

										<div class="panel-body">
											<form action="#">
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Username</label>
															<input type="text" value="Eugene" class="form-control">
														</div>
														<div class="col-md-6">
															<label>Full name</label>
															<input type="text" value="Kopyov" class="form-control">
														</div>
													</div>
												</div>

												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Address line 1</label>
															<input type="text" value="Ring street 12" class="form-control">
														</div>
														<div class="col-md-6">
															<label>Address line 2</label>
															<input type="text" value="building D, flat #67" class="form-control">
														</div>
													</div>
												</div>

												<div class="form-group">
													<div class="row">
														<div class="col-md-4">
															<label>City</label>
															<input type="text" value="Munich" class="form-control">
														</div>
														<div class="col-md-4">
															<label>State/Province</label>
															<input type="text" value="Bayern" class="form-control">
														</div>
														<div class="col-md-4">
															<label>ZIP code</label>
															<input type="text" value="1031" class="form-control">
														</div>
													</div>
												</div>

												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Email</label>
															<input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
														</div>
														<div class="col-md-6">
								                            <label>Your country</label>
								                            <select class="select">
								                                <option value="germany" selected="selected">Germany</option>
								                                <option value="france">France</option>
								                                <option value="spain">Spain</option>
								                                <option value="netherlands">Netherlands</option>
								                                <option value="other">...</option>
								                                <option value="uk">United Kingdom</option>
								                            </select>
														</div>
													</div>
												</div>

						                        <div class="form-group">
						                        	<div class="row">
						                        		<div class="col-md-6">
															<label>Phone #</label>
															<input type="text" value="+99-99-9999-9999" class="form-control">
															<span class="help-block">+99-99-9999-9999</span>
						                        		</div>

														<div class="col-md-6">
															<label class="display-block">Upload profile image</label>
						                                    <input type="file" class="file-styled">
						                                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
														</div>
						                        	</div>
						                        </div>

						                        <div class="text-right">
						                        	<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
						                        </div>
											</form>
										</div>
									</div>
									<!-- /profile info -->


									<!-- Account settings -->
									<div class="panel panel-flat">
										<div class="panel-heading">
											<h6 class="panel-title">Account settings</h6>
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li><a data-action="collapse"></a></li>
							                		<li><a data-action="reload"></a></li>
							                		<li><a data-action="close"></a></li>
							                	</ul>
						                	</div>
										</div>

										<div class="panel-body">
											<form action="#">
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Username</label>
															<input type="text" value="Kopyov" readonly="readonly" class="form-control">
														</div>

														<div class="col-md-6">
															<label>Current password</label>
															<input type="password" value="password" readonly="readonly" class="form-control">
														</div>
													</div>
												</div>

												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>New password</label>
															<input type="password" placeholder="Enter new password" class="form-control">
														</div>

														<div class="col-md-6">
															<label>Repeat password</label>
															<input type="password" placeholder="Repeat new password" class="form-control">
														</div>
													</div>
												</div>

												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Profile visibility</label>

															<div class="radio">
																<label>
																	<input type="radio" name="visibility" class="styled" checked="checked">
																	Visible to everyone
																</label>
															</div>

															<div class="radio">
																<label>
																	<input type="radio" name="visibility" class="styled">
																	Visible to friends only
																</label>
															</div>

															<div class="radio">
																<label>
																	<input type="radio" name="visibility" class="styled">
																	Visible to my connections only
																</label>
															</div>

															<div class="radio">
																<label>
																	<input type="radio" name="visibility" class="styled">
																	Visible to my colleagues only
																</label>
															</div>
														</div>

														<div class="col-md-6">
															<label>Notifications</label>

															<div class="checkbox">
																<label>
																	<input type="checkbox" class="styled" checked="checked">
																	Password expiration notification
																</label>
															</div>

															<div class="checkbox">
																<label>
																	<input type="checkbox" class="styled" checked="checked">
																	New message notification
																</label>
															</div>

															<div class="checkbox">
																<label>
																	<input type="checkbox" class="styled" checked="checked">
																	New task notification
																</label>
															</div>

															<div class="checkbox">
																<label>
																	<input type="checkbox" class="styled">
																	New contact request notification
																</label>
															</div>
														</div>
													</div>
												</div>

						                        <div class="text-right">
						                        	<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
						                        </div>
					                        </form>
										</div>
									</div>
									<!-- /account settings -->

								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3">

						<!-- User thumbnail -->
						<div class="thumbnail">
							<div class="thumb thumb-rounded thumb-slide">
								<img src="{{ asset('media/profile/'.$user->image) }}" alt="">
								<div class="caption">
									<span>
										<a href="#" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
										<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
									</span>
								</div>
							</div>

					    	<div class="caption text-center">
					    		<h6 class="text-semibold no-margin">Hanna Dorman <small class="display-block">UX/UI designer</small></h6>
				    			<ul class="icons-list mt-15">
			                    	<li><a href="#" data-popup="tooltip" title="Google Drive"><i class="icon-google-drive"></i></a></li>
			                    	<li><a href="#" data-popup="tooltip" title="Twitter"><i class="icon-twitter"></i></a></li>
			                    	<li><a href="#" data-popup="tooltip" title="Github"><i class="icon-github"></i></a></li>
		                    	</ul>
					    	</div>
				    	</div>
				    	<!-- /user thumbnail -->

						<!-- Navigation -->
				    	<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Navigation</h6>
								<div class="heading-elements">
									<a href="#" class="heading-text">See all &rarr;</a>
			                	</div>
							</div>

							<div class="list-group no-border no-padding-top">
								<a href="#" class="list-group-item"><i class="icon-user"></i> My profile</a>
								<a href="#" class="list-group-item"><i class="icon-cash3"></i> Balance</a>
								<a href="#" class="list-group-item"><i class="icon-tree7"></i> Connections <span class="badge bg-danger pull-right">29</span></a>
								<a href="#" class="list-group-item"><i class="icon-users"></i> Friends</a>
								<div class="list-group-divider"></div>
								<a href="#" class="list-group-item"><i class="icon-calendar3"></i> Events <span class="badge bg-teal-400 pull-right">48</span></a>
								<a href="#" class="list-group-item"><i class="icon-cog3"></i> Account settings</a>
							</div>
						</div>
						<!-- /navigation -->


						<!-- Share your thoughts -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Share your thoughts</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<form action="#">
									<div class="form-group">
										<textarea name="enter-message" class="form-control mb-15" rows="3" cols="1" placeholder="What's on your mind?"></textarea>
									</div>

									<div class="row">
			                    		<div class="col-xs-6">
				                        	<ul class="icons-list icons-list-extended mt-10">
				                                <li><a href="#" data-popup="tooltip" title="Add photo" data-container="body"><i class="icon-images2"></i></a></li>
				                            	<li><a href="#" data-popup="tooltip" title="Add video" data-container="body"><i class="icon-film2"></i></a></li>
				                                <li><a href="#" data-popup="tooltip" title="Add event" data-container="body"><i class="icon-calendar2"></i></a></li>
				                            </ul>
			                    		</div>

			                    		<div class="col-xs-6 text-right">
				                            <button type="button" class="btn btn-primary btn-labeled btn-labeled-right">Share <b><i class="icon-circle-right2"></i></b></button>
			                    		</div>
			                    	</div>
		                    	</form>
	                    	</div>
						</div>
						<!-- /share your thoughts -->


						<!-- Balance chart -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Balance changes</h6>
								<div class="heading-elements">
									<span class="heading-text"><i class="icon-arrow-down22 text-danger"></i> <span class="text-semibold">- 29.4%</span></span>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="chart-container">
									<div class="chart" id="visits" style="height: 300px;"></div>
								</div>
	                    	</div>
						</div>
						<!-- /balance chart -->


						<!-- Connections -->
				    	<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Latest connections</h6>
								<div class="heading-elements">
									<span class="badge badge-success heading-text">+32</span>
			                	</div>
							</div>

							<ul class="media-list media-list-linked pb-5">
								<li class="media-header">Office staff</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">James Alexander</span>
											<span class="media-annotation">UI/UX expert</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-success"></span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Jeremy Victorino</span>
											<span class="media-annotation">Senior designer</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-danger"></span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<div class="media-heading"><span class="text-semibold">Jordana Mills</span></div>
											<span class="text-muted">Sales consultant</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-grey-300"></span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<div class="media-heading"><span class="text-semibold">William Miles</span></div>
											<span class="text-muted">SEO expert</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-success"></span>
										</div>
									</a>
								</li>

								<li class="media-header">Partners</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Margo Baker</span>
											<span class="media-annotation">Google</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-success"></span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Beatrix Diaz</span>
											<span class="media-annotation">Facebook</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-warning-400"></span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Richard Vango</span>
											<span class="media-annotation">Microsoft</span>
										</div>
										<div class="media-right media-middle">
											<span class="status-mark bg-grey-300"></span>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<!-- /connections -->

					</div>
				</div>
				<!-- /user profile -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
    
    @include('site.paralex')
    @include('site.sponser')
@stop
@section('limitless_scripts')
    	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/ui/fullcalendar/fullcalendar.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/visualization/echarts/echarts.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/ui/drilldown.js') }}"></script>
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('site/limitless/assets/js/pages/user_pages_profile.js') }}"></script>
@stop
