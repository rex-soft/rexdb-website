<!DOCTYPE html>
<html>
<head>
<title>quick-start</title>
<?
$basePath = '../../';
include_once('../../include/import.php'); 
?>
<link rel="stylesheet" href="../../style/document.css" type="text/css"></link>
</head>
<body>
<? include_once('../../include/navbar.php'); ?>
<? include_once('_contents.php'); ?>
<div class="container">
<div class="row">


<h1>快速入门 - 在最短的时间内学会安装、配置和使用Rexdb</h1>

<p>本文档可以帮助您在最短的时间内了解Rexdb的使用方法。</p>

<h2>目录</h2>

<ul>
<li><a href="#user-content-c1">准备运行环境</a></li>
<li><a href="#user-content-c2">全局配置文件</a></li>
<li><a href="#user-content-c3">创建一个测试表</a></li>
<li><a href="#user-content-c4">执行插入/更新/删除SQL</a></li>
<li><a href="#user-content-c5">执行批量更新</a></li>
<li><a href="#user-content-c6">查询多行记录</a></li>
<li><a href="#user-content-c7">查询单行记录</a></li>
<li><a href="#user-content-c8">启用事物</a></li>
<li><a href="#user-content-c9">调用函数和存储过程</a></li>
<li><a href="#user-content-c10">定义多个数据源</a></li>
<li><a href="#user-content-c11">使用其它数据源或JNDI</a></li>
<li><a href="#user-content-c12">更多功能</a></li>
<li><a href="#user-content-c13">附录：Rexdb可选配的第三方包</a></li>
</ul>

<h2><div id="user-content-c1">准备运行环境</div></h2>

<p>Rexdb的运行环境需要满足以下要求：</p>

<ol>
<li>JDK1.5及以上版本</li>
<li>支持JDBC驱动</li>
</ol>

<p>首先，请安装好数据库，并获取相应的jdbc驱动包，然后将Rexdb的Jar包，以及数据库的jdbc驱动包拷贝至环境变量classpath中。</p>

<p>以Mysql为例，这时您的classpath中应有以下2个jar包：</p>

<blockquote>
<p>rexdb-1.0.0.jar（或更高版本）<br>
mysql-connector-java-5.1.26-bin.jar（或其它版本的驱动）</p>
</blockquote>

<p>您还可以在classpath中增加其它Jar包，以启用Rexdb的更多功能。例如，当增加Apache Log4j后，Rexdb可以自动启用日志功能，并使用Log4j记录日志；当增加Jboss javassist包后，可以启用Rexdb的动态字节码功能，以获取更高的查询性能。详情请参见<a href="#f1">附录：Rexdb可选配的第三方包</a>。</p>

<p>准备就绪后，就可以使用Rexdb操作数据库了。本文档如无特殊说明，均以Mysql为例。</p>

<h2><div id="user-content-c2">全局配置文件</div></h2>

<p>首先需要为Rexdb创建全局配置文件。Rexdb在初始化时会加载该文件，并根据配置的内容创建连接池、方言、日志、监听等。</p>

<p>在classpath目录中新建一个文件，名称为<strong>rexdb.xml</strong>，内容为（请将方括号及其内容替换为正确的值）：</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>[数据库驱动]<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>[JDBC URL]<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>[数据库账户]<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>[数据库密码]<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>以Mysql为例，该配置文件的内容可能会是：</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>com.mysql.jdbc.Driver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:mysql://localhost:3306/rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>root<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>请确保配置文件的名称为<strong>rexdb.xml</strong>，并存储在环境变量classpath的根目录中。如果您希望放置在其它目录，则需要手动调用Rexdb的初始化接口，以完成加载工作。详情请参考<a href="http://#">Rexdb用户手册</a>。</p>

<h2><div id="user-content-c3">创建一个测试表</div></h2>

<p>为了便于后续接口的展示，首先使用Rexdb创建一个表<em>REX_TEST</em>，该表包含3个字段：</p>

<blockquote>
<p><strong>ID</strong> int(11) NOT NULL<br>
<strong>NAME</strong> varchar(30) NOT NULL<br>
<strong>CREATE_TIME</strong> time NOT NULL</p>
</blockquote>

