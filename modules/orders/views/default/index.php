<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?= yii\helpers\Url::to(['default/index'])?>">Orders</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <ul class="nav nav-tabs p-b">
    <li class="active"><a href="#">All orders</a></li>
    <li><a href="#">Pending</a></li>
    <li><a href="#">In progress</a></li>
    <li><a href="#">Completed</a></li>
    <li><a href="#">Canceled</a></li>
    <li><a href="#">Error</a></li>
    <li class="pull-right custom-search">
      <form class="form-inline" action="<?= yii\helpers\Url::to(['default/index'])?>" method="get">
        <div class="input-group">
          <input type="text" name="search" class="form-control" value="" placeholder="Search orders">
          <span class="input-group-btn search-select-wrap">

            <select class="form-control search-select" name="search-type">
              <option value="1" selected="">Order ID</option>
              <option value="2">Link</option>
              <option value="3">Username</option>
            </select>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
        </div>
      </form>
    </li>
  </ul>
  <?php if(!empty($orders)): ?>
  <table class="table order-table">
    <thead>
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Link</th>
      <th>Quantity</th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Service
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All (894931)</a></li>
            <li><a href=""><span class="label-id">214</span>  Real Views</a></li>
            <li><a href=""><span class="label-id">215</span> Page Likes</a></li>
            <li><a href=""><span class="label-id">10</span> Page Likes</a></li>
            <li><a href=""><span class="label-id">217</span> Page Likes</a></li>
            <li><a href=""><span class="label-id">221</span> Followers</a></li>
            <li><a href=""><span class="label-id">224</span> Groups Join</a></li>
            <li><a href=""><span class="label-id">230</span> Website Likes</a></li>
          </ul>
        </div>
      </th>
      <th>Status</th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Mode
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All</a></li>
            <li><a href="">Manual</a></li>
            <li><a href="">Auto</a></li>
          </ul>
        </div>
      </th>
      <th>Created</th>
    </tr>
    </thead>
    <tbody>        
<?php foreach($orders as $order): ?>
    <tr>
      <td><?= $order->id ?></td>
      <td><?= $order->user ?></td>
      <td class="link"><?= parse_url($order->link, PHP_URL_PATH) ?></td>
      <td><?= $order->quantity ?></td>
      <td class="service">
        <span class="label-id">213</span><?= $order->service->name//$services[$order->service_id-1]['name'] ?>
      </td>
      <td><?php switch ($order->status) {
                case 0:
                    echo 'Pending';
                    break;
                case 1:
                    echo 'In progress';
                    break;
                case 2:
                    echo 'Completed';
                    break;
                case 3:
                    echo 'Canceled';
                    break;
                case 4:
                    echo 'Fail';
                    break;
      } ?></td>
      <td><?php switch ($order->mode) {
                case 0:
                    echo 'Manual';
                    break;
                case 1:
                    echo 'Auto';
                    break;
      } ?></td>
      <td><span class="nowrap"><?php echo gmdate("Y-m-d", $order->created_at); ?></span><span class="nowrap"><?php echo gmdate("H:i:s", $order->created_at); ?></span></td>
    </tr>
<?php endforeach; ?>
    
    </tbody>
  </table>
  <div class="row">
    <div class="col-sm-8">

        <?php
            if ($pages->pageCount > 1) {
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
            }
        ?>

    </div>
    <div class="col-sm-4 pagination-counters">
        <?php 
            $firstItem = $pages->offset + 1;
            echo $firstItem;
            echo ' to ';
            $lastItem = $pages->offset + $pages->pageSize;
            echo ($lastItem < $pages->totalCount ? $lastItem : $pages->totalCount);
            echo ' of ';
            echo $pages->totalCount;
        ?>
    </div>

  </div>
   <?php else : echo '<h2 class="text-center">Ничего не найдено</h2>'; ?>
   <?php endif;?>
</div>

<!-- <div><?='<pre>' . print_r($orders, true) . '</pre>'?></div> -->
