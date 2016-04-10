<!DOCTYPE html>
<html>
<head>
<title>反馈 - Rexdb ORM</title>
<?
$basePath = '';
include_once('include/import.php'); 
?>
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
									
									<div class="panel panel-primary">   
										<div class="panel-heading form-title">BUG反馈单</div>
										<ul class="list-group">
										    <li class="list-group-item list-group-item-default form-title-line">运行环境</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-6">
						                            <div class="form-group">
						                              <label>操作系统</label>
						                              <select class="form-control">
						                                 <option>Option 1</option>
						                                 <option>Option 2</option>
						                                 <option>Option 3</option>
						                                 <option>Option 4</option>
						                                 <option>Option 5</option>
						                              </select>
						                           </div>
						                          </div>
						                         <div class="col-md-6">
						                            <div class="form-group">
						                              <label>数据库</label>
						                              <select class="form-control">
						                                 <option>Option 1</option>
						                                 <option>Option 2</option>
						                                 <option>Option 3</option>
						                                 <option>Option 4</option>
						                                 <option>Option 5</option>
						                              </select>
						                           </div>
						                          </div>
						                        </div>
												<div class="row" style="margin: 0">
						                          <div class="col-md-6">
						                            <div class="form-group">
						                              <label>JDK版本</label>
						                              <select class="form-control">
						                                 <option>Option 1</option>
						                                 <option>Option 2</option>
						                                 <option>Option 3</option>
						                                 <option>Option 4</option>
						                                 <option>Option 5</option>
						                              </select>
						                           </div>
						                          </div>
						                         <div class="col-md-6">
						                            <div class="form-group">
						                              <label>JavaEE中间件</label>
						                              <select class="form-control">
						                                 <option>Option 1</option>
						                                 <option>Option 2</option>
						                                 <option>Option 3</option>
						                                 <option>Option 4</option>
						                                 <option>Option 5</option>
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
						                              <textarea class="form-control" cols="40" name="message"
														placeholder="请尽量详细描述您发现的BUG，或者您希望Rexdb作出的改进" rows="10"></textarea>
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
										    
												<button class="btn btn-cta btn-default" name="button" type="submit">
													<span class="iconfont icon-confirm" aria-hidden="true"></span>
													提交BUG
												</button> 
										    
										    </li>
										  </ul>
									</div>
									
								</div>
								<div class="tab-pane fade" id="tab-2" style="padding-top: 20px">
							
									<div class="panel panel-primary">   
										<div class="panel-heading form-title">改进建议</div>
										<ul class="list-group">
										    <li class="list-group-item  list-group-item-default form-title-line">您的建议</li>
										    <li class="list-group-item">
										    
											    <div class="row" style="margin: 0">
						                          <div class="col-md-12">
						                            <div class="form-group">
						                              <label></label>
						                              <textarea class="form-control" cols="40" name="message"
														placeholder="请尽量详细描述您发现的BUG，或者您希望Rexdb作出的改进" rows="10"></textarea>
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
										    
												<button class="btn btn-cta btn-default" name="button" type="submit">
													<span class="iconfont icon-confirm" aria-hidden="true"></span>
													提交建议
												</button> 
										    
										    </li>
										  </ul>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			
				<div id="feedback-workflow" class="row" style="margin-top: 0;">
					<div class="col-md-12">
						<h3>处理流程</h3>
						<p>我们会认真阅读每一份反馈表单，但碍于资源有限，我们可能不会向您发送处理进度和结果信息。</p>
					</div>
					<div class="col-md-12 text-center" style="margin-top: 30px">
						<img alt="反馈流程" src="style/images/feedback-workflow.png">
					</div>
				</div>
				
				
			</div>
			
			<div class="col-md-3">
				<h4>联系我们</h4>
				
				<div class="media">
			      <div class="media-left">
			        <a href="#">
			          <img class="media-object" alt="z" src="style/images/avatar-z.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;">
			        </a>
			      </div>
			      <div class="media-body">
			      	<h5>Z</h5>
			        <h5 class="media-heading"><a href="mailto:z@rex-soft.org">z@rex-soft.org</a></h5>
			      </div>
			    </div>
			    
			</div>
		</div>


	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
