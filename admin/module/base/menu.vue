<template>
    <!--查询条件-->
    <div class="mian">
        <el-row type="flex" class="row-bg" justify="end">
            <el-form :inline="true" class="demo-form-inline">
                <el-button @click="handleCreate" type="primary">新增</el-button>
                <!--<el-button @click="handlCallInfo" type="primary" :disabled='!multipleSelection.length'>加锁</el-button>-->
                <!--<el-button @click="handlCallInfo" type="primary" :disabled='!multipleSelection.length'>解锁</el-button>-->

                <!--<el-button @click="handleDelete(1)" :disabled='!multipleSelection.length' type="primary">导出</el-button>-->

            </el-form>
        </el-row>
        <div class="center">

            <el-tree class="menuTree" highlight-current :data="treeData" :props="defaultProps"
                     @node-click="handleNodeClick"></el-tree>
            <Grid class="grid" :load="false" url="admin/menus" :selection-change="handleSelectionChange"
                  :query="query" ref="grid"
                  :table="table">
            </Grid>

        </div>

        <el-dialog :title="title" v-model="dialogForm">
            <el-form :model="menuDetails" :rules="rules" ref="dialogForm" label-width="140px">
                <el-form-item label="名称" prop="title">
                    <el-input v-model="menuDetails.title"></el-input>
                </el-form-item>
                <el-form-item label="父级" prop="parentId">
                    <SelectTree nodeKey="id" :props="defaultProps" v-model="menuDetails.parentId" :treeData="treeData"></SelectTree>

                </el-form-item>
                <el-form-item label="介绍" prop="introduce">
                    <el-input v-model="menuDetails.introduce"></el-input>
                </el-form-item>
                <el-form-item label="路径" prop="path">
                    <el-input v-model="menuDetails.path"></el-input>
                </el-form-item>
                <el-form-item label="图标" prop="ioc">
                    <el-input v-model="menuDetails.ioc"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click.native="dialogForm = false">取 消</el-button>
                <el-button type="primary" @click.native="handleSubmit()">确 定</el-button>
            </div>
        </el-dialog>
    </div>

</template>