<p>编写一个Java类，名称为<strong>TestCreate.java</strong>，内容如下：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">org.rex.DB</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.exception.DBException</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">TestCreate</span> {
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">void</span> <span class="pl-en">main</span>(<span class="pl-k">String</span>[] <span class="pl-v">args</span>) <span class="pl-k">throws</span> <span class="pl-smi">DBException</span> {
        <span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>CREATE TABLE REX_TEST (ID int(11) NOT NULL, NAME varchar(30) NOT NULL, CREATE_TIME time NOT NULL)<span class="pl-pds">"</span></span>;
        <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql);
        <span class="pl-smi">System</span><span class="pl-k">.</span>out<span class="pl-k">.</span>println(<span class="pl-s"><span class="pl-pds">"</span>table created.<span class="pl-pds">"</span></span>);
    }
}</pre></div>

<p><em>org.rex.db.DB</em>类是Rexdb的对外接口类，它提供了查询、更新、调用、事物等操作接口。<em>DB.update(String sql)</em>是该类的一个静态方法，用于在数据库中执行一个插入/更新/删除的SQL语句。</p>

<p>接下来使用命令行编译并执行该类：</p>

<pre><code>javac TestCreate.java
java TestCreate
</code></pre>

<p>如果一切顺利，控制台将输出以下语句。</p>

<pre><code>table created.
</code></pre>

<p>此时，使用查询工具连接数据库，可以确认表<em>REX_TABLE</em>已被创建。</p>

<p>需要注意的是，如果数据库的配置有误，如地址无法连接、密码错误等。在执行该类时，将会有若干秒的等待，之后才会输出错误信息。这是由于Rexdb内置的连接池具有重试机制，会在一定间隔内，反复尝试几次连接，全部失败后才会抛出异常。这是连接池的容错策略，是正常现象。</p>

<h2><div id="user-content-c4">执行插入/更新/删除SQL</div></h2>

<p>在Rexdb中，数据库的插入/更新/删除操作使用的是同一个接口。接下来以插入为例，演示接口的使用方法。</p>

<p>编写类<strong>TestUpdate</strong>，内容如下：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">java.util.Date</span>;

<span class="pl-k">import</span> <span class="pl-smi">org.rex.DB</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.exception.DBException</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">TestUpdate</span> {
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">void</span> <span class="pl-en">main</span>(<span class="pl-k">String</span>[] <span class="pl-v">args</span>) <span class="pl-k">throws</span> <span class="pl-smi">DBException</span> {
        <span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
        <span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()});
        <span class="pl-smi">System</span><span class="pl-k">.</span>out<span class="pl-k">.</span>println( i <span class="pl-k">+</span> <span class="pl-s"><span class="pl-pds">"</span> row inserted.<span class="pl-pds">"</span></span>);
    }
}</pre></div>

<p>DB.update(String sql, Object[] parameterArray)方法用于执行一个带有预编译参数的插入/更新/删除SQL。其中，parameterArray参数是一个数组，数组中的元素按照顺序对应SQL语句中的“?”标记。Rexdb将按照顺序从数组中取值，并调用JDBC相关接口赋值，然后执行SQL。</p>

<p>编译并执行该类后，控制台将输出：</p>

<pre><code>1 row inserted.
</code></pre>

<p>除Object[]数组可以作为执行SQL的参数外，Rexdb还内置了一个类<em>org.rex.db.Ps</em>，它拥有丰富的操作接口，可以用于封装预编译参数。它可以指定字段类型、按照下标赋值，还可以为存储过程调用声明输出、输入输出参数，您可以根据实际情况选用。除此之外，Rexdb还支持Map和自定义的Java实体类作为执行SQL的参数。</p>

<p>除数组外，各种类型的参数调用示例如下：</p>

<p>1）使用内置的<em>org.rex.db.Ps</em>类作为预编译参数：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()));</pre></div>

<p>2）使用<em>Map</em>作为预编译参数：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (#{id}, #{name}, #{createTime})<span class="pl-pds">"</span></span>;
<span class="pl-smi">Map</span> prameters <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">HashMap</span>();
prameters<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>id<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>);
prameters<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>name<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>);
prameters<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>createTime<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>());

