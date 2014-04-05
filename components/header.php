  	<div id="navbar-main">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon icon-quill" style="font-size:30px; color:#3498db;"></span>
          </button>
          <a class="navbar-brand hidden-xs hidden-sm"><span class="icon icon-quill" style="font-size:18px; color:#3498db;"></span></a>
        </div>
        <div class="navbar-collapse collapse">
          <?php
            if(isset($_SESSION['user']))
            {
          ?>
          <ul class="nav navbar-nav">
            <li><a href="index.php?home" class="smoothScroll">Home</a></li>
            <li> <a href="index.php?log_out" class="smoothScroll"> Exit</a></li>
          </ul>
          <?php
            }
          ?>                      
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>