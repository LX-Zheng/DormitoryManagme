new Vue({
    el: "#app",
    data: {
        user_name: "",
        user_dorm: "",
        bed_num: "",
        user_info: "",
        title: "我的宿舍",
        listshow: 1,
        activeName: "first",
        input: "",
        textarea: "",
        tableData: [],
        history: [],
        historyBack: [],
        userInfo: [{
            name: this.user_name,
            dorm: this.user_dorm,
            bed_num: this.bed_num
        }],
        total: '',
    },
    methods: {
        click1() {
            this.userInfo = [];
            this.title = "我的宿舍";
            this.listshow = 1;
            this.userInfo.push({
                name: this.user_name,
                dorm: this.user_dorm,
                bed_num: this.bed_num
            });
        },
        click2() {
            this.title = "宿舍报修";
            this.listshow = 2;
        },
        click3() {
            this.tableData = [];
            this.title = "维修详情";
            this.listshow = 3;
            axios.get("./controller/repair.php?", {
                params: {
                    dorm: this.user_dorm
                }
            }).then(response => {
                console.log(response.data);
                for (var i = 0; i < response.data.length; i++) {
                    this.tableData.push({
                        date: response.data[i].date,
                        name: response.data[i].name,
                        address: response.data[i].dorm,
                        detail: response.data[i].detail_name,
                        state: response.data[i].state,
                    });
                }
            }).catch(error => {
                console.log(error);
            });
        },
        click4() {
            this.history = [];
            this.title = "分数查询";
            this.listshow = 4;
            axios.get('./controller/getHistory.php?', ).then((res) => {
                //console.log(res.data);
                for (var i = 0; i < res.data.length; i++) {
                    this.historyBack.push({ record: res.data[i].name })
                }
                if (res.data.length <= 7) {
                    for (var i = 0; i < res.data.length; i++) {
                        this.history.push({ record: res.data[i].name });
                    }
                } else {
                    for (var i = 0; i < 7; i++) {
                        this.history.push({ record: res.data[i].name })
                    }
                }
                this.total = res.data.length;
            }).catch((err) => {
                console.log(err);
            })
        },
        handleClick(tab, event) {
            console.log(tab, event);
        },
        postdrom() {        
            if (this.input != "" && this.textarea != "") {
                var date = this.getNowFormatDate();
                axios
                    .get("./controller/postdram.php?", {
                        params: {
                            name: this.input,
                            content: this.textarea,
                            user_name: this.user_name,
                            user_dorm: this.user_dorm,
                            date: date
                        }
                    })
                    .then(response => {
                        console.log(response.data);
                        if (response.data) {
                            this.$message({
                                message: "提交成功",
                                type: "success"
                            });
                        } else {
                            this.$message.error("提交失败");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                this.$message.error("请填写信息");
            }
        },
        getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = year + seperator1 + month + seperator1 + strDate;
            return currentdate;
        },
        getUserInfo() {
            this.bed_num = sessionStorage.getItem("bed_num");
            this.user_name = sessionStorage.getItem("name");
            this.user_dorm = sessionStorage.getItem("dorm");
            this.user_info = this.user_name + this.user_dorm;
        },
        handleCurrentChange(val) {
            this.history = [];
            var my_val = Math.floor(this.total / 7) + 1;
            if (val == my_val) {
                //if (val == this.total / 10 + 1) {
                for (var i = (val - 1) * 7; i < this.total; i++) {
                    this.history.push({ record: this.historyBack[i].record });
                }
            } else {
                for (var i = (val - 1) * 7; i < val * 7; i++) {
                    this.history.push({ record: this.historyBack[i].record });
                }
            }
        },
        rowClick(row, event, column) {
            window.location.href = "upload/" + row.record;
        }
    },
    mounted() {
        this.getUserInfo();
        this.click1();
    }
});