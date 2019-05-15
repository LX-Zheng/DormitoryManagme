new Vue({
    el: '#login',
    data: {
        account: '',
        password: '',
    },
    methods: {
        login() {
            axios.get('./controller/login.php?', {
                params: {
                    account: this.account,
                    password: this.password
                }
            }).then((response) => {
                if (response.data === false) {
                    console.log("false");
                }else if(response.data === true){
                    window.location.href = "manager.html";
                } else {
                    sessionStorage.setItem('name', response.data[0].name);
                    sessionStorage.setItem('dorm', response.data[0].dorm);
                    sessionStorage.setItem('bed_num', response.data[0].bed_num);
                    console.log(response.data);
                    window.location.href = "main.html";
                }
            }).catch((error) => {
                console.log(error);
            });
        }
    },
})