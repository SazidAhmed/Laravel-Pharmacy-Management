<template>
  <div class="dropdown d-inline-block ml-2">
    <button
      type="button"
      class="btn btn-sm btn-dual"
      id="page-header-notifications-dropdown"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <i class="fa fa-fw fa-bell"></i>
      <span class="text-primary">•</span>
    </button>
    <div
      class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm"
      aria-labelledby="page-header-notifications-dropdown"
    >
      <div class="p-2 bg-primary-dark text-center rounded-top">
        <h5 class="dropdown-header text-uppercase text-white">Stock End</h5>
      </div>
      <ul class="nav-items mb-0">
        <li v-for="notify in notifications" :key="notify.id">
          <a class="text-dark media py-2" href="javascript:void(0)">
            <div class="mr-2 ml-3">
              <i class="fa fa-fw fa-times-circle text-danger"></i>
            </div>
            <div class="media-body pr-2">
              <div class="font-w600">
                {{ notify.name }}
              </div>
              <span class="font-w500 text-muted"
                >In Stock : {{ notify.stock }} only</span
              >
            </div>
          </a>
        </li>
        <li></li>
      </ul>
      <div class="p-2 border-top">
        <a
          class="btn btn-sm btn-light btn-block text-center"
          href="javascript:void(0)"
        >
          <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..
        </a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      notifications: [],
    };
  },
  created() {
    this.notify();
  },
  methods: {
    notify() {
      axios
        .get("/api/stockOut")
        .then((response) => {
          this.notifications = response.data;
        })
        .catch((error) => {
          alert("unable to fetch notifications");
        });
    },
  },
};
</script>