<script>

    import Lib from 'Lib'
    import Vue from 'vue'
    export default {
        data() {
            return {
                Lib: Lib,
                title:'新增菜单',
                query: {
                    id:0
                },
                treeData:[],
                defaultProps: {
                    id:'id',
                    children: 'submenus',
                    label: 'title'
                },
                menuDetails: {
                    title:'',
                    path:'',
                    ioc:'',
                    introduce:'',
                    parentId:''
                },

                rules: {
                    parentId: [
                        {required: true, message: '请选择', trigger: 'change'}
                    ],
                    title: [
                        {required: true, message: '请输入', trigger: 'blur'}
                    ],
                    introduce: [
                        {required: true, message: '请输入', trigger: 'blur'}
                    ],
                    path: [
                        {required: true, message: '请输入', trigger: 'blur'}
                    ],
                    ioc: [
                        {required: true, message: '请输入', trigger: 'blur'}
                    ]
                },
                table: {
                    selection: true,
                    minWidth: 100,
                    column: [
                        {name: '编号', key: 'id'},
                        {name: '标题', key: 'title'},
                        {name: '介绍', key: 'introduce'},
                        {name: '路劲', width: 150, key: 'path'},
                        {name: '菜单图标', key: 'ioc'},
                        {name:'操作',inline:true,width:240,fixed:'right',buttons:[
                            {text:'修改', icon:'', handle:this.handleEdit},
                            {text:'删除', icon:'', handle:this.handleDelete}
                        ]}
                    ]
                },
                dialogForm:false,
                detailType: 1,
                detailType1: 0,
                templateMsgId: '',
                dialogDetails: false,
                statisticsForm: {},
                multipleSelection: [],
            }
        },
        components: {},

        computed: {},
        filters: {},

        mounted(){

            var _this = this;
            this.$http.get('admin/userMenus').then(function (response) {
                var data = response.data;
                if (!!data.status) {
                    _this.treeData=[{
                        id:0,
                        title:'主页面',
                        submenus:data.data
                    }]
                } else {
                    _this.$message.error({
                        message: data.message
                    });
                }
            }).catch(function (err) {
            });
            this.handleQuery()
        },
        methods: {
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            handleNodeClick(val) {
                this.query.id = val.id
                this.handleQuery()
            },

            handleQuery(data){//条件查询
                this.$refs.grid.getList();//表格会返回处理后的查询条件
            },
            handleDelete(index,item){   //删除
                var _this =this;
                _this.$confirm('确定删除'+ item.title +'!', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(action => {
                    _this.$http.delete('admin/menu?id='+item.id).then(function (response) {
                        var data = response.data;
                        if (!!data.status) {
                          _this.handleQuery();
                        } else {
                            _this.$message.error({
                                message: data.message
                            });
                        }
                        _this.handleQuery()
                    })
                })
            },
            handleEdit(index,item){   //修改
                this.menuDetails = Object.assign({},item,{parentId:item.parentId +''});
                this.dialogForm = true;
            },
            handleCreate(){   //新增
                this.menuDetails ={
                    title:'',
                    path:'',
                    ioc:'',
                    introduce:'',
                    parentId:this.query.id +''
                }
                this.dialogForm = true;
            },
            handleSubmit(method) {   //
                var _this = this;
                this.$refs.dialogForm.validate((valid) => {
                    var method =_this.menuDetails.id?'put':'post';
                    if (valid) {
                        _this.$http[method]('admin/menu', _this.menuDetails).then(function (response) {
                            var data = response.data;
                            if (!!data.status) {
                                _this.dialogForm = false;
                                 _this.handleQuery();
                            } else {
                                _this.$message.error({
                                    message: data.message
                                });
                            }
                            loadingInstance.close();
                        }).catch(function (err) {
                            loadingInstance.close();
                        });
                    } else {
                        return false;
                    }
                });

            },
//            payorderCreate(){
//                var _this = this;
//                var query = Object.assign({}, this.query);
//                for (var i in query) {
//                    if (query[i] === '') {
//                        delete query[i]
//                    }
//                }
//                this.request('/api/pay/payorder/create', query, function (data) {
//                    _this.$confirm('生成兑付单成功合计' + data.data + '条记录！', '提示', {
//                        confirmButtonText: '确定',
//                        cancelButtonText: '取消',
//                        type: 'warning'
//                    })
//                })
//            },
//            getTotal(query){
//                var _this = this;
//                this.request('/api/pay/waiting/payorder/total', query, function (data) {
//                    _this.statisticsForm = data.data || {}
//                })
//            },
//            request(url,obj,callback) {//请求数据
//                var _this = this;
//                let loadingInstance = this.$loading({
//                    lock: true,
//                    fullscreen: true
//                });
//                this.$http.post(url, obj).then(function (response) {
//                    var data = response.data;
//                    if (!!data.status) {
//                        callback ? callback(data) : _this.handleQuery();
//                    } else {
//                        _this.$message.error({
//                            message: data.message
//                        });
//                    }
//                    loadingInstance.close();
//                }).catch(function (err) {
//                    loadingInstance.close();
//                });
//            }

        }
    }

</script>

<style scoped lang="sass">
    .mian{
        flex:1;
        display: flex;
        flex-direction: column;
    }
    .center{
        flex:1;
        display: flex;
        margin-top: 5px;
        .grid{
            flex: 1;
        }
    }
    .menuTree{
        margin-right: 5px;
        width: 200px;
    }
    .el-date-editor .el-input__icon + .el-input__inner {
        padding-right: 11px;
    }

    .el-select .el-input__icon + .el-input__inner {
        padding-right: 11px;
    }

</style>





