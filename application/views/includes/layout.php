<!-- MENÚ LATERAL + HEADER LAYOUT -->


<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!">Profile</a></li>
  <li><a href="#!">Settings</a></li>
  <li><a href="#!">Logout</a></li>
</ul>
<nav class="teal darken-1">
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo center">
    </a>
    <ul class="right">
      <li>Welcome: Administrator</li>
      <li>
        <a class="dropdown-button" href="#!" data-activates="dropdown1">
          <i class="material-icons">perm_identity</i>
        </a>
      </li>
      <li>&nbsp;</li>
      <li>&nbsp;</li>
      <li>&nbsp;</li>
    </ul>
  </div>
</nav>

<ul id="slide-out" class="side-nav fixed">

  <li>
  <div class="user-view">
    <div class="background center">
      <img src="<?= base_url();?>assets/images/datapanel-logo.png" class="responsive-img" style="width: 80%;">
      <img src="<?= base_url();?>assets/images/user.png" class="responsive-img">
    </div>
  </div>
  </li>

  <li><a href="<?= base_url();?>panel" class="waves-effect"><i class="material-icons">home</i>Dashboard</a></li>
  <li>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header"><i class="material-icons">settings</i>Settings</a>
        <div class="collapsible-body">
          <ul>
            <li><a class="waves-effect" href="<?= base_url();?>users"><i class="material-icons">person</i>Users</a></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">polymer</i>Second</a></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">polymer</i>Third</a></li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">polymer</i>Fourth</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li><div class="divider"></div></li>
  <li><a class="subheader">Main Menu</a></li>
  <li><a href="#!" class="waves-effect"><i class="material-icons">polymer</i>Design</a></li>
  <li><a href="#!" class="waves-effect"><i class="material-icons">android</i>Mobile Structure</a></li>
  <li><div class="divider"></div></li>
  <li><a class="subheader">Secondary Menu</a></li>
  <li><a class="waves-effect" href="#!"><i class="material-icons">contacts</i>Contacts</a></li>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>


<!-- MENÚ LATERAL + HEADER LAYOUT -->