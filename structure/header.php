				<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
					<div class="navbar-inner">
						<div class="container-fluid" >
							<a class="brand pull-left" href="dashboard.html" >OLPESA</a>
							<ul class="nav navbar-nav" id="mobile-nav" hidden="true" >
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="glyphicon glyphicon-list-alt"></span> Gestión <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="form_elements.html">Form elements</a></li>
										<li><a href="form_extended.html">Extended form elements</a></li>
										<li><a href="form_validation.html">Form Validation</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="glyphicon glyphicon-th"></span> Proceso <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="alerts_btns.html">Alerts &amp; Buttons</a></li>
										<li><a href="icons.html">Icons</a></li>
										<li><a href="notifications.html">Notifications</a></li>
										<li><a href="tables.html">Tables</a></li>
										<li><a href="tables_more.html">Tables (more examples)</a></li>
										<li><a href="tabs_accordion.html">Tabs &amp; Accordion</a></li>
										<li><a href="tooltips.html">Tooltips, Popovers</a></li>
										<li><a href="typography.html">Typography</a></li>
										<li><a href="widgets.html">Widget boxes</a></li>
										<li class="dropdown">
											<a href="#">Sub menu <b class="caret-right"></b></a>
											<ul class="dropdown-menu">
												<li><a href="#">Sub menu 1.1</a></li>
												<li><a href="#">Sub menu 1.2</a></li>
												<li><a href="#">Sub menu 1.3</a></li>
												<li>
													<a href="#">Sub menu 1.4 <b class="caret-right"></b></a>
													<ul class="dropdown-menu">
														<li><a href="#">Sub menu 1.4.1</a></li>
														<li><a href="#">Sub menu 1.4.2</a></li>
														<li><a href="#">Sub menu 1.4.3</a></li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="glyphicon glyphicon-wrench"></span> Reporte <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="charts.html">Charts</a></li>
										<li><a href="calendar.html">Calendar</a></li>
										<li><a href="datatable.html">Datatable</a></li>
										<li><a href="dynamic_tree.html">Dynamic tree</a></li>
										<li><a href="editable_elements.html">Editable elements</a></li>
										<li><a href="file_manager.html">File Manager</a></li>
										<li><a href="floating_header.html">Floating List Header</a></li>
										<li><a href="google_maps.html">Google Maps</a></li>
										<li><a href="gallery.html">Gallery Grid</a></li>
										<li><a href="wizard.html">Wizard</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="glyphicon glyphicon-file"></span> Configuración <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="blank.html"> Blank</a></li>
										<li><a href="blog_page.html"> Blog Page</a></li>
										<li><a href="chat.html"> Chat</a></li>
										<li><a href="error_404.html"> Error 404</a></li>
										<li><a href="invoice.html"> Invoice</a></li>
										<li><a href="mailbox.html">Mailbox</a></li>
										<li><a href="search_page.html">Search page</a></li>
										<li><a href="user_profile.html">User profile</a></li>
										<li><a href="user_static.html">User profile (static)</a></li>
									</ul>
								</li>
							</ul>
							<ul class="nav navbar-nav user_menu pull-right">
								<li class="hidden-phone hidden-tablet">
									<div class="nb_boxes clearfix">
										<a data-toggle="modal" data-backdrop="static" href="#myMail" data-placement="bottom" data-container="body" class="label bs_ttip" title="New messages">25 <i class="splashy-mail_light"></i></a>
										<a data-toggle="modal" data-backdrop="static" href="#myTasks" data-placement="bottom" data-container="body" class="label bs_ttip" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
									</div>
								</li>
								<li class="divider-vertical hidden-sm hidden-xs"></li>
								<li class="divider-vertical hidden-sm hidden-xs"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user_avatar.png" alt="" class="user_avatar">Elvis Mendoza<b class="caret"></b></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="user_profile.html">Mi Perfil</a></li>
										<li><a href="javascrip:void(0)">Permisos</a></li>
										<li class="divider"></li>
										<li><a href="login.html">Salir</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>

				<div class="modal fade" id="myMail">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title">New Messages</h3>
							</div>
							<div class="modal-body">
								<table class="table table-condensed table-striped" data-provides="rowlink">
									<thead>
										<tr>
											<th>Sender</th>
											<th>Subject</th>
											<th>Date</th>
											<th>Size</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Declan Pamphlett</td>
											<td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
											<td>23/05/2015</td>
											<td>25KB</td>
										</tr>
										<tr>
											<td>Erin Church</td>
											<td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
											<td>24/05/2015</td>
											<td>15KB</td>
										</tr>
										<tr>
											<td>Koby Auld</td>
											<td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
											<td>25/05/2015</td>
											<td>28KB</td>
										</tr>
										<tr>
											<td>Anthony Pound</td>
											<td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
											<td>25/05/2015</td>
											<td>33KB</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default">Go to mailbox</button>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="myTasks">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title">New Tasks</h3>
							</div>
							<div class="modal-body">
								<table class="table table-condensed table-striped" data-provides="rowlink">
									<thead>
										<tr>
											<th>id</th>
											<th>Summary</th>
											<th>Updated</th>
											<th>Priority</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>P-23</td>
											<td><a href="javascript:void(0)">Admin should not break if URL…</a></td>
											<td>23/05/2015</td>
											<td><span class="label label-danger">High</span></td>
											<td>Open</td>
										</tr>
										<tr>
											<td>P-18</td>
											<td><a href="javascript:void(0)">Displaying submenus in custom…</a></td>
											<td>22/05/2015</td>
											<td><span class="label label-warning">Medium</span></td>
											<td>Reopen</td>
										</tr>
										<tr>
											<td>P-25</td>
											<td><a href="javascript:void(0)">Featured image on post types…</a></td>
											<td>22/05/2015</td>
											<td><span class="label label-success">Low</span></td>
											<td>Updated</td>
										</tr>
										<tr>
											<td>P-10</td>
											<td><a href="javascript:void(0)">Multiple feed fixes and…</a></td>
											<td>17/05/2015</td>
											<td><span class="label label-warning">Medium</span></td>
											<td>Open</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default">Go to task manager</button>
							</div>
						</div>
					</div>
				</div>