<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, prameters);</pre></div>

<p>3）使用实体类作为预编译参数。首先需要编写一个表<em>REX_TEST</em>对应的实体类：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">java.util.Date</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">RexTest</span> {

    <span class="pl-k">private</span> <span class="pl-k">int</span> id;
    <span class="pl-k">private</span> <span class="pl-smi">String</span> name;
    <span class="pl-k">private</span> <span class="pl-smi">Date</span> createTime;

    <span class="pl-k">public</span> <span class="pl-en">RexTest</span>() {
    }    

    <span class="pl-k">public</span> <span class="pl-en">RexTest</span>(<span class="pl-k">int</span> <span class="pl-v">id</span>, <span class="pl-smi">String</span> <span class="pl-v">name</span>, <span class="pl-smi">Date</span> <span class="pl-v">createTime</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>id <span class="pl-k">=</span> id;
        <span class="pl-v">this</span><span class="pl-k">.</span>name <span class="pl-k">=</span> name;
        <span class="pl-v">this</span><span class="pl-k">.</span>createTime <span class="pl-k">=</span> createTime;
    }

    <span class="pl-k">public</span> <span class="pl-k">int</span> <span class="pl-en">getId</span>() {
        <span class="pl-k">return</span> id;
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">setId</span>(<span class="pl-k">int</span> <span class="pl-v">id</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>id <span class="pl-k">=</span> id;
    }

    <span class="pl-k">public</span> <span class="pl-smi">String</span> <span class="pl-en">getName</span>() {
        <span class="pl-k">return</span> name;
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">setName</span>(<span class="pl-smi">String</span> <span class="pl-v">name</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>name <span class="pl-k">=</span> name;
    }

    <span class="pl-k">public</span> <span class="pl-smi">Date</span> <span class="pl-en">getCreateTime</span>() {
        <span class="pl-k">return</span> createTime;
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">setCreateTime</span>(<span class="pl-smi">Date</span> <span class="pl-v">createTime</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>createTime <span class="pl-k">=</span> createTime;
    }
}</pre></div>

<p>然后使用该类作为执行SQL的参数：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (#{id}, #{name}, #{createTime})<span class="pl-pds">"</span></span>;
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">RexTest</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>());

<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, rexTest);</pre></div>

<p>请注意，在使用Map类、Java实体类作为预编译参数时，SQL语句中的预编译参数标记不再是JDBC标准的“?”，而是被“#{<em>参数名称</em>}”取代，Rexdb在执行时，会根据标记中的<em>参数名称</em>查找Map、实体类中对应的属性值。其中，数据库字段名称和Java对象参数名称对应规则如下所示：</p>

<pre><code>数据库字段名称       Map.Entry.key、实体类属性名称
ID                  id
NAME                name
CREATE_TIME         createTime
</code></pre>

<p>还需要额外注意的是，在使用实体类作为预编译参数时，实体类<strong>必须</strong>满足如下条件，才能被Rexdb正常调用：</p>

<ul>
<li>类是可以访问的</li>
<li>可以使用无参的构造函数创建类实例（启用动态字节码选项时需要调用）</li>
<li>参数需要有标准的getter方法</li>
</ul>

<p>为便于描述，我们总结了<em>DB.update</em>接口中SQL和参数的组合方式，如下图所示：</p>

<p><a href="resource/quick-start-update.png" target="_blank"><img src="resource/quick-start-update.png" alt="" style="max-width:100%;"></a></p>

<h2><div id="user-content-c5">执行批量更新</div></h2>

<p>当同时插入/更新/删除多行记录时，使用批量更新接口可以获得更高的执行效率。</p>

<p>编写类TestUpdateBatch，内容如下：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">java.util.Date</span>;

<span class="pl-k">import</span> <span class="pl-smi">org.rex.DB</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.Ps</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.exception.DBException</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">TestUpdateBatch</span> {
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">void</span> <span class="pl-en">main</span>(<span class="pl-k">String</span>[] <span class="pl-v">args</span>) <span class="pl-k">throws</span> <span class="pl-smi">DBException</span> {
        <span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
        <span class="pl-k">Ps</span>[] pss <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>[<span class="pl-c1">10</span>];
        <span class="pl-k">for</span> (<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">0</span>; i <span class="pl-k">&lt;</span> <span class="pl-c1">10</span>; i<span class="pl-k">++</span>)
            pss[i] <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(i, <span class="pl-s"><span class="pl-pds">"</span>name<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>());
        <span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sql, pss);
    }
}</pre></div>

