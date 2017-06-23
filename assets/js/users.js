var vm = new Vue({

    el: '#app',
    data: {
      user_list: [],
      save_success: false,
      name: '',
      email: '',
      password: '',
      status: '',
      message: false,
      button_text: 'Save user',
      action: 'Add',
      insert: true,
      id_user: ''
    },

    methods: {

        getUsers: function(){
          this.$http.get('users/lists')
            .then(response => {
              this.user_list = response.body;
            })
            .catch(response => {
              // Error Handling
            });        
        },


        openAddModal: function(){
            vm.resetData();
            $('#modal1').modal('open');
            $('#name').focus();
        },


        saveUser: function(){
            if(this.name == '' || this.email == '' || this.password == '' || this.status == ''){

                this.message = 'Please, enter all fields required';

            } else {

                this.save_success = true;
                this.button_text = 'Saving user ...';

                $.ajax({

                    type: 'post',
                    url: _URL + 'users/edit_user',
                    data: { email : this.email, password : this.password, name: this.name, status: this.status },
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 0){
                            vm.getUsers();
                            vm.resetData();
                            $('#modal1').modal('close');
                        } else {
                            setTimeout(function(){ 
                                vm.resetData();
                                this.message = 'User has not been saved';
                            }, 3000);
                        }
                    }

                });

            }
        },


        openEditModal: function(id_user){
            this.$http.get('users/get_user/' + id_user)
            .then(response => {
                this.name = response.body[0].name_user;
                this.email = response.body[0].email_user;
                this.password = response.body[0].password_user;
                this.status = response.body[0].status_user;
                this.button_text = 'Edit user';
                this.action = 'Edit';
                this.insert = false;
                this.id_user = id_user;
                $('#modal1').modal('open');
                $('#name').focus();
            })
            .catch(response => {
              // Error Handling
            });
        },


        saveEditUser: function()
        {
            if(this.name == '' || this.email == '' || this.password == '' || this.status == ''){

                this.message = 'Please, enter all fields required';

            } else {

                this.save_success = true;
                this.button_text = 'Editing user ...';

                $.ajax({

                    type: 'post',
                    url: _URL + 'users/edit_user',
                    data: { email : this.email, password : this.password, name: this.name, status: this.status, id_user: this.id_user },
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 0){
                            vm.getUsers();
                            vm.resetData();
                            $('#modal1').modal('close');
                        } else {
                            setTimeout(function(){ 
                                vm.resetData();
                                this.message = 'User has not been edited';
                            }, 3000);
                        }
                    }

                });

            }
        },


        resetData: function(){
            this.name = '';
            this.email = '';
            this.password = '';
            this.status = '';
            this.message = false;
            this.save_success = false;
            this.button_text = 'Save user';
            this.action = 'Add';
            this.insert = true;
            this.id_user = '';
        }


    },

    created: function(){
        this.getUsers();
    }

});