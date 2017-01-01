<template>
  <el-select
    ref="select"
    v-model="value2"
    placeholder="请选择"
    :loading="loading">
    <el-option style="background: none;height: auto;color: #000;padding: 0;" :label="_label" :value='value2'>
      <div style="display: flex;flex-direction: column;max-height: 261px;">
        <div style="height: 30px;display: flex;padding: 0 10px 3px;border-bottom: 1px solid #ccc;"><span style="flex: 1">{{label1}}</span>
          <el-button style="padding: 5px;" size="small" @click="handleClick">确定</el-button></div>
        <el-tree
          style="border: none;flex: 1;overflow: auto;max-height: 232px;" class="menuTree"
          :props="props"
          :nodeKey="nodeKey"
          ref="tree"
          :default-expand-keys="defaultExpandKeys"
          :defaultCheckedKeys="defaultCheckedKeys"
          :show-checkbox="showCheckbox"
          highlight-current
          :data="treeData"
          @node-click="nodeClick"
          @check-change="checkChange1"
        ></el-tree>
      </div>

    </el-option>
  </el-select>
</template>

<script>
  export default {
    name: 'SelectTree',

    data() {
      return {
        expand: false,
        _label: '',
        label1:'',
        value1: '',
        value2: '',
        loading: false,
      }
    },

    props: {
      checkChange: Function,
      value: '',
      name: {
          type: String,
          default: function () {
              return ''
          }
      },
      props: {
        label: 'label',
        children: 'children'
      },
      nodeKey: '',
      defaultExpandKeys: [],
      defaultCheckedKeys: [],
      showCheckbox: false,
      treeData: {
        type: Array,
        default: function () {
          return []
        }
      },
      selectData: {}
    },
    watch: {
      value(val) {
          if(!!this.label1){
            this._label = this.label1;
          }
          if(!val){
            this._label = ''
          }
          this.value2 = val
      },
      name(val) {
        this._label = val
      },
      treeData(val) {
        var tree = this.$refs.tree;
      }
    },
    mounted(){
        this._label = this.name
        this.value2 = this.name
    },
    methods: {
      checkChange1(aa,bb,cc) {
        console.log(
          aa,bb,cc
        )
      },
      handleClick() {
        this.$emit('input', this.value1+'');//通知上级事件

      },
      handleExpandIconClick(event, me) {
        var tree = this.$refs.selectTree;
        let target = event.target;
        if (target.tagName.toUpperCase() === 'SPAN') {
          if (me.expanded) {
            me.node.collapse();
          } else {
            me.node.expand();
          }
          return;
        }
        if (target.tagName.toUpperCase() === 'DIV') {
//console.log(me.node.data, me.node);
          return;
        }

//        tree.$tree.$emit('node-click', this.node.data, this.node, this);
      },
      nodeClick(data, checked, indeterminate) {
        this.label1 = data[this.props.label];
        this.value1 = data[this.nodeKey];
      }
    }
  }
</script>


<style scoped>

</style>