<p>在上面的类中，以<em>org.rex.db.Ps</em>数组作为批量插入的参数，数组中的每个元素都代表一条记录。执行后<em>DB.batchUpdate(String sql, Ps[] pss)</em>，数据库将写入10条记录。</p>

<p>除<em>Ps</em>数组外，Rexdb还支持<em>Object</em>二维数组、<em>Map</em>数组、实体类数组以及<em>List</em>作为参数，或者直接执行多条SQL语句。使用不同类型的参数时，对应的SQL的写法与单条记录的插入/更新/删除相同，SQL语句和参数的组合关系如图所示：</p>

<p><a href="resource/quick-start-batchupdate.png" target="_blank"><img src="resource/quick-start-batchupdate.png" alt="" style="max-width:100%;"></a></p>

<h2><div id="user-content-c6">查询多行记录</div></h2>

<p>编写类<strong>TestQuery</strong>，该类用于查询出表<em>REX_TEST</em>中的所有记录：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">java.util.List</span>;

<span class="pl-k">import</span> <span class="pl-smi">org.rex.DB</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.RMap</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.exception.DBException</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">TestQuery</span> {
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">void</span> <span class="pl-en">main</span>(<span class="pl-k">String</span>[] <span class="pl-v">args</span>) <span class="pl-k">throws</span> <span class="pl-smi">DBException</span> {
        <span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>;
        <span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sql);
        <span class="pl-smi">System</span><span class="pl-k">.</span>out<span class="pl-k">.</span>println(list);
    }
}</pre></div>

<p>编译并执行后，输出结果如下：</p>

<pre><code>[{id=1, createTime=Tue Feb 16 15:05:54 CST 2016, name=test}, {id=1, createTime=Tue Feb 16 15:06:15 CST 2016, name=test}, {id=1, createTime=Tue Feb 16 15:13:41 CST 2016, name=test}]
</code></pre>

<p><em>DB.getMapList(String sql)</em>方法用于执行查询SQL，并返回一个包含有查询结果的<em>List</em>，其中数据库列名将被转换为Java命名风格。</p>

<p>其中，<em>List</em>中的元素<em>org.rex.RMap</em>是Rexdb框架提供的封装类，它继承自<em>java.util.HashMap</em>，额外提供了Java类型的自动转换功能，您可以方便的从该类中直接获取各种Java类型的值，例如直接获取<em>int</em>类型、<em>String</em>类型，或者<em>java.util.Date</em>类型的值，而不需要自行编写类型转换代码。</p>

<p>如果您希望查询出实体类列表，可以使用如下代码：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>;
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sql, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);</pre></div>

<p>如果您希望查询出符合条件的实体类，可以使用如下代码（以数组做参数为例）：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST limit ?<span class="pl-pds">"</span></span>;
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sql, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[] { <span class="pl-c1">1</span> }, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);</pre></div>

<p>如果您希望执行分页查询，并查询出实体类，可以使用如下代码：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>;
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sql, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class, <span class="pl-c1">1</span>, <span class="pl-c1">1</span>);</pre></div>

<p>接口<em>DB.getList(String sql, Class resultClass, int offset, int rows)</em>根据预设的offset和rows参数查询相应的数据库记录，offset参数表示行偏移，rows参数表示要查询的行数。Rexdb在执行查询时，会根据数据库类型自动选择相应的方言，再根据方言对SQL进行封装。例如，Mysql中，实际执行的SQL语句为：</p>

<div class="highlight highlight-source-sql"><pre><span class="pl-k">SELECT</span> <span class="pl-k">*</span> <span class="pl-k">FROM</span> REX_TEST <span class="pl-k">limit</span> ?, ?</pre></div>

<p>Rexdb已经内置了如下数据库方言：</p>

