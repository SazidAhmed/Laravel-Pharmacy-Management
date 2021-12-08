<template>
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title"></h3>
        <div class="block-options"></div>
      </div>
      <div class="block-content">
        <h1>Vue Select - Ajax</h1>
        <v-select
          label="name"
          :filterable="false"
          :options="options"
          @search="onSearch"
        >
          <template slot="no-options"> type to search customers.. </template>
          <template slot="option" slot-scope="option">
            <div class="d-center">
              {{ option.name }}
            </div>
          </template>
          <template slot="selected-option" slot-scope="option">
            <div class="selected d-center">
              {{ option.name }}
            </div>
          </template>
        </v-select>
      </div>
    </div>
  </div>
</template>
<script>
import vSelect from "vue-select";
Vue.component("v-select", vSelect);
import "vue-select/dist/vue-select.css";

export default {
  data() {
    return {
      id: "",
      name: "",
      image: "",
      uploadReady: true,
      editmode: false,
      success: false,
      allerrors: [],
      records: [],
      options: [],
    };
  },
  created() {},

  methods: {
    onSearch(search, loading) {
      loading(true);
      this.search(loading, search, this);
    },
    search: _.debounce((loading, search, vm) => {
      fetch(`/api/customerSelect/${escape(search)}`).then((res) => {
        res.json().then((json) => (vm.options = json.data));
        loading(false);
      });
    }, 350),
  },
};
</script>
<style type="text/css">
.danger {
  color: red;
}
img {
  height: auto;
  max-width: 2.5rem;
  margin-right: 1rem;
}

.d-center {
  display: flex;
  align-items: center;
}

.selected img {
  width: auto;
  max-height: 23px;
  margin-right: 0.5rem;
}

.v-select .dropdown li {
  border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
  border-bottom: none;
}

.v-select .dropdown li a {
  padding: 10px 20px;
  width: 100%;
  font-size: 1.25em;
  color: #3c3c3c;
}

.v-select .dropdown-menu .active > a {
  color: #fff;
}
</style>