<template>
  <!--查询条件-->
  <div>
    <div class="m-mian">
      <div class="tab-content martop20">
        <div class="m-select">
          <!--<query-form @query="handleQuery" :form-items="queryForm" v-model="query"></query-form>-->
        </div>
        <el-row type="flex" class="row-bg" justify="end">
          <el-form :inline="true" class="demo-form-inline">
            <el-button @click="payorderCreate" type="primary">生成兑付单</el-button>
            <!--<el-button @click="handlCallInfo" type="primary" :disabled='!multipleSelection.length'>加锁</el-button>-->
            <!--<el-button @click="handlCallInfo" type="primary" :disabled='!multipleSelection.length'>解锁</el-button>-->

            <el-button @click="handleDelete(1)" :disabled='!multipleSelection.length' type="primary">导出</el-button>

          </el-form>
        </el-row>
        <Grid :load="false" url="./menus" :selection-change="handleSelectionChange"
              :query="query" ref="grid"
              :table="table">
        </Grid>

      </div>
    </div>

    <!--<el-dialog size="large" custom-class="dialogContent" title="查看详情" v-model="dialogDetails">-->
      <!--<Grid url="/api/pay/waiting/payorder/edu" :query="detailsQuery" ref="detailsGrid" :table="detailsTable">-->
        <!--<el-form slot="bottom" :inline="true" label-width="70px">-->
          <!--<el-form-item label="金额合计" prop="userPhone">-->
            <!--<el-input size="small" style="width: 50px;" v-model="statisticsForm.totalEduCardAmount"></el-input>-->
          <!--</el-form-item>-->
        <!--</el-form>-->
      <!--</Grid>-->
    <!--</el-dialog>-->
  </div>

</template>

<script>

  import Lib from 'Lib'
  import Vue from 'vue'
  export default {
    data() {
      return {
        Lib: Lib,
        query: {},
        detailsQuery:{educationUserId:''},
        table: {
          selection: true,
          minWidth: 100,
          column: [
            {name: '编号', key: 'id'},
            {name: '标题', key: 'title'},
            {name: '路劲',width:150, key: 'path'},
            {name: '菜单图标', key: 'ioc'},

//            {
//              name: '操作', inline: true, width: 70, fixed: 'right', buttons: [
//              {text: '查看', icon: 'el-icon-edit', handle: this.handleDetails},
////              {text:'导出', icon:'el-icon-edit', handle:this.handleEdit},
////              {text:'查询处理结果', icon:'el-icon-edit', handle:this.handleEdit},
//            ]
//            }
          ]
        },
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
      this.handleQuery()
    },
    methods: {
      handleSelectionChange(val) {
        this.multipleSelection = val;
      },
      handleQuery(data){//条件查询
      this.$refs.grid.getList();//表格会返回处理后的查询条件
      },
      handlCallInfo(){   //修改
        this.dialogFormVisible = true;
      },
      handleDetails(index, item) {   //修改
        this.dialogDetails = true;
        this.detailsQuery.educationUserId = item.educationUserId;
        if(this.$refs.detailsGrid){
          this.$refs.detailsGrid.getList()
        }
      },
      handleSubmit(item) {   //删除
        var _this = this;
        var objs = [];
        this.$refs.dialogForm.validate((valid) => {
          if (valid) {
            _this.multipleSelection.forEach(item => {
              objs.push(Object.assign({
                educationCardId: item.educationCardId
              }, _this.dialogForm))
            })
            _this.request('/api/education/update/callstatus', JSON.stringify(objs), function () {
              _this.dialogFormVisible = false;
              _this.multipleSelection = [];
            });

          } else {
            return false;
          }
        });

      },
      payorderCreate(){
        var _this = this;
        var query =Object.assign({},this.query);
        for(var i in query){
          if(query[i]=== ''){
            delete query[i]
          }
        }
        this.request('/api/pay/payorder/create', query, function (data) {
          _this.$confirm('生成兑付单成功合计'+data.data+'条记录！' , '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          })
        })
      },
      getTotal(query){
        var _this = this;
        this.request('/api/pay/waiting/payorder/total', query, function (data) {
          _this.statisticsForm = data.data || {}
        })
      },
      request(url, obj, callback) {//请求数据
        var _this = this;
        let loadingInstance = this.$loading({
          lock: true,
          fullscreen: true
        });
        this.$http.post(url, obj).then(function (response) {
          var data = response.data;
          if (!!data.status) {
            callback ? callback(data) : _this.handleQuery();
          } else {
            _this.$message.error({
              message: data.message
            });
          }
          loadingInstance.close();
        }).catch(function (err) {
          loadingInstance.close();
        });
      }

    }
  }

</script>

<style>
  .el-date-editor .el-input__icon + .el-input__inner {
    padding-right: 11px;
  }

  .el-select .el-input__icon + .el-input__inner {
    padding-right: 11px;
  }

</style>