<ul>
<li>DB2</li>
<li>Derby</li>
<li>DM</li>
<li>H2</li>
<li>HSQL</li>
<li>MySQL</li>
<li>Oracle</li>
<li>PostgreSQL</li>
<li>SQLServer</li>
</ul>

<p>如果您当前使用的数据库不在列表中，可以自行实现一个方言类，并在全局配置文件的数据源配置中时指定方言。详情请查看Rexdb用户手册。</p>

<p>除示例中展示的接口外，Rexdb还提供了丰富的接口，可以应对各种使用场景。接口组合设置如下所示。</p>

<p>1）如果您没有编写结果集对应的实体类，可以使用图示中的参数组合，调用<em>DB.getMapList</em>查询出包含RMap的<em>List</em>对象：</p>

<p><a href="resource/quick-start-getmaplist.png" target="_blank"><img src="resource/quick-start-getmaplist.png" alt="" style="max-width:100%;"></a></p>

<p>2）如果您已经编写了结果集对应的实体类，则只需要在上述接口中增加一个<em>实体类.class</em>参数，并调用<em>DB.getList</em>查询出包含实体类的<em>List</em>对象，如图所示：</p>

<p><a href="resource/quick-start-getlist.png" target="_blank"><img src="resource/quick-start-getlist.png" alt="" style="max-width:100%;"></a></p>

<h2><div id="user-content-c7">查询单行记录</div></h2>

<p>Rexdb提供了一系列查询单行记录的接口，例如，如果您希望只查询一行记录，并获取实体类时，可以使用如下接口：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST limit 1<span class="pl-pds">"</span></span>;
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sql, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);</pre></div>

<p>当没有编写与结果集对应的实体类时，则可以直接查询出一个<em>RMap</em>对象：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST limit 1<span class="pl-pds">"</span></span>;
<span class="pl-smi">RMap</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sql);</pre></div>

<p>如果希望直接获取某一行中的某个字段值时，可以直接从<em>RMap</em>中取值。例如查询某张表的总记录数，可以直接调用<em>RMap.getInt(String key)</em>接口，以获取int类型的值。这可以节省您的代码量。但是请确保能够查询出记录，以防产生空指针异常。例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT count(*) as COUNT FROM REX_TEST<span class="pl-pds">"</span></span>;
<span class="pl-k">int</span> count <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sql)<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>count<span class="pl-pds">"</span></span>);</pre></div>

<p>在调用单行记录查询接口时，您需要确保SQL只能查询出0条或者1条结果。当查询出的记录数超过1行时，Rexdb无法确定您需要哪一行记录，将会抛出异常信息。</p>

<p>单行记录查询接口的SQL和参数组合设置如下：</p>

<p>1）如果您没有编写结果集对应的实体类，可以调用<em>DB.getMap</em>接口查询RMap对象：</p>

<p><a href="resource/quick-start-getmap.png" target="_blank"><img src="resource/quick-start-getmap.png" alt="" style="max-width:100%;"></a></p>

<p>2）如果您已经编写了结果集对应的实体类，则只需要在上述接口中增加一个<em>实体类.class</em>参数，并调用<em>DB.get</em>接口查询实体类的实例，如图所示：</p>

<p><a href="resource/quick-start-get.png" target="_blank"><img src="resource/quick-start-get.png" alt="" style="max-width:100%;"></a></p>

<h2><div id="user-content-c8">启用事物</div></h2>

<p>编写类TestTransaction，内容如下：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">java.util.Date</span>;

<span class="pl-k">import</span> <span class="pl-smi">org.rex.DB</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.Ps</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.exception.DBException</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">TestTransaction</span> {
    <span class="pl-k">public</span> <span class="pl-k">static</span> <span class="pl-k">void</span> <span class="pl-en">main</span>(<span class="pl-k">String</span>[] <span class="pl-v">args</span>) <span class="pl-k">throws</span> <span class="pl-smi">DBException</span> {
        <span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
        <span class="pl-c1">DB</span><span class="pl-k">.</span>beginTransaction();
        <span class="pl-k">try</span>{
            <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()));
            <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">2</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()));
            <span class="pl-c1">DB</span><span class="pl-k">.</span>commit();
        }<span class="pl-k">catch</span>(<span class="pl-smi">Exception</span> e){
            <span class="pl-c1">DB</span><span class="pl-k">.</span>rollback();
        }
    }
}</pre></div>

