<?php $this->load->view('includes/layout'); ?>

<div id="app">
	<div class="row">
	  <div class="col col l2 m2 hide-on-small-only"></div>
	  <div class="col col l10 m10 s12">
		<h3>Users</h3>
		<button class="btn" v-on:click="openAddModal">
			Add User
			<i class="material-icons right">add</i>
		</button>
	  </div>
	</div>

	<div class="row">
	  <div class="col col l2 m2 hide-on-small-only"></div>
	  <div class="col col l10 m10 s12">


	      <table class="bordered striped highlight responsive-table">
	        <thead>
	          <tr>
          		<th>ID</th>
          		<th>Name</th>
            	<th>Email</th>
            	<th>Status</th>
            	<th>Actions</th>
	          </tr>
	        </thead>

	        <tbody>
	          <tr v-for="user in user_list">
	          	<td>{{ user.id_user }}</td>
	            <td>{{ user.name_user }}</td>
	            <td>{{ user.email_user }}</td>
	            <td>{{ user.status_user }}</td>
	            <td>
	            	<button class="btn btn-small" v-on:click="openEditModal(user.id_user)"><i class="material-icons">edit</i></button>
	            	<button class="btn btn-small red"><i class="material-icons">delete</i></button>
	            </td>
	          </tr>
	        </tbody>
	      </table>


		  <!-- Modal Structure -->
		  <div id="modal1" class="modal modal-fixed-footer">
		    <div class="modal-content">
		      <h4>{{ action }} User</h4>

				<div class="row">
				  <div class="col s12">
				    <transition name="fade">
				  	<p v-if="message">{{ message }}</p>
				    </transition>
				  </div>
				</div>

				  <div class="row">
				    <form class="col s12">
				      <div class="row">
				        <div class="input-field col s6">
				          <input id="name" type="text" class="validate" v-model="name">
				          <label for="name">Complete Name(*)</label>
				        </div>
				        <div class="input-field col s6">
				          <input id="email" type="email" class="validate" v-model="email">
				          <label for="email">Email(*)</label>
				        </div>
				      </div>


				      <div class="row">
				        <div class="input-field col s6">
				          <input id="password" type="password" class="validate" v-model="password">
				          <label for="password">User password(*)</label>
				        </div>
				        <div class="input-field col s6">
						    <select v-model="status">
						      <option disabled value="">Please select one(*)</option>
						      <option value="1">Active</option>
						      <option value="0">Inactive</option>
						    </select>
				        </div>
				      </div>

		              <transition name="fade">
		              	<div v-if="save_success">
		                <div class="progress">
		                    <div class="indeterminate"></div>
		                </div>
		                </div>
		              </transition>

				    </form>
				  </div>
		    </div>
		    <div class="modal-footer">
		    	<!-- BOTON AGREGAR -->
		    	<button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
		    	<span v-if="insert">
		    		<a href="#" v-on:click.prevent="saveUser" class="modal-action waves-effect waves-green btn">{{ button_text }}</a>
		    	</span>
		    	
		    	<!-- BOTON EDITAR -->
		    	<span v-if="!insert">
		    		<a href="#" v-on:click.prevent="saveEditUser" class="modal-action waves-effect waves-green btn">{{ button_text }}</a>
		    	</span>
		    </div>
		  </div>


	  </div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/users.js"></script>