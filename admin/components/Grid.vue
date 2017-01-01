<template>
  <div
    v-loading="loading2"
    element-loading-text="拼命加载中">
    <el-table
      :data="gridData"
      border
      style="width: 100%"
      :height="height"
      @selection-change="selectionChange">
      <el-table-column
        v-if="table.selection"
        type="selection"
        width="50">
      </el-table-column>
      <el-table-column :min-width="table.minWidth" v-for="item in table.column"
                       inline-template
                       :label="item.name"
                       :fixed="item.fixed"
                       :width="item.width?item.width:''">
        <div>
          <div v-if="item.buttons && item.buttons.length">
            <el-button v-for="but in item.buttons" size="small" v-if="!but.isShow || but.isShow(row)"
                       @click="but.handle&&but.handle($index, row)">
              <i v-if="but.icon" :class="but.icon"></i> {{but.text}}
            </el-button>
          </div>
          <a v-else-if="item.handle" class="handle-a" @click="item.handle && item.handle($index, row)">
            {{row[item.key]}}
          </a>
          <div v-else-if="!!item.filter">
            {{ filter(item.filter,row[item.key])}}
          </div>
          <a v-else>
            {{row[item.key]}}
          </a>
        </div>
      </el-table-column>
    </el-table>

    <el-row type="flex" class="row-bg grid-row-bg" justify="end">
      <slot name="bottom"></slot>
      <div style="flex: 1"></div>
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        layout="total, sizes, prev, pager, next, jumper"
        :total="total"
        :page-size="pageLength"
        :current-page="currPage">
      </el-pagination>
    </el-row>
  </div>
</template>

<script>

  import Lib from 'Lib'

  import Vue from 'vue'

  module.exports = {
    name: 'Grid',
    data: function () {
      return {

        loading2: false,
        gridData: [],
        //分页信息
        eventPage: 1,
        queryPage: 1,
        paramsPage: 1,
        total: 0,
        //临时存储当前页
        currPage: 1,
        pageLength: 10
      }
    },
    props: {
      query: {},
      queryProp: {
        type: Object,
        default: function () {
          return {
            start: 'start',
            length: 'length'
          }
        }
      },
      data: [],
      url: '',
      selectionChange: {
        type: Function,
        default: function () {
          return ''
        }
      },
      load: {//是否默认加载
        type: Boolean,
        default: true
      },
      height: {
        type: [String, Number],
        default: function () {
          return 300
        }
      },
      table: {
        column: [],

        selection: false
      }
    },
    mounted(){
      !!this.load && this.getList();
    },
    methods: {
      filter(name, value) {
        if (name == 'date') {
          return Vue.filter('formatDate')(value, 'YYYY-MM-DD HH:mm:ss')
        }
        return Vue.filter('dictionary')(value, name)
      },
      handleSizeChange(val) {

        this.currPage = val;
        this.pageLength = val;
        this.getList()
      },
      handleCurrentChange(val) {//切换页

        this.currPage = val;
        this.getList()
      },
      /**
       * 列表查询
       * @param query
       * @param callback
       * @returns {*}
       */
      getList (query, callback) {
        if (!this.url) {
          this.gridData = this.data;
          return ''
        }
        var query = query ? query : Object.assign({}, this.query);
        for (var i in query) {
          if (query[i] === '') {
            delete query[i]
          }
        }
        var _this = this;
//        var currPage = this.currPage;
//        var start = (currPage - 1) * this.pageLength;
//        //模拟数据
//        query[this.queryProp.per_page] = this.pageLength;
//        query[this.queryProp.start] = start;
        this.loading2 = true;
        this.$http.post(this.url +'?page='+ this.currPage +'&per_page='+this.pageLength, query).then(function (response) {
          _this.loading2 = false;
          var data = response.data;
          if (data.status) {
            _this.gridData = data.data.data;
            _this.pageLength = data.data.per_page;
            _this.total = data.data.total;
            callback ? callback(data) : '';
          } else {
            _this.$message.error({
              message: data.message
            });
          }
        }).catch(function (err) {
          _this.loading2 = false;
        });
        return query
      }
    }
  }
</script>


<style>
  .handle-a {
    width: 100%;
    display: block;
    cursor: pointer;
    color: blue;
  }

  .grid-row-bg .el-form-item {
    margin: 0;
  }
</style>