<p>接口<em>DB.beginTransaction()</em>用于开启一个事物，<em>DB.commit()</em>和<em>DB.rollback()</em>分别用于提交和回滚事物。Rexdb的事物是线程级别的，事物一旦开启，将在整个用户线程中有效，直到事物被提交或者回滚。</p>

<p>如果需要Jta事物，请使用如下接口：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>beginJtaTransaction();
<span class="pl-c1">DB</span><span class="pl-k">.</span>rollbackJta();
<span class="pl-c1">DB</span><span class="pl-k">.</span>commitJta();</pre></div>

<h2><div id="user-content-c9">调用函数和存储过程</div></h2>

<p>Rexdb支持函数和存储过程调用，可以处理函数或存储过程中的输入、输出、输入输出参数和返回结果。</p>

<p>例如，Mysql中有如下存储过程：</p>

<div class="highlight highlight-source-sql"><pre>CREATE PROCEDURE <span class="pl-s"><span class="pl-pds">`</span>proc<span class="pl-pds">`</span></span> ()  <span class="pl-k">BEGIN</span>
    <span class="pl-c">--do something</span>
END$$</pre></div>

<p>则可以使用Rexdb的<em>DB.call(String sql)</em>接口调用该存储过程：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call proc_in()}<span class="pl-pds">"</span></span>);</pre></div>

<p>当存储过程有输入参数时，例如：</p>

<div class="highlight highlight-source-sql"><pre>CREATE PROCEDURE <span class="pl-s"><span class="pl-pds">`</span>proc_in<span class="pl-pds">`</span></span> (<span class="pl-k">IN</span> <span class="pl-s"><span class="pl-pds">`</span>id<span class="pl-pds">`</span></span> <span class="pl-k">INT</span>)  <span class="pl-k">BEGIN</span>
    <span class="pl-c">--do something</span>
END$$</pre></div>

<p>则可以使用<em>Object</em>数组、<em>Map</em>、<em>Ps</em>对象、实体类等作为输入参数。例如，以以<em>Ps</em>对象做参数时：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call proc_in(?)}<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">1</span>));</pre></div>

<p>当存储过程定义了输出参数时，则需要使用<em>org.rex.db.Ps</em>对象声明该参数。例如，Mysql中有如下存储过程：</p>

<div class="highlight highlight-source-sql"><pre>CREATE PROCEDURE <span class="pl-s"><span class="pl-pds">`</span>proc_in_out<span class="pl-pds">`</span></span> (<span class="pl-k">IN</span> <span class="pl-s"><span class="pl-pds">`</span>i<span class="pl-pds">`</span></span> <span class="pl-k">INT</span>, OUT <span class="pl-s"><span class="pl-pds">`</span>s<span class="pl-pds">`</span></span> <span class="pl-k">INT</span>)  
<span class="pl-k">BEGIN</span> 
    <span class="pl-c">--do something</span>
END$$</pre></div>

<p>在调用存储过程时，需要使用<em>Ps</em>对象声明输出参数的位置和类型。存储过程在调用后，将返回一个<em>RMap</em>对象，在该对象中可以获取输出参数的值：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>();
ps<span class="pl-k">.</span>add(<span class="pl-c1">0</span>);
ps<span class="pl-k">.</span>addOutInt();<span class="pl-c">//声明为输出参数</span>

<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(sql, ps);</pre></div>

<p>在返回的<em>RMap</em>对象中，输出参数的键为“<em>out_参数序号</em>”。为方便调用后取值，也可以在声明输出参数时设置一个别名，例如：</p>

