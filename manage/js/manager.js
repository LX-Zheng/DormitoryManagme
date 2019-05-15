new Vue({
    el: "#app",
    data: {
        title: '维修详情',
        listshow: 1,
        fileList: [],
        fileListBack: [],
        file_name: '',
        tableData: [],
        total: '',
    },
    methods: {
        click1() {
            this.listshow = 1;
            this.title = '维修详情';
            this.tableData = [];
            axios.get('./controller/getfix.php')
                .then((res) => {
                    console.log(res.data);
                    for (var i = 0; i < res.data.length; i++) {
                        this.tableData.push({
                            date: res.data[i].date,
                            name: res.data[i].name,
                            address: res.data[i].dorm,
                            detail: res.data[i].detail_name,
                            id: res.data[i].id
                        })
                    }
                }).catch((err) => {
                    console
                })
        },
        click2() {
            this.fileList = [];
            this.listshow = 2;
            this.title = '公布分数';
            this.getData();
        },
        beforeUpload(file) {
            let fd = new FormData();
            //fd.append('name',"iruiwe");
            fd.append('file', file);
            //console.log(fd.get("file"));
            let config = {
                header: { "Content_Type": "multipart/form-data" }
            }
            axios.post('./controller/upload.php?', fd, config)
                .then((res) => {
                    this.file_name = res.data;
                    this.insertFile();
                    this.fileList.push({ name: this.file_name });
                    this.fileListBack.push({ name: this.file_name });
                    this.total = this.fileListBack.length;
                    //this.getData();
                    //console.log(res.data);
                }).catch((err) => {
                    console.log(err);
                });
            return false;
        },
        getData() {
            axios.get('./controller/getData.php')
                .then((res) => {
                    //console.log(res.data);
                    this.total = res.data.length;
                    this.fileList = [];
                    this.fileListBack = [];
                    for (var i = 0; i < res.data.length; i++) {
                        this.fileListBack.push({ name: res.data[i].name })
                    }
                    if (res.data.length < 12) {
                        for (var i = 0; i < res.data.length; i++) {
                            this.fileList.push({ name: res.data[i].name });
                        }
                    } else {
                        for (var i = 0; i < 12; i++) {
                            this.fileList.push({ name: res.data[i].name })
                        }
                    }
                }).catch((err) => {
                    console.log(err);
                })
        },
        insertFile() {
            axios.get('./controller/insertFile.php?', {
                params: {
                    file_name: this.file_name,
                }
            }).then((res) => {
                //console.log(res);
                //this.getData();
            }).catch((err) => {
                console.log(err);
            })
        },
        handleClick(index) {
            axios.get('./controller/updateState.php?', {
                params: {
                    id: this.tableData[index].id
                }
            }).then((res) => {
                this.click1();
                console.log(res);
            }).catch((err) => {
                console.log(err);
            })
        },
        handleCurrentChange(val) {
            this.fileList = [];
            var my_val = Math.floor(this.total / 12) + 1;
            if (val == my_val) {
                //if (val == this.total / 10 + 1) {
                for (var i = (val - 1) * 12; i < this.total; i++) {
                    this.fileList.push({ name: this.fileListBack[i].name });
                }
            } else {
                for (var i = (val - 1) * 12; i < val * 12; i++) {
                    this.fileList.push({ name: this.fileListBack[i].name });
                }
            }
        }

    },
    mounted() {
        this.click1();
    },
});