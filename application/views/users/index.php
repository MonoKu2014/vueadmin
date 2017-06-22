<?php $this->load->view('includes/layout'); ?>

<div class="row">
  <div class="col col l2 m2 hide-on-small-only"></div>
  <div class="col col l10 m10 s12">

  </div>
</div>

<div class="row">
  <div class="col col l2 m2 hide-on-small-only"></div>
  <div class="col col l10 m10 s12" id="app">


      <table class="bordered stripped highlight">
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Name</th>
              <th>Item Price</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>
          </tr>
        </tbody>
      </table>


<div id="people">
  <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
</div>
      


  </div>
</div>


<script type="text/javascript" src="<?php echo base_url() ?>assets/vue/vue-tables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/users.js"></script>