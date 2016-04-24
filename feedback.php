<!DOCTYPE html>
<html>
<head>
<title>反馈 - Rexdb ORM</title>
<?
$basePath = '';
include_once('include/import.php'); 
?>
<script type="text/javascript" src="<?=$basePath?>ui/js/bootstrapValidator.mix-0.5.1.js"></script>
<style>
p {
	font-size: 16px;
}

blockquote {
	font-size: 15.5px;
}

li {
	list-style-type: disc;
}
</style>
</head>
<body>
<? 
$activeMenu = 'feedback';
include_once('include/navbar.php'); 
?>

<section id="header" class="top-div">
	<div class="container" >
		<div class="row" style="margin-top: 20px; margin-bottom: 30px">
			<div class="col-md-12">
				<h3>感谢您的支持</h3>
				<p>Rexdb是免费、开源的软件，只能提供极其有限的技术支持。
				但同时也是一个长期维护的项目，我们希望搜集更多的问题和建议，使其更加完善。</p>
			</div>
		</div>
	</div>
</section>

<div class="container">
		
		<div id="feedback-bug" class="row">
			<div class="col-md-9">
				<div class="row" style="margin-top: 0; margin-bottom: 20px">
					<div class="col-md-12">
						<h3>提交问题</h3>
						<p>
							如果您在开发和生产环境中发现了BUG。包括轻微的和严重的、确认和怀疑的、频繁和偶尔发生的问题，都可以向我们反馈。
							我们通常会在修复一定数量的错误后，集中发布一个升级版本。
							但如果问题严重，例如发现了安全漏洞、影响系统稳定性的问题等，也会立刻进行一次版本升级。
						</p>
						<p>
							当您认为Rexdb需要改进时，包括功能、性能、接口设计等方面，请向我们提出改进建议。
							在制定下一版本的升级计划时，这些建议会被评估。
						</p>
					</div>
				</div>
				
				<div class="row" style="margin-top: 0; margin-bottom: 0">
					<div class="col-md-12">
						<div class="tab-style-1">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-1" data-toggle="tab">
									<span class="iconfont icon-bug" aria-hidden="true"></span>
									发现BUG
								</a></li>
								<li class=""><a href="#tab-2" data-toggle="tab">
									<span class="iconfont icon-support" aria-hidden="true"></span>
									改进建议
								</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane row-fluid fade active in" id="tab-1" style="padding-top: 20px">
									<form id="bug-form" method="post" action="#">
									<input type="hidden" name="type" value="bug"/>
									<div class="panel panel-primary">   
										<div class="panel-heading form-title">BUG反馈单</div>
										<ul class="list-group">
										    <li class="list-group-item list-group-item-default form-title-line">运行环境</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-6">
						                            <div class="form-group">
						                              <label>操作系统</label>
						                              <select name="system" class="form-control">
						                              	 <option value="">请选择</option>
						                                 <option value="linux">Linux</option>
						                                 <option value="windows">Windows</option>
						                                 <option value="macos">MacOS</option>
						                                 <option value="others">其它</option>
						                              </select>
						                           </div>
						                          </div>
						                         <div class="col-md-6">
						                            <div class="form-group">
						                              <label>数据库</label>
						                              <select name="database" class="form-control">
						                              	 <option value="">请选择</option>
						                                 <option value="oracle">Oracle</option>
						                                 <option value="mysql">Mysql</option>
						                                 <option value="mariadb">MariaDB</option>
						                                 <option value="sqlserver">SQL Server</option>
						                                 <option value="postgresql">PostgreSQL</option>
						                                 <option value="db2">DB2</option>
						                                 <option value="h2">H2</option>
						                                 <option value="derby">Derby</option>
						                                 <option value="hsqldb">Hsqldb</option>
						                                 <option value="dm">达梦</option>
						                                 <option value="kinges">金仓</option>
						                                 <option value="oscar">神通</option>
						                                 <option value="others">其它</option>
						                              </select>
						                           </div>
						                          </div>
						                        </div>
												<div class="row" style="margin: 0">
						                          <div class="col-md-6">
						                            <div class="form-group">
						                              <label>JDK版本</label>
						                              <select name="jdk" class="form-control">
						                                 <option value="">请选择</option>
						                                 <option value="1.5">JDK 1.5</option>
						                                 <option value="1.6">JDK 1.6</option>
						                                 <option value="1.7">JDK 1.7</option>
						                                 <option value="1.8">JDK 1.8 或更高</option>
						                                 <option value="others">其它</option>
						                              </select>
						                           </div>
						                          </div>
						                         <div class="col-md-6">
						                            <div class="form-group">
						                              <label>Java EE 中间件（如果有）</label>
						                              <select name="container" class="form-control">
						                                 <option value="">请选择</option>
						                                 <option value="tomcat">Tomcat</option>
						                                 <option value="jboss">JBoss/WildFly</option>
						                                 <option value="weblogic">WebLogic</option>
						                                 <option value="jetty">Jetty</option>
						                                 <option value="others">其它</option>
						                              </select>
						                           </div>
						                          </div>
						                        </div>
										    
										    </li>
										    <li class="list-group-item  list-group-item-default form-title-line">问题描述</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-12">
						                            <div class="form-group">
						                              <label></label>
						                              <textarea name="detail" class="form-control" cols="40" name="detail"
														placeholder="请尽量详细描述您发现的BUG，包括异常现象、异常堆栈等" rows="10"></textarea>
						                           </div>
						                          </div>
						                        </div>
										    
										    </li>
										    <li class="list-group-item  list-group-item-default form-title-line">联系方式</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-6">
						                            <div class="form-group">
						                              <label>姓名</label>
						                              <input class="form-control" name="name" placeholder="您的称谓" size="30" type="text" />
						                           </div>
						                          </div>
						                         <div class="col-md-6">
						                            <div class="form-group">
						                              <label>邮箱</label>
						                              <input class="form-control" name="email" placeholder="您的邮箱" size="30" type="text" />
						                           </div>
						                          </div>
						                        </div>
										    
										    </li>
										    <li class="list-group-item list-group-item-default form-title-line" style="text-align: right">
										    
									    		<button id="submit-bug" class="btn btn-cta btn-default" type="submit">
													<span class="iconfont icon-confirm" aria-hidden="true"></span>
													提交BUG
												</button>
												
												<span id="bug-label">验证码错误，请重新输入</span>
												<img id="bug-code" src="" title="点击刷新验证码" data-toggle="tooltip" data-placement="top"/>
									    		<input id="bug-code-input" class="form-control" name="code" placeholder="验证码" size="4" type="text"
									    		 title="请输入左侧验证码" data-toggle="tooltip" data-placement="top"/>
													
										    </li>
										  </ul>
									</div>
									</form>
								</div>
								<div class="tab-pane fade" id="tab-2" style="padding-top: 20px">
									<form id="suggest-form" method="post" action="#">
									<input type="hidden" name="type" value="suggest"/>
									<div class="panel panel-primary">   
										<div class="panel-heading form-title">改进建议</div>
										<ul class="list-group">
										    <li class="list-group-item  list-group-item-default form-title-line">您的建议</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-12">
						                            <div class="form-group">
						                              <label></label>
						                              <textarea class="form-control" cols="40" name="detail"
														placeholder="请告诉我们您希望Rexdb作出的改进" rows="10"></textarea>
						                           </div>
						                          </div>
						                        </div>
										    
										    </li>
										    <li class="list-group-item  list-group-item-default form-title-line">联系方式</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-6">
						                            <div class="form-group">
						                              <label>姓名</label>
						                              <input class="form-control" id="msg_name" name="name" placeholder="您的称谓" size="30" type="text" />
						                           </div>
						                          </div>
						                         <div class="col-md-6">
						                            <div class="form-group">
						                              <label>邮箱</label>
						                              <input class="form-control" id="msg_email" name="email" placeholder="您的邮箱" size="30" type="text" />
						                           </div>
						                          </div>
						                        </div>
										    
										    </li>
										    <li class="list-group-item list-group-item-default form-title-line" style="text-align: right">
										    
										    	<button id="submit-suggest" class="btn btn-cta btn-default" type="submit">
													<span class="iconfont icon-confirm" aria-hidden="true"></span>
													提交建议
												</button>
												
												<span id="suggest-label">验证码错误，请重新输入</span>
												<img id="suggest-code" src="" title="点击刷新验证码" data-toggle="tooltip" data-placement="top"/>
									    		<input id="suggest-code-input" class="form-control" name="code" placeholder="验证码" size="4" type="text"
									    		 title="请输入左侧验证码" data-toggle="tooltip" data-placement="top"/>
										    
										    </li>
										  </ul>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Modal -->
					<div class="modal fade" id="thank-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">感谢</h4>
					      </div>
					      <div class="modal-body" id="thank-modal-body">
					        
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-primary" data-dismiss="modal">好的</button>
					      </div>
					    </div>
					  </div>
					</div>

				</div>
				
							
				<div class="row">
					<div class="col-md-12">
						<h3>后续的处理</h3>
						<p>我们会认真阅读每一份表单，但碍于资源有限，我们可能不会向您发送处理进度和结果信息。</p>
					</div>
				</div>
				
				<!-- <div class="row">
					<div class="col-md-12">
						<h3>Rexdb的历史</h3>
						<p>Rexdb框架最早开发于2007年。
						在那之前，作为技术团队的负责人，作者一直困扰于Java持久层框架的笨重和低效，难以忍受研发团队在进行了大量培训后，仍然无法高效、高质量的完成软件项目和产品。
						于是自行研发了一个简易的ORM框架，并在下一个项目中取得了巨大的成功，此后便逐步应用在了多个省级、国家级大型项目中，直至今天。
						</p>
						<p>在历经了多年的改版后，虽然用户群体在不断增加，但框架还是在慢慢面临没有新反馈、没有新需求的尴尬境地。
						作者也终于意识到，只有在更大范围发布，才能让框架具备长久的生命力。
						</p>
						<p>于是，作者将原有的框架进行了重写和更名，并将版本号倒退回1.0.0，希望能有一个新的开始。
						</p>
					</div>
				</div>
 -->
				
			</div>
			
			<div class="col-md-3">
				<h4>开发者团队</h4>
				
				<div class="media">
			      <div class="media-left">
			        <a href="#">
			          <img class="media-object" alt="z" src="ui/images/avatar-z.jpg" data-holder-rendered="true">
			        </a>
			      </div>
			      <div class="media-body">
			      	<h5>z</h5>
			        <h5 class="media-heading"><a href="mailto:z@rex-soft.org">z@rex-soft.org</a></h5>
			      </div>
			    </div>
			    
			</div>
		</div>
	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
