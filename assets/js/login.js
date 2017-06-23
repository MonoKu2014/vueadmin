var vm = new Vue({

	el: '#login',
	data: {
		user_email: '',
		user_password: '',
		message: false,
		login_success: false,
		button_text: 'Login'
	},

	methods: {

		doLogin: function(){

			if(this.user_email == '' || this.user_password == ''){

				this.message = 'Please, enter the user and password';
				
				setTimeout(function(){ 
					vm.resetData();
				}, 2000);

			} else {

				this.login_success = true;
				this.button_text = 'Logging In ...';

				$.ajax({

					type: 'post',
					url: _URL + 'login/start_session',
					data: { email : this.user_email, password : this.user_password },
					dataType: 'json',
					success: function(response){
						if(response.status == 0){
							window.location = response.url;
						} else {
							setTimeout(function(){ 
								vm.resetData();
								this.message = 'User or password are invalid';
							}, 2000);
						}
					}

				});

			}

		},

		resetData: function(){

			this.user_email = '';
			this.user_password = '';
			this.message = false;
			this.login_success = false;
			this.button_text = 'Login';

		}

	}
});