<div class="highlight highlight-source-java"><pre>ps2<span class="pl-k">.</span>addInOut(<span class="pl-s"><span class="pl-pds">"</span>name<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>);<span class="pl-c">//将第1个参数声明为输入输出参数，且别名为name</span></pre></div>

<p>有返回值的存储过程，在调用后也会被解析并转换为Java对象，并封装在返回的<em>RMap</em>对象中，且键为“<em>result_返回值序号</em>”。</p>

<p><a href="resource/quick-start-call.png" target="_blank"><img src="resource/quick-start-call.png" alt="" style="max-width:100%;"></a></p>

<h2><div id="user-content-c10">定义多个数据源</div></h2>

<p>如果您的应用程序需要使用多个数据库，可以在Rexdb全局配置文件<strong>rexdb.xml</strong>中配置多个数据源，例如：</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>com.mysql.jdbc.Driver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:mysql://localhost:3306/rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>root<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">id</span>=<span class="pl-s"><span class="pl-pds">"</span>oracleDs<span class="pl-pds">"</span></span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>oracle.jdbc.driver.OracleDriver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:oracle:thin:@127.0.0.1:1521:orcl<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>上面的配置文件定义了2个数据源，分别是Mysql和Oracle数据库。其中，Oracle数据源定义了<em>id="oracleDs"</em>的属性，在调用<em>org.rex.db.DB</em>的接口时，可以通过首个参数指定该数据源。未定义<em>id</em>属性的是Rexdb的默认数据源，一个应用中只能定义1个默认数据源。</p>

<p>在调用接口时，可以指定数据源，例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT 1 FROM DUAL<span class="pl-pds">"</span></span>;
<span class="pl-smi">RMap</span> map <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(<span class="pl-s"><span class="pl-pds">"</span>oracleDs<span class="pl-pds">"</span></span>, sql);</pre></div>

<p><em>org.rex.db.DB</em>类的更新、查询、调用、事物等接口均可以指定数据源，只需要将接口的第一个参数设置为配置文件中声明的<em>id</em>值即可。</p>

<h2><div id="user-content-c11">使用其它数据源或JNDI</div></h2>

<p>Rexdb内置了连接池和数据源，默认情况下使用的是默认数据源。如果您希望使用其它数据源，例如DBCP、C3P0等，可以在配置文件中进行如下定义：</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">class</span>=<span class="pl-s"><span class="pl-pds">"</span>org.apache.commons.dbcp.BasicDataSource<span class="pl-pds">"</span></span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>com.mysql.jdbc.Driver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:mysql://localhost:3306/rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>root<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>全局配置文件的“/configuration/dataSource”节点<em>class="org.apache.commons.dbcp.BasicDataSource"</em>属性定义了数据源的实现类，其子节点<em>property</em>用于配置数据源需要的属性。Rexdb在初始化时，会首先创建数据源实例，然后调用其setter方法赋值。</p>

<p>如果您希望使用JNDI，则可以进行如下配置：</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">jndi</span>=<span class="pl-s"><span class="pl-pds">"</span>java:comp/env/mysqlJNDI<span class="pl-pds">"</span></span>/&gt;
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>其中，JNDI的定义格式可能会因应用所在的容器而有所不同，如果出现找不到JNDI的错误时，请检查容器的名称定义规则。</p>

<h2><div id="user-content-c12">更多功能</div></h2>

<p>除本文档中提及的功能外，Rexdb还有更多用法和设置选项，详情请参见Rexb用户手册。</p>

<h2><div id="user-content-f1">附录：Rexdb可选配的第三方包</div></h2>

<p>Rexdb没有必须依赖的第三方包，但在运行环境中导入如下第三方包后，可以启用更多功能：</p>

<ul>
<li>日志包：可以选用Apache log4j、slf4j、Apache log4j2。当Rexdb在初始化时，检测到运行环境中存在以上jar包时，将自动开启日志功能。当运行环境中存在多种日志包时，Rexdb会按照顺序优先选择第1个日志服务。</li>
<li>连接池：Rexdb内置了一个连接池，同时也支持DBCP、C3P0等连接池，以及JNDI数据源。</li>
<li>动态字节码：Rexdb支持javassist的动态字节码功能，当运行环境中具有javassist的Jar包，并且启用了相关配置时，Rexdb将使用动态字节码方式读写Java对象，此时，调用<em>DB.get</em>接口和<em>DB.getList</em>接口时，将会获得更高效的性能。</li>
</ul>

</div>
</div>
<? include_once('../../include/footer.php'); ?>
</body>
</html>
