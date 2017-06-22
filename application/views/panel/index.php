<?php $this->load->view('includes/layout'); ?>

<div class="row">
  <div class="col col l2 m2 hide-on-small-only"></div>
  <div class="col col l5 m5 s12">
    <div class="card center graphic">
    <h5>Sales for color</h5>
      <canvas id="pie-chart" height="150"></canvas>
    </div>
  </div>

  <div class="col col l5 m5 s12">
    <div class="card center graphic">
    <h5>Products for color</h5>
      <canvas id="bar-chart" height="150"></canvas>
    </div>
  </div>
</div>



<div class="row grey lighten-3">
  <div class="col col l2 m2 hide-on-small-only"></div>

  <div class="col s12 m2">
    <div class="card green">
      <div class="card-content white-text center">
        <span class="card-title">Users</span>
        <h5><strong>50</strong></h5>
          <p>Lorem ipsum quality</p>
      </div>
      <div class="card-action green darken-4 white-text center">
        <a href="">See Users</a>
      </div>
    </div>
  </div>

  <div class="col s12 m2">
    <div class="card red">
      <div class="card-content white-text center">
        <span class="card-title">Messages</span>
        <h5><strong>34</strong></h5>
          <p>Lorem ipsum quality</p>
      </div>
      <div class="card-action red darken-4 white-text center">
        <a href="">See Messages</a>
      </div>
    </div>
  </div>

  <div class="col s12 m2">
    <div class="card cyan">
      <div class="card-content white-text center">
        <span class="card-title">Sales</span>
        <h5><strong>150</strong></h5>
          <p>Lorem ipsum quality</p>
      </div>
      <div class="card-action cyan darken-4 white-text center">
        <a href="">See Sales</a>
      </div>
    </div>
  </div>


  <div class="col s12 m2">
    <div class="card purple">
      <div class="card-content white-text center">
        <span class="card-title">Task</span>
        <h5><strong>10</strong></h5>
          <p>Lorem ipsum quality</p>
      </div>
      <div class="card-action purple darken-4 white-text center">
        <a href="">See Task</a>
      </div>
    </div>
  </div>


  <div class="col s12 m2">
    <div class="card orange">
      <div class="card-content white-text center">
        <span class="card-title">Products</span>
        <h5><strong>1250</strong></h5>
          <p>Lorem ipsum quality</p>
      </div>
      <div class="card-action orange darken-4 white-text center">
        <a href="">See Products</a>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript" src="<?php echo base_url() ?>assets/chart/graphics_load.js"